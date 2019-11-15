<?php

//dash-payments-auth
include '../../../configs.php';
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if (!IS_AJAX) {
    die('Restricted access');
}
$pos = strpos($_SERVER['HTTP_REFERER'], getenv('HTTP_HOST'));
if ($pos === false) {
    die('Restricted access');
}
if (isset($_POST['resp'])) {
    $resp = htmlentities($_POST['resp'], ENT_QUOTES);
    $result = array();
//The parameter after verify/ is the transaction reference to be verified
    $url = 'https://api.paystack.co/transaction/verify/' . $resp;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer sk_test_e5e4413c3dd96ddef6da8b223c91828146b02e55']
    );
    $request = curl_exec($ch);
    curl_close($ch);

    if ($request) {
        $result = json_decode($request, true);
        // print_r($result);
        if ($result) {
            if ($result['data']) {
                //something came in
                if ($result['data']['status'] == 'success' && $result['data']['reference'] == $resp) {
                    // the transaction was successful, you can deliver value
                    /*
                      @ also remember that if this was a card transaction, you can store the
                      @ card authorization to enable you charge the customer subsequently.
                      @ The card authorization is in:
                      @ $result['data']['authorization']['authorization_code'];
                      @ PS: Store the authorization with this email address used for this transaction.
                      @ The authorization will only work with this particular email.
                      @ If the user changes his email on your system, it will be unusable
                     */
                    $amt = ((($result['data']['amount'])/100) -600);
                    $tr = $db->query('select * from transactions where tranz_id = "' . $resp . '" and amount = "" and criteria = ""');
                    if ($tr->rowCount() == 1) {
                        $trr = $tr->fetchAll(PDO::FETCH_ASSOC)[0];
//                check if payment is arrears or fresh
                        $stmt = $db->query('select * from users where uniqid = "' . $_SESSION['uniqid'] . '"');
                        if ($stmt->rowCount() == 1) {
                            //user exist
                            $dat = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
                            $out = $dat['outstandings'];
//                    $mh = strpos($out, "");
                            if ($out != "") {
                                $ex = explode("{:||:}", $out);
                                for ($x = 0; $x < count($ex); $x++) {
                                    $ml = explode("//", $ex[$x]);
                                    if ($ml[0] == $trr['id']) {
                                        $dif = $amt - $ml[3];
                                        if ($amt >= $ml[3]) {

                                            if ($dif > 0) {

                                                //update this row with amount = $dif and criteria = fresh, 
                                                $do = $db->query('update transactions set amount = "' . $dif . '", criteria = "fresh" where tranz_id = "' . $resp . '"');
                                                if ($do) {
                                                    //insert new row into transactions with thesame ref and amnt = $ml[3] and criteria = arrears
                                                    $st = $db->prepare("INSERT INTO transactions (id, tranz_id, payer, purpose, present_session, semester, amount, criteria, date) VALUES(:id, :tranz_id, :payer, :purpose, :present_session, :semester, :amount, :criteria, :date)");
                                                    $do1 = $st->execute(array(':id' => "", ':tranz_id' => $resp, ':payer' => $_SESSION['uniqid'], ':purpose' => $ml[0], ':present_session' => $ml[1], ':semester' => $ml[2], ':amount' => $ml[3], ':criteria' => "arrears", ':date' => time()));
                                                    //outstanding fees paid (unset), 
                                                    if ($do1) {
                                                        unset($ex[$x]);
                                                        $fi = implode("{:||:}", $ex);
                                                        $er = $db->query('update users set outstanding = "'.$fi.'" where uniqid = "'.$_SESSION['uniqid'].'"');
                                                        if($er){
                                                          echo "Transaction was successful";  
                                                        }
                                                    }
                                                }
                                            } elseif ($dif == 0) {
                                                //update this row with amount = $ml[3] and criteria = arrears, 
                                               $do = $db->query('update transactions set amount = "' . $ml[3] . '", present_session = "'.$ml[1].'", semester = "'.$ml[2].'", criteria = "arrears" where tranz_id = "' . $resp . '"');
                                               //outstanding fees paid (unset)
                                               if ($do) {
                                                        unset($ex[$x]);
                                                        $fi = implode("{:||:}", $ex);
                                                        $er = $db->query('update users set outstanding = "'.$fi.'" where uniqid = "'.$_SESSION['uniqid'].'"');
                                                        if($er){
                                                          echo "Transaction was successful";  
                                                        }
                                                    }
                                            }
                                        } else {
                                            //convert the negative sign of $dif to possitive
                                            $ft = -($dif);
                                            
                                            //update this row with amount = $ml[3] and criteria = arrears, 
                                            $do = $db->query('update transactions set amount = "' . $ml[3] . '", present_session = "'.$ml[1].'", semester = "'.$ml[2].'", criteria = "arrears" where tranz_id = "' . $resp . '"');
                                            if($do){
                                                //set $ml[3] and set $ex[$e] = impode("//", $ml)
                                            $ml[3] = $ft;
                                            $fb = implode("//", $ml);
                                            $ex[$x] = $fb;
                                            $fi = implode("{:||:}", $ex);
                                                        $er = $db->query('update users set outstanding = "'.$fi.'" where uniqid = "'.$_SESSION['uniqid'].'"');
                                                        if($er){
                                                          echo "Transaction was successful";  
                                                        }
                                            }
                                        }

                                        break;
                                    } elseif ($ml[0] != $trr['id'] && $x == (count($ex) - 1)) {
                                        //something can happen here.....
                                        //it has looped all through the outstandings and the payment made does not have an outstanding despite $out !=""
                                        //update payment row set amount = $amt and criterial = fresh
                                        $do = $db->query('update transactions set amount = "' . $amt . '", criteria = "fresh" where tranz_id = "' . $resp . '"');
                                       if($do){
                                           $fb = implode("//", $ml);
                                            $ex[$x] = $fb;
                                           $fi = implode("{:||:}", $ex);
                                                        $er = $db->query('update users set outstanding = "'.$fi.'" where uniqid = "'.$_SESSION['uniqid'].'"');
                                                        if($er){
                                                          echo "Transaction was successful";  
                                                        }
                                       }
                                    }
                                }
                            } else {
                                //outstanding == ""
                                //update payment row set amount = $amt and criterial = fresh
                                 $do = $db->query('update transactions set amount = "' . $amt . '", criteria = "fresh" where tranz_id = "' . $resp . '"');
                                       if($do){
                                           echo "Transaction was successful";  
                                       }
                            }
                        }
                    }

                    
                } else {
                    // the transaction was not successful, do not deliver value'
                    // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
                    echo "Transaction was not successful: Last gateway response was: " . $result['data']['gateway_response'];
                }
            } else {
                echo $result['message'];
            }
        } else {
            //print_r($result);
            die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
        }
    } else {
        var_dump($request);
        die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
    }
}