<div id="c_form52" class="hidden">
                                            <table style="width: 100%;">

    <tr style="background-color: rgba(0,0,0,0);">
        
        <td style="border: 0px solid #eee; width: 100%;" colspan="4">
        
    <center>
        <img src="../images/logo.png" style="width: 100px;" >
        <h1 style="font-size: 300%; font-weight: bolder;">EKITI STATE UNIVERSITY</h1>
        <h3 style="font-size: 200%; font-weight: bolder;">PMB 5363, ADO-EKITI, EKITI STATE, NIGERIA</h3>
        <h5 style="font-size: 150%; font-weight: bolder;">www.eksu.edu.ng</h5>
        </center>
    <br><br>
    </td>
    
    </tr>
    <tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4 !important;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
                <label style="color: #1c94c4 !important;">FIRSTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MIDDLENAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LASTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label style="color: #1c94c4 !important;">FACULTY : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">DEPARTMENT : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LEVEL : 500L</label>
        <br>
        <label style="color: #1c94c4 !important;">SEMESTER : Second</label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="4" valign="top">
<center> COURSE REGISTRATION RECEIPT</center>
    </td>
</tr>
                                            </table>
                                            <table style="width: 100%; border: 1px solid #000;">
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">Course Code</th>
									<th style="width: 60%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">course title</th>
									<th style="width: 15%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">unit(s)</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
	<?php 
   
        foreach($ll52 as $do52){
            $dis = explode("//", $do52);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
           
        ?>
                                                            <tr style="background-color: #f8f9fa;">
									
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa;"><?php echo $css['code']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa;"><?php echo $css['title']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa;"><?php echo $css['units']; ?></td>
									
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr style="background-color: #f8f9fa;">
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa;"><?php echo count($ll52)." Courses" ?></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa;"></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa;"><?php echo $tu." units"; ?></td>
                                                                   
                                                                </tr>
                                                        </tbody>

</table>
                                        </div>