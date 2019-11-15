<?php
//dashboard
include '../configs.php';
//var_dump($_SESSION);
if(isset($_SESSION['status'], $_SESSION['uniqid'])){
    if(!empty($_SESSION['status'] && $_SESSION['uniqid'])){
        $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" && status = "'.$_SESSION['status'].'"');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dat = $rows[0];
        ?>
        
        <!DOCTYPE html>

<html lang="en">

 
<head>
	<meta charset="utf-8">
        <title>Portal | Dashboard</title>
	<link href="../images/logo.png" rel="shortcut icon"> 
	<!--Stylesheets--> 
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
        <script src="../jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.js"></script>
        <link rel="stylesheet" href="../css/fileinput.css">
        <link rel="stylesheet" href="../themes/explorer/theme.css">
        <script type="text/javascript" src="../js/fileinput.min.js"></script>
        <script src="../themes/explorer/theme.js"></script>
	<!--Optimize for mobile devices--> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	 <!--jQuery & JS files--> 
	<script src="../../../../ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<!--<script src="../js/script.js"></script>-->
        <script src="../js/htmltocanvas.js"></script>
        <script src="../js/canvas-to-blob.min.js"></script>
        <script src="https://js.paystack.co/v1/inline.js"></script>
          
        <script>
            
  function payWithPaystack(a){
      var tk = a.split("//");
    var handler = PaystackPop.setup({
      key: 'pk_test_c2e059e9922aae075034b75f3ecaf7f1be3370c0',
      email: '<?php echo $dat['email']; ?>',
      amount: parseInt(tk[0]),
      ref: tk[1], // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Matric Number",
                variable_name: "matric",
                value: "<?php echo $dat['uid']; ?>"
            }
         ]
      },
      callback: function(response){
      console.log(response);
$.post('payments/auth/', {resp: response.reference}, function(data){ payments(); alert(data); });

      },
      onClose: function(){
     del_ref(tk[1]); 
      }
    });
    handler.openIframe();
  }
  function pay(z, h){
   //$("#pay_bt"+z+"rr"+k).html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
      $.post('payments/ref_gen/', {mnt: z, tp: h}, 
    function(data){
        if(data !== ""){
        payWithPaystack(data);
    }else{
        alert("Access Denied!!!");
    }
    });
    
    
    
  }
 function del_ref(a){$.post('payments/ref_gen/', {abt: a}, function(){payments();});}
</script>
<script>
    $(".close fileinput-remove").click(function(){
		$(".file-previev").html('');
	});
          function passport(){
            $("#passport").modal("show");
        }
          function idcard(){
            $("#idcard").modal("show");
            $.post('idcard/', {dt: '<?php echo $_SESSION['uniqid']; ?>'}, 
            function(data){
                $("#putcard").html(data);
            });   
        }
          function change_p(){
            $("#change_p").modal("show");
        }
        
        function do_change_p(){
            $("#put-change_p").html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
        var pass = $("#old_pass").val();
        var new_pass = $("#new_pass").val();
        var con_pass = $("#con_pass").val();
        if(pass,new_pass,con_pass !== ""){
            if(new_pass === con_pass){
                
                $.post('change_pass/', {pass:pass, new_pass: new_pass, con_pass: con_pass}, 
                function(data){
                   if(data === "Password successfully changed!"){
                       $("#change_p-mes").html("<div class='confirmation-box round'>"+data+"</div>");
                 $("#put-change_p").html('<a href="#" onclick="do_change_p()" class="button round blue image-right ic-right-arrow">CHANGE PASSWORD</a>');
                 $("#old_pass").val('');
                 $("#new_pass").val('');
                 $("#con_pass").val('');
                   }else{
                      $("#change_p-mes").html("<div class='error-box round'>"+data+"</div>");
                 $("#put-change_p").html('<a href="#" onclick="do_change_p()" class="button round blue image-right ic-right-arrow">CHANGE PASSWORD</a>');        
                   } 
                });
                    
                
                
            }else{
              $("#change_p-mes").html("<div class='error-box round'>Oops! New password dose not match.</div>");
                 $("#put-change_p").html('<a href="#" onclick="do_change_p()" class="button round blue image-right ic-right-arrow">CHANGE PASSWORD</a>');       
            }
            
            
        }else{
          $("#change_p-mes").html("<div class='error-box round'>Oops! All fields are required!!!</div>");
                 $("#put-change_p").html('<a href="#" onclick="do_change_p()" class="button round blue image-right ic-right-arrow">CHANGE PASSWORD</a>');    
        }
    
    }
        
        function cloz(dp){
     $("#"+dp).modal('hide');        
             
         }
         
        function biodata(){
             $("#bio").modal("show");
             $("#put-bio").html('<center style="margin: 5%;"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>');
       $.post('biodata/', {id: '<?php echo $dat['uniqid']; ?>', stat: '<?php echo $dat['status']; ?>'}, 
       function(data){
          // alert(data);
           $("#put-bio").html(data);
       });
       
       } 
       
        var sx = "";
                         function sex(as){
                            if(sx !== ""){
                               document.getElementById(sx).style.border = "0px solid #4682b4";
                               document.getElementById(as).style.border = "3px solid rgba(0, 5, 47, 0.8)";
                                sx = as;
                            }else{
                              document.getElementById(as).style.border = "3px solid rgba(0, 5, 47, 0.8)";
                                sx = as;  
                            }
                            }
                            
               
     
 function capture() {
      $("#put-idcard").html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
       var canvas = document.getElementById("canvas");
var card = document.getElementById('my_idcard').innerHTML;
    rasterizeHTML.drawHTML(card, canvas); 
//    var dataURL = canvas.toDataURL();
//console.log(dataURL);

if (canvas.toBlob) {
    canvas.toBlob(
        function (blob) {
            // Do something with the blob object,
            // e.g. creating a multipart form for file uploads:
            var formData = new FormData();
            formData.append('file', blob, "blob.png");
            $.ajax({
                url: 'idcard/png/', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                         
                type: 'post',
                success: function(){
      setTimeout(function(){
                  if (canvas.toBlob) {
    canvas.toBlob(
        function (blob) {
            // Do something with the blob object,
            // e.g. creating a multipart form for file uploads:
            var formData = new FormData();
            formData.append('file', blob, "blob.png");
            $.ajax({
                url: 'idcard/png/', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                         
                type: 'post',
                success: function(data){
                    if(data.trim() === "Error! File format not supported." || data.trim() === "Error! THe name of your file contains disallowed characters." || data.trim() === "Error! File is invalid or it's size is larger than 2MB." ){
                    alert(data); // display response from the PHP script, if any
                }else{
                    
                     $("#put-idcard").html('<a href="#" onclick="capture()" class="button round blue image-right ic-right-arrow">SUBMIT ID CARD REQUEST</a>');    
                 
            alert("ID CARD Successfully Generated\r\n copy this link into another tab to view the generated id card\r\n http://k-dev.org/eksu/id080cards/<?php echo $dat['uid'].".png"; ?>");
             }
                }
     });
            /* ... */
        },
        'image/png'
    );

}
      }, 2000);
                }
     });
            /* ... */
        },
        'image/png'
    );

}
   }
        
   
        
   function pdf(a){
       $("#put-"+a).html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
       var dt = $("#my_idcard").html();
       $.post('idcard.php', {dt:dt}, 
       function(data){
           alert(data);
       });
   }     
        
        
 function dashboard(){
     $("#payments").addClass("hidden");
     $("#courses").addClass("hidden");
     $("#results").addClass("hidden");
     $("#hod").addClass("hidden");
     $("#payments_bt").removeClass("active-tab");
     $("#courses_bt").removeClass("active-tab");
     $("#results_bt").removeClass("active-tab");
     $("#hod_bt").removeClass("active-tab");
     $("#dashboard_bt").addClass("active-tab");
     $("#dashboard").removeClass("hidden");
     
     $.post('dash/', {stat: '<?php echo $_SESSION['status']; ?>', uid: '<?php echo $dat['uniqid'] ?>' }, 
     function(data){
         $("#put-dashboard").html(data);
     });
     
 }   
 function payments(){
     $("#dashboard").addClass("hidden");
     $("#courses").addClass("hidden");
     $("#results").addClass("hidden");
     $("#hod").addClass("hidden");
     $("#dashboard_bt").removeClass("active-tab");
     $("#courses_bt").removeClass("active-tab");
     $("#results_bt").removeClass("active-tab");
     $("#hod_bt").removeClass("active-tab");
     $("#payments_bt").addClass("active-tab");
     $("#payments").removeClass("hidden");
      $.post('payments/', {std: '<?php echo $_SESSION['uniqid']; ?>'}, 
     function(data){
         $("#put-payments").html(data);
     });
 }   
 
 function courses(){
     $("#payments").addClass("hidden");
     $("#dashboard").addClass("hidden");
     $("#results").addClass("hidden");
     $("#hod").addClass("hidden");
     $("#payments_bt").removeClass("active-tab");
     $("#dashboard_bt").removeClass("active-tab");
     $("#results_bt").removeClass("active-tab");
     $("#hod_bt").removeClass("active-tab");
     $("#courses_bt").addClass("active-tab");
     $("#courses").removeClass("hidden");
     $.post('courses/', {std: '<?php echo $_SESSION['uniqid']; ?>'}, 
     function(data){
         $("#put-courses").html(data);
     });
 }   
 function results(){
     $("#payments").addClass("hidden");
     $("#courses").addClass("hidden");
     $("#dashboard").addClass("hidden");
     $("#hod").addClass("hidden");
     $("#payments_bt").removeClass("active-tab");
     $("#courses_bt").removeClass("active-tab");
     $("#dashboard_bt").removeClass("active-tab");
     $("#hod_bt").removeClass("active-tab");
     $("#results_bt").addClass("active-tab");
     $("#results").removeClass("hidden");
     
     $.post('result/', {std: '<?php echo $_SESSION['uniqid']; ?>'}, 
     function(data){
         $("#put-results").html(data);
     });
 }   
 
 function reg_course(a,b){
     if(b === "Y"){
         $("#reg_c"+a).removeClass("glyphicon-ok");
     $("#reg_c"+a).html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
     $.post('courses/register/', {id: a, stat: b}, 
      function(data){
          if(data === "Course successfully registered!"){
          courses();
          alert(data);
      }else{
        $("#reg_c"+a).attr("onclick", "reg_course('"+a+"', 'Y')"); 
        $("#reg_c"+a).html('');
          $("#reg_c"+a).addClass("glyphicon-ok");
          courses();
          alert(data);  
      }
      });
     }else if(b === "N"){
         $("#reg_c"+a).removeClass("glyphicon-trash");
      $("#reg_c"+a).html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');   
      $.post('courses/register/', {id: a, stat: b}, 
      function(data){
          if(data === "Course successfully deleted!"){
          courses();
          alert(data);
      }else{
        $("#reg_c"+a).attr("onclick", "reg_course('"+a+"', 'N')"); 
        $("#reg_c"+a).html('');
          $("#reg_c"+a).addClass("glyphicon-trash");
          courses();
          alert(data);  
      }
      });
     }
 }
 
 function find_course(l){
     var f = $("#search-course").val();
     if(f !== ""){
         var put = "<tr class='loade'><td colspan='4'><div class=\"lds-roller\"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></td></tr>";
      $("#tb"+l).append(put);  
      $.post('courses/search/', {st: f}, 
      function(data){
      $("tr").remove(".loade");
        $("#tb"+l).append(data);    
      });
     }else{
         courses();
         setTimeout(function(){$("#search-course").focus();}, 1000);
     }
 }
 
 function chat(a){
 $("#chat").modal("show");
 $.post('chat/', {dd: a}, function(data){
     $("#put-chat").html(data);
 });
 }
 function send(a, b){
 var mes = $("#chat-area").val();
 if(mes !== ""){
 $("#chat-area").val('');   
 $.post('chat/send/', {mes: mes, rcvr: a, mid: b}, function(){
$("#chat-box").append('<div  style=" width: 50%; background: #fff; border-radius: 20px; padding: 10px; color: #000; float: right;">'+mes+'<br><div style="float: right; font-size: 60%; font-weight: bolder; padding-right: 2%;">Just now</div> </div><br><br><br>');
 var div = document.getElementById("chat-box");
 div.scrollTop = div.scrollHeight - div.clientHeight;
$.post('chat/', {dd: a}, function(data){
$("#put-chat").html(data);
var div = document.getElementById("chat-box");
div.scrollTop = div.scrollHeight - div.clientHeight;
 });
 
 });
 }
 }
       function interval(func, wait, times){
    var interv = function(w, t){
        return function(){
            if(typeof t === "undefined" || t-- > 0){
                setTimeout(interv, w);
                try{
                    func.call(null);
                }
                catch(e){
                    t = 0;
                    throw e.toString();
                }
            }
        };
    }(wait, times);
    
    
    
    $.queue = {
    _timer: null,
    _queue: [],
    add: function(fn, context, time) {
        var setTimer = function(time) {
            $.queue._timer = setTimeout(function() {
                time = $.queue.add();
                if ($.queue._queue.length) {
                    setTimer(time);
                }
            }, time || 2);
        }

        if (fn) {
            $.queue._queue.push([fn, context, time]);
            if ($.queue._queue.length === 1) {
                setTimer(time);
            }
            return;
        }

        var next = $.queue._queue.shift();
        if (!next) {
            return 0;
        }
        next[0].call(next[1] || window);
        return next[2];
    },
    clear: function() {
        clearTimeout($.queue._timer);
        $.queue._queue = [];
    }
};
 setTimeout(interv, wait);
};
  function loadlinks() { $.post('chat/notiz/', {}, function(data){
      if(data !== "0"){
          var s = "";
          if(data === 1){ s = ""; }else{ s = "s"; }
          $("#notiz").html(data+" New Message"+s);
      }else{
        $("#notiz").html(" Messages");  
      }    
  }); }
 loadlinks(); 
 interval(function(){loadlinks();}, 2000, 17280);
 
 function notif(){
     $("#notif").modal("show");
     $("#put-notif").html("<center style='margin-top: 25%;'><div class=\"lds-roller\"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>");
     $.post('chat/notif/', {}, 
     function(data){
       $("#put-notif").html(data);  
     });
     
     
 }
 
  function receipt(a, b){
     $("#reci"+b).html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');   
//     $("#reci"+b).addClass("disabled");
     $.post('payments/receipt/', {ref:a}, 
     function(data){
         $("#put-receipt").html(data);
         
              var canvas = document.getElementById("canvas_re");
              

const context = canvas.getContext('2d');

context.clearRect(0, 0, canvas.width, canvas.height);


var receipt = document.getElementById('put-receipt').innerHTML;
    rasterizeHTML.drawHTML(receipt, canvas);
//     var dataURL = canvas.toDataURL();
//console.log(dataURL);


if (canvas.toBlob) {
    canvas.toBlob(
        function (blob) {
            // Do something with the blob object,
            // e.g. creating a multipart form for file uploads:
            var formData = new FormData();
            formData.append('file', blob, "blob.png");
            $.ajax({
                url: 'payments/receipt/pdf/', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                         
                type: 'post',
                success: function(){
                  setTimeout(function(){
                      if (canvas.toBlob) {
    canvas.toBlob(
        function (blob) {
            // Do something with the blob object,
            // e.g. creating a multipart form for file uploads:
            var formData = new FormData();
            formData.append('file', blob, "blob.png");
            $.ajax({
                url: 'payments/receipt/pdf/', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                         
                type: 'post',
                success: function(data){
                    
                   setTimeout(function(){
                       payments();
                       window.open('payments/receipt/pdf/display/?l='+data+'', "_blank");
                   }, 1000);
                   
                     }
     });
            
        },
        'image/png'
    );

}
                      
                  }, 2000);
                }
     });
            
        },
        'image/png'
    );

}
//$("#canv").modal("show");
         
            

     });
 }
 
 
 
 function c_form(a){
     $("#c_formbt"+a).html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');   
     $("#c_formbt"+a).addClass("disabled");
     $("#c_formbt"+a).removeClass("btn-primary");
     $("#c_formbt"+a).removeClass("glyphicon glyphicon-download-alt");
     $("#c_formbt"+a).addClass("btn-default");
    var canvas = document.getElementById("c_form");
    

const context = canvas.getContext('2d');

context.clearRect(0, 0, canvas.width, canvas.height);

var receipt = document.getElementById('c_form'+a).innerHTML;
    rasterizeHTML.drawHTML(receipt, canvas);



if (canvas.toBlob) {
    canvas.toBlob(
        function (blob) {
            // Do something with the blob object,
            // e.g. creating a multipart form for file uploads:
            var formData = new FormData();
            formData.append('file', blob, "blob.png");
            $.ajax({
                url: 'courses/receipt/pdf/', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                         
                type: 'post',
                success: function(){
                  setTimeout(function(){
                      if (canvas.toBlob) {
    canvas.toBlob(
        function (blob) {
            // Do something with the blob object,
            // e.g. creating a multipart form for file uploads:
            var formData = new FormData();
            formData.append('file', blob, "blob.png");
            $.ajax({
                url: 'courses/receipt/pdf/', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                         
                type: 'post',
                success: function(data){
                    
                   setTimeout(function(){
                       courses();
                       window.open('courses/receipt/pdf/display/?l='+data+'', "_blank");
                   }, 1000);
                   
                     }
     });
            
        },
        'image/png'
    );

}
                      
                  }, 2000);
                }
     });
            
        },
        'image/png'
    );

}
//$("#canv").modal("show");
         
            

    
 }
 
 
 
 
 function permit(a){
     $("#permit"+a).html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');   
     $("#permit"+a).addClass("disabled");
     $("#permit"+a).removeClass("btn-success");
     $("#permit"+a).addClass("btn-default");
     
    var canvas = document.getElementById("permit");
    

const context = canvas.getContext('2d');

context.clearRect(0, 0, canvas.width, canvas.height);

var receipt = document.getElementById('permit_cont').innerHTML;
    rasterizeHTML.drawHTML(receipt, canvas);
     


if (canvas.toBlob) {
    canvas.toBlob(
        function (blob) {
            // Do something with the blob object,
            // e.g. creating a multipart form for file uploads:
            var formData = new FormData();
            formData.append('file', blob, "blob.png");
            $.ajax({
                url: 'permit/pdf/', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                         
                type: 'post',
                success: function(){
                  setTimeout(function(){
                      if (canvas.toBlob) {
    canvas.toBlob(
        function (blob) {
            // Do something with the blob object,
            // e.g. creating a multipart form for file uploads:
            var formData = new FormData();
            formData.append('file', blob, "blob.png");
            $.ajax({
                url: 'permit/pdf/', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                         
                type: 'post',
                success: function(data){
                    
                   setTimeout(function(){
                       if(a === "1"){
                       dashboard();
                   }else{
                     payments()  ;
                   }
                       window.open('permit/pdf/display/?l='+data+'', "_blank");
                   }, 1000);
                   
                     }
     });
            
        },
        'image/png'
    );

}
                      
                  }, 2000);
                }
     });
            
        },
        'image/png'
    );

}
//$("#canv").modal("show");
         
            

    
 }
 
 
 
 //encapsulate with staff only authentication
 
 function my_students(a){
 $("#my_students").modal("show");
 $("#put-my_students").html("<center style='margin-top: 10%;'><div class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>");
 $.post('courses/my_students/', {st: a}, 
 function(data){
    $("#put-my_students").html(data); 
 });
 
 }
 function my_results(a){
 $("#my_results").modal("show");
 $("#put-my_results").html("<center style='margin-top: 10%;'><div class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>");
 $.post('courses/my_results/', {st: a}, 
 function(data){
    $("#put-my_results").html(data); 
 });
 
 }
 
 
       
 
 
 
 //encapsulate with hod authentication
 function hod(){
     $("#payments").addClass("hidden");
     $("#courses").addClass("hidden");
     $("#dashboard").addClass("hidden");
     $("#results").addClass("hidden");
     $("#payments_bt").removeClass("active-tab");
     $("#courses_bt").removeClass("active-tab");
     $("#dashboard_bt").removeClass("active-tab");
     $("#results_bt").removeClass("active-tab");
     $("#hod_bt").addClass("active-tab");
     $("#hod").removeClass("hidden");
     
      $.post('hod/', {stat: '<?php echo $_SESSION['status']; ?>', uid: '<?php echo $dat['uniqid'] ?>' }, 
     function(data){
         $("#put-hod").html(data);
     });
 }   
      function allocate(ac){
          if(ac === "Y"){
          $("#put-allocate_bt_"+ac).html('<div class="lds-roller" style="float: right;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
      }else{
        $("#put-allocate_bt_"+ac).html('<div class="lds-roller" style="float: left;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');  
      }
            $("#allocate_action").val(ac);
       var arr = $("#allocate_array").val();
       var to = $("#to_allocate").val();
        if(arr !== "" && to !== ""){
            $.post( "hod/", $( "#allocate" ).serialize(), function(data){
                $("#allocate-mes").html("<div class='confirmation-box round'>"+data+"</div>");
        setTimeout(function(){hod();}, 2000);  
    
            });
      
    }else{
      $("#allocate-mes").html("<div class='error-box round'>You can't submit an empty request, select a course and a/some lecturer(s). </div>");  
    $("#put-allocate_bt_Y").html('<a href="#"  onclick="allocate("Y")" class="button round blue image-right ic-right-arrow" style="float: right;">ALLOCATE</a>');
    $("#put-allocate_bt_N").html('<a href="#"  onclick="allocate("N")" class="button round btn-danger image-left ic-left-arrow" style="float: left;">WITHDRAW</a>');
        
        }
      }
      function find_student(){
          $("#put-student").html('<center style="margin-top: 10%;"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>');
          var std = $("#search-student").val();
          if(std !== ""){
    $.post('find-student/', {std: std, wh: '<?php echo $dat['uniqid']; ?>'}, 
          function(data){
          $("#put-student").html(data);    
          });
      }else{
          $("#put-student").html('');
      }
      }
      
      function edit_result(a,b){
      if(b === 'edit'){
      $("#ca"+a).removeAttr("readonly");
      $("#ca"+a).focus();
      $("#exam"+a).removeAttr("readonly");
      $("#edit_bt"+a).removeClass("glyphicon-pencil");
      $("#edit_bt"+a).addClass("glyphicon-ok");
      $("#edit_bt"+a).attr("onclick", "edit_result('"+a+"', 'save')");
      
  }else if(b === 'save'){
      $("#ca"+a).attr("readonly", "readonly");
      $("#ca"+a).removeAttr("autofocus");
      $("#exam"+a).attr("readonly", "readonly");
     $("#edit_bt"+a).removeClass("glyphicon-ok");
     $("#edit_bt"+a).html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
      var ca = $("#ca"+a).val();
      var exam = $("#exam"+a).val();
      var std = $("#search-student").val();
      var tot = parseInt(ca)+parseInt(exam);
      $.post('find-student/edit-result/', {ca: ca, exam: exam, std: std, ind: a}, 
      function(data){
          if(data === "done"){
              $("#total"+a).html(tot);
              $("#edit_bt"+a).html('');
          $("#edit_bt"+a).attr("onclick", "edit_result('"+a+"', 'edit')");
          $("#edit_bt"+a).addClass("glyphicon-pencil");
      }else{
          alert(data);
      }
      });
      
  }
      }
      
      //encapsulate with Bursars authentication
      
      function bus_pmt(a, b){
          var name = "";
          var amou = "";
          var dura = "";
          var prog = "";
          var facu = "";
          var dept = "";
          var leve = "";
          var bank = "";
          var acna = "";
          var acnu = "";
      if(b === "edit"){
          $("#edit"+a).html('<i class="glyphicon glyphicon-ok"></i>');
          $("#edit"+a).attr("onclick", "bus_pmt('"+a+"', 'save')");
              $("#name"+a).removeAttr("readonly");
              $("#name"+a).focus();
              $("#amou"+a).removeAttr("readonly");
              $("#dura"+a).removeAttr("readonly");
              $("#prog"+a).removeAttr("readonly");
              $("#facu"+a).removeAttr("readonly");
              $("#dept"+a).removeAttr("readonly");
              $("#leve"+a).removeAttr("readonly");
              $("#bank"+a).removeAttr("readonly");
              $("#acna"+a).removeAttr("readonly");
              $("#acnu"+a).removeAttr("readonly");
          
      }else if(b === "save"){
           $("#edit"+a).html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');   
              name = $("#name"+a).val();
              amou = $("#amou"+a).val();
              dura = $("#dura"+a).val();
              prog = $("#prog"+a).val();
              facu = $("#facu"+a).val();
              dept = $("#dept"+a).val();
              leve = $("#leve"+a).val();
              bank = $("#bank"+a).val();
              acna = $("#acna"+a).val();
              acnu = $("#acnu"+a).val();
              
              $.post('bus/payment/', {n: a, name: name, amou: amou, dura: dura, prog: prog, facu: facu, dept: dept, leve: leve, bank: bank, acna: acna, acnu: acnu}, 
              function(data){
                  $("#edit"+a).html('<i class="glyphicon glyphicon-pencil"></i>');
              $("#name"+a).attr("readonly", "readonly");
              $("#name"+a).removeAttr("autofocus");
              $("#amou"+a).attr("readonly", "readonly");
              $("#dura"+a).attr("readonly", "readonly");
              $("#prog"+a).attr("readonly", "readonly");
              $("#facu"+a).attr("readonly", "readonly");
              $("#dept"+a).attr("readonly", "readonly");
              $("#leve"+a).attr("readonly", "readonly");
              $("#bank"+a).attr("readonly", "readonly");
              $("#acna"+a).attr("readonly", "readonly");
              $("#acnu"+a).attr("readonly", "readonly");
              dashboard();
               alert(data);
               
              });
              
          }else if(b === "trash"){
            $("#trash"+a).html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');     
            $.post('bus/payment/', {n:a, fc: "dell"}, 
                    function(data){
                $("#trash"+a).html('<i class="glyphicon glyphicon-trash"></i>'); 
                dashboard();
                alert(data);
            });

          }else if(b === "add"){
           $("#bus-add").html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');   
           name = $("#name-add").val();
              amou = $("#amou-add").val();
              dura = $("#dura-add").val();
              prog = $("#prog-add").val();
              facu = $("#facu-add").val();
              dept = $("#dept-add").val();
              leve = $("#leve-add").val();
              bank = $("#bank-add").val();
              acna = $("#acna-add").val();
              acnu = $("#acnu-add").val();
              
               $.post('bus/payment/', {name: name, amou: amou, dura: dura, prog: prog, facu: facu, dept: dept, leve: leve, bank: bank, acna: acna, acnu: acnu}, 
              function(data){
                  $("#bus-add").html('<i class="glyphicon glyphicon-plus"></i> Add');
              $("#name-add").html('');
              $("#amou-add").html('');
              $("#dura-add").html('');
              $("#prog-add").html('');
              $("#facu-add").html('');
              $("#dept-add").html('');
              $("#leve-add").html('');
              $("#bank-add").html('');
              $("#acna-add").html('');
              $("#acnu-add").html('');
              dashboard();
               alert(data);
               
              });
          }
          
      }
      
   function revenue_query(){
   $("#put-qu-bt").html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
   var pt = $("#qu-p-type").val();
   var from = $("#qu-from").val();
   var to = $("#qu-to").val();
   var sess = $("#qu-session").val();
   var seme = $("#qu-semester").val();
   if(pt !== "" && from !== "" && to !== "" && sess !== "" && seme !== ""){
   $.post('bus/revenue/', {pt:pt, from:from, to:to, sess:sess, seme:seme}, 
   function(data){
       $("#qu-cont").html(data);
       $("#rev-mes").html('');
       $("#put-qu-bt").html('<b onclick="revenue_query()" class="btn btn-primary">QUERY <i class="glyphicon glyphicon-search"></i></b>');
   });
   }else{
     $("#rev-mes").html("<div class='error-box round'>You can't submit an empty request, all fields are required !!!</div>");
     $("#put-qu-bt").html('<b onclick="revenue_query()" class="btn btn-primary">QUERY <i class="glyphicon glyphicon-search"></i></b>');
        }   
   }   
   
   function timez(a){
   $("#"+a).html('');
   if(a === "put-tranz"){
       $("#search-tranz").val('');
   }
   if(a === "put-bus-student"){
       $("#bus-student").val('');
   }
   }
   
   function find_tranz(){
       $("#put-tranz").html('<center style="margin-top: 10%;"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>');
       var tran = $("#search-tranz").val();
       if(tran !== ""){
         $.post('bus/tranz/', {rf:tran}, 
         function(data){
             $("#put-tranz").html(data);
         });  
       }else{
         $("#put-tranz").html('');  
       }
   }
   function bus_student(){
       $("#put-bus-student").html('<center style="margin-top: 10%;"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>');
       var ud = $("#bus-student").val();
       if(ud !== ""){
         $.post('bus/student/', {ud:ud}, 
         function(data){
             $("#put-bus-student").html(data);
         });  
       }else{
         $("#put-bus-student").html('');  
       }
   }
      
      function bus_oupmnt(a, b){
          $("#put-bus-"+b+"pmt-bt").html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
         var pt = $("#bus-"+b+"pmt-p-type").val();
         var amt = $("#bus-"+b+"pmt-amt").val();
         var sess = $("#bus-"+b+"pmt-sess").val();
         if(pt !== "" && amt !== "" && sess !== ""){
             $.post('bus/student/oupmt/', {wh:a, pt:pt, amt:amt, sess:sess, pop:b}, 
             function(data){
               $("#bus-"+b+"pmt-mes").html(data); 
                $("#put-bus-"+b+"pmt-bt").html("<b onclick=\"bus_oupmnt('"+a+"', '"+b+"')\"  class=\"btn btn-primary\">SUBMIT <i class=\"glyphicon glyphicon-arrow-right\"></i></b> ");
             
             });
         }else{
           $("#bus-"+b+"pmt-mes").html("<div class='error-box round'>You can't submit an empty request, all fields are required !!!</div>")  ;
           $("#put-bus-"+b+"pmt-bt").html("<b onclick=\"bus_oupmnt('"+a+"', '"+b+"')\"  class=\"btn btn-primary\">SUBMIT <i class=\"glyphicon glyphicon-arrow-right\"></i></b> ");
         } 
      }
      
         function ict_biodata(){
          $("#put-edit_biodata").html('<center style="margin-top: 10%;"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>');
          var std = $("#edit_biodata").val();
          if(std !== ""){
    $.post('edit_biodata/', {std: std}, 
          function(data){
          $("#put-edit_biodata").html(data);    
          });
      }else{
          $("#put-edit_biodata").html('');
      }
      }
      
</script>
<style>
            .card {box-shadow: 0 4px 8px 0 rgba(0,0,0,0.7);transition: 0.3s;border-radius: 5px;margin-bottom: 20px;} .card:hover {box-shadow: 0 8px 16px 0 rgba(0,0,0,0.7);}img {border-radius: 5px 5px 0 0;}

        </style> 
</head>
<body>
    

<div id='notif' class="modal">
        <div class="col-lg-12" style="">
            <div class="col-sm-3" style="padding: 0px; height: 100%;" onclick="cloz('notif')"></div>
            <div class="col-sm-6 card" style=" background: #c1bdba; margin-top: 5%;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('notif')">&times;</span>
                <center><h3 style="text-transform: uppercase; font-size: 120%; font-weight: bolder;">NOTIFICATIONS TRAY</h3></center> 
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="col-sm-12" id="put-notif" style="padding: 0px; height: 450px; overflow: auto;"></div>
               </div>
            </div>
            <div class="col-sm-3" style="padding: 0px; height: 100%;"  onclick="cloz('notif')"></div>
        </div>
    </div>
<div id='my_students' class="modal">
        <div class="col-lg-12" style="">
            <div class="col-sm-2" style="padding: 0px; height: 100%;" onclick="cloz('my_students')"></div>
            <div class="col-sm-8 card" style=" background: #c1bdba; margin-top: 5%;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('my_students')">&times;</span>
                <center><h3 style="text-transform: uppercase; font-size: 120%;"></h3></center> 
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="col-sm-12" id="put-my_students" style="padding: 0px; min-height: 300px;"></div>
               </div>
            </div>
            <div class="col-sm-2" style="padding: 0px; height: 100%;"  onclick="cloz('my_students')"></div>
        </div>
    </div>
<div id='my_results' class="modal">
        <div class="col-lg-12" style="">
            <div class="col-sm-2" style="padding: 0px; height: 100%;" onclick="cloz('my_results')"></div>
            <div class="col-sm-8 card" style=" background: #c1bdba; margin-top: 5%;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('my_results')">&times;</span>
                <center><h3 style="text-transform: uppercase; font-size: 120%;"></h3></center> 
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="col-sm-12" id="put-my_results" style="padding: 0px; min-height: 300px;"></div>
               </div>
            </div>
            <div class="col-sm-2" style="padding: 0px; height: 100%;"  onclick="cloz('my_results')"></div>
        </div>
    </div>
<div id='bio' class="modal">
        <div class="col-lg-12" style="">
            <div class="col-sm-2" style="padding: 0px; height: 100%;" onclick="cloz('bio')"></div>
            <div class="col-sm-8 card" style=" background: #c1bdba; margin-top: 5%;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('bio')">&times;</span>
                <center><h3 style="text-transform: uppercase; font-size: 120%;">BIODATA FORM</h3></center> 
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="col-sm-12" id="put-bio" style="padding: 0px;"></div>
               </div>
            </div>
            <div class="col-sm-2" style="padding: 0px; height: 100%;"  onclick="cloz('bio')"></div>
        </div>
    </div>
<div id='canv' class="modal">
        <div class="col-lg-12" style="padding: 0px;">
            <div class="col-sm-2" style=" padding: 0px; height: 100%;" onclick="cloz('canv')"></div>
            <div class="col-sm-8 card" style="background: #c1bdba; margin-top: 5%;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('canv')">&times;</span>
                <center><h3 style="text-transform: uppercase; font-size: 120%;">ID CARD IMAGE</h3></center> 
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="col-sm-12" style="padding: 0px;" id="put-canv">
                  <canvas class="hidden" id="canvas" height="399" width="700" ></canvas>   
                  <canvas class="" id="canvas_re" height="1500" width="1500" ></canvas>   
                  <canvas class="" id="c_form" height="3000" width="1500" ></canvas>   
                  <canvas class="" id="permit" height="3000" width="1500" ></canvas>   
               </div>
               </div>
            </div>
            <div class="col-sm-2" style="padding: 0px; height: 100%;"  onclick="cloz('canv')"></div>
        </div>
    </div>
    <div id="passport" class="modal">
        <div class="col-lg-12" style="padding: 0px;">
            <div class="col-sm-4" style="padding: 0px; height: 100%;" onclick="cloz('passport')"></div>
            <div class="col-sm-4 card" style="background: #c1bdba; margin-top: 15%;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('passport')">&times;</span>
                <center><h3 style="text-transform: uppercase; font-size: 120%; ">Upload Passport</h3></center> 
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="col-sm-12" style="padding: 0px; padding-bottom: 2%;">
                     
                <center>
                    <div id="put_canvas"></div>
                                     <img id="blah"  onclick="" src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>" alt="DP" style="cursor: pointer; width: 250px; height: 250px; border-radius: 50%;" >
                                     <br><br>
                                                <span class="fileContainer" style="cursor: pointer;  margin-top: 25px;">
                                                    <form id="form1" runat="server">
                                                        <span style="width: 100%;">
                                                            <center> 
                                                                <span class="glyphicon glyphicon-camera" style="cursor: pointer;font-size: 150%; font-weight: bolder; color: rgba(0, 5, 47, 0.8);" ></span>
                                                            </center>
                                                        </span>
                                                        <input id="upload" type='file' name="file">
                                                    </form>
                                                </span>  

                                            </center> 
                
                </div>
                 
                </div>
            </div>
            <div class="col-sm-4" style=" padding: 0px; height: 100%;"  onclick="cloz('passport')"></div>
        </div>
    </div>
    
    <div id="change_p" class="modal">
        <div class="col-lg-12" style="padding: 0px;">
            <div class="col-sm-4" style=" padding: 0px; height: 100%;" onclick="cloz('change_p')"></div>
            <div class="col-sm-4 card" style="padding-left: 3.5%; background: #c1bdba; margin-top: 15%;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('change_p')">&times;</span>
                <center><h4 style="text-transform: uppercase; font-size: 120%;">CHANGE PASSWORD</h4>
                <div id="change_p-mes"></div>
                </center> 
                <form>
                <fieldset>
                
                
                    <p>
                        <label for="old_pass">Old Password</label>
                        <input id="old_pass" type="password" class="round full-width-input">
                </p>
                 <p>
                     <label for="new_pass">Enter New Password</label>
                     <input id="new_pass" type="password" class="round full-width-input">
                </p>
                 <p>
                     <label for="con_new_pass">Confirm Password</label>
                     <input id="con_pass" type="password" class="round full-width-input">
                </p>
                    <center id="put-change_p"> <a href="#"  onclick="do_change_p()" class="button round blue image-right ic-right-arrow">CHANGE PASSWORD</a></center>  
                    <br>
                
                    </fieldset>
                </form>
            </div>
            <div class="col-sm-4" style="padding: 0px; height: 100%;"  onclick="cloz('change_p')"></div>
        </div>
    </div>
    
    <div id="idcard" class="modal">
        <div class="col-lg-12" style="padding: 0px;">
            <div class="col-sm-3" style="padding: 0px; height: 100%;" onclick="cloz('idcard')"></div>
            <div class="col-sm-6 card" style="background: #c1bdba; margin-top: 5%;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('idcard')">&times;</span>
                <center><h3 style="text-transform: uppercase; font-size: 120%;">ID CARD DESIGN</h3></center> 
                <div id="putcard" style="width: 100%; min-height: 200px;">
                    <center style="margin-top: 25%"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>
                </div>
            </div>
            <div class="col-sm-3" style="padding: 0px; height: 100%;"  onclick="cloz('idcard')"></div>
        </div>
    </div>
    
	 <!--TOP BAR--> 
	<div id="top-bar">
		
		<div class="page-full-width cf">

			<ul id="nav" class="fl">
	
                            <li class="v-sep"><a href="#" id="company-branding" class="fl" style="margin-right: 20px;"><img src="../images/logo.png" alt="EKSU" /></a></li>
                                <li class="v-sep"><a href="#"  class="round button dark menu-user image-left" style="width: 150px;"><strong><?php echo $dat['uid']; ?></strong> <i class="glyphicon glyphicon-chevron-down" style="float: right;"></i></a>
                                    <ul style="width: 94%;">
                                        <li><a href="#" onclick="biodata()">My Biodata</a></li>
						<li><a href="#" onclick="passport()">Upload Passport</a></li>
                                                <li><a href="#" onclick="idcard()">ID Card</a></li>
                                                <li><a href="#" onclick="change_p()">Change Password</a></li>
                                                
					</ul> 
				</li>
                                <li class="v-sep"><a href="#"  class="round button dark" style="width: 120px;"><i class="glyphicon glyphicon-calendar"></i><strong> Sessions</strong> <i class="glyphicon glyphicon-chevron-down" style="float: right;"></i></a>
                                    <ul style="width: 94%;">
                                        <?php 
                                        $y = substr($dat['level'], 0, 1);
                                        $yr = date("Y", time());
                                        $i = 1;
                                        for($i > 0; $i <= $y; $i++){
                                            $p = $yr - $i;
                                            ?>
                                        <li><a href="#" onclick=""><?php echo $p."/".($p+1); ?></a></li>
                                        <?php
                                        }
                                        ?>
                                        
					
                                    </ul> 
				</li>
			
                                <li class="v-sep" style="display: inline;"><a href="#" onclick="notif()" class="round button dark menu-email-special image-left" id="notiz" >Messages</a>
                                    <ul>
                                        
                                    </ul>
                                </li>
                                
                                <li class="v-sep"><a href="logout/" class="round button dark menu-logoff image-left" style="width: 80px;">Log out</a>
                                <ul>
                                        
                                    </ul>
                                </li>
				
			</ul>  
                    <!--end nav--> 

					
			<form action="#" method="POST" id="search-form" class="fr">
				<fieldset>
					<input type="text" id="search-keyword" class="round button dark ic-search image-right" placeholder="Search..." />
					<input type="hidden" value="SUBMIT" />
				</fieldset>
			</form>

		</div>  
            <!--end full-width--> 	
	
	</div>  
         <!--end top-bar--> 
	
	
	
	 <!--HEADER--> 
         <div id="header-with-tabs" style="padding-top: 1%; padding-bottom: 0.2%;">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
                            <li><a href="#" id="dashboard_bt" onclick="dashboard()" class="active-tab dashboard-tab">Dashboard</a></li>
                           <?php if($_SESSION['status'] == "student"){ ?> <li><a id="payments_bt" onclick="payments()" href="#">Payments</a></li> <?php } ?>
				<!--<li><a href="#">Payment History</a></li>-->
                                <?php if($_SESSION['status'] == "student"){ ?><li><a id="courses_bt" onclick="courses()" href="#">Course Registration</a></li><?php }elseif($_SESSION['status'] == "staff"){ ?><li><a id="courses_bt" onclick="courses()" href="#">Manage Courses</a></li><?php } ?>
                                <?php if($_SESSION['status'] == "student"){ ?><li><a id="results_bt" onclick="results()" href="#">Results</a></li><?php } ?>
                                <?php $rt = $db->query('select id from hod where uniqid = "'.$_SESSION['uniqid'].'"'); $fd = $rt->rowCount();  if($_SESSION['status'] == "staff" && $fd > 0){ ?><li><a id="hod_bt" onclick="hod()" href="#">HOD Functions</a></li><?php } ?>
			</ul>  
                    <!--end tabs--> 
			
			
                         <a href="#" id="company-branding-small" class="fr"><img id="dp" src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>" alt="DP" style="width: 65px; height: 65px; border-radius: 50%;" /></a>
			
		</div>  
            <!--end full-width--> 	

	</div>  
         <!--end header--> 
	
	
	
	 <!--MAIN CONTENT--> 
	<div >
		
            <div id="content" class="page-full-width cf col-lg-12" style=" padding: 2%;">

                <div id="dashboard" class="col-sm-12" style="padding: 0px; background: rgba(0,0,0,0); min-height: 450px;">
                    				<div class="content-module">
				
					<div class="content-module-heading cf">
					
                                            <h3 class="fl" style="font-size: 120%;"><?php echo $_SESSION['status']; ?> dashboard</h3>
					</div> 
                                    <!--end content-module-heading--> 
					
					
                                    <div class="content-module-main cf" id="put-dashboard" style="min-height: 400px;" >
				 
				<center style="margin-top: 150px"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>
					</div>  
                                    <!--end content-module-main--> 
					
				</div>  
                            <!--end content-module--> 
	
                </div>
                
                
                <div id="payments" class="col-sm-12 hidden" style="padding: 0px; background: rgba(0,0,0,0); min-height: 450px;">
                    	<div class="content-module">
				
					<div class="content-module-heading cf">
					
                                            <h3 class="fl" style="font-size: 120%;">Manage payments</h3>
					</div> 
                                    <!--end content-module-heading--> 
				<div class="content-module-main cf" id="put-payments" style="min-height: 400px; overflow: auto;">
                                   <center style="margin-top: 150px;"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>
                                </div>
                                    </div>
                </div>
                <div id="hod" class="col-sm-12 hidden" style="padding: 0px; background: rgba(0,0,0,0);;">
                    	<div class="content-module">
				
					<div class="content-module-heading cf">
					
                                            <h3 class="fl" style="font-size: 120%;">HOD FUNCTIONS</h3>
					</div> 
                                    <!--end content-module-heading--> 
				<div class="content-module-main cf" id="put-hod" style="min-height: 400px; overflow: auto;">
                                   <center style="margin-top: 150px"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>
                                </div>
                                    </div>
                </div>
                <div id="results" class="col-sm-12 hidden" style="background: rgba(0,0,0,0);">
                    <div class="content-module">
				
                        <div class="content-module-heading cf" >
					
                                            <h3 class="fl" style="font-size: 120%;">manage result</h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf" id="put-results" style="min-height: 400px; overflow: auto;">
                              <center style="margin-top: 150px"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>
                                </div>
                                    </div>
                </div>
   
			
                    <div id="courses" class="col-sm-12 hidden" style="padding: 0px; background: rgba(0,0,0,0);">
			
                        <div class="content-module" style="min-height: 400px !important;">
				
					<div class="content-module-heading cf">
					
                                            <h3 class="fl" style="font-size: 120%;"> <?php if($_SESSION['status'] == "student"){ ?>Course Registration<?php }elseif($_SESSION['status'] == "staff"){ ?>Manage Courses<?php } ?></h3>
					</div>  
                                    <div class="content-module-main" id="put-courses" style="min-height: 400px !important; overflow: auto; ">
					 <center style="margin-top: 150px"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>
                                       </div>  
                                    <!--end content-module-main--> 
				
				</div> 
                            <!--end content-module--> 
				

		
			</div> 
                    <!--end side-content--> 
		
				
		</div>  
            <!--end full-width--> 
			
	</div>  
         <!--end content--> 
	
	
	
	 <!--FOOTER--> 
	<div id="footer">

		<p>&copy; Copyright 2018 <a href="#">Ekiti State University</a>. All rights reserved.</p>
		<!--<p><strong>Powered</strong> by <a href="https://k-dev.org">K-DEVELOPERS TECHNOLOGIES</a></p>-->
	
	</div>  
         <!--end footer-->
          
 <script src="../js/pp.js"></script>
 <?php if(isset($_SESSION['resp_allo'])){ ?>
 <script>
 hod();
 $("#allocate-mes").html("<div class='confirmation-box round'><?php echo $_SESSION['resp_allo'] ?></div>");  
 </script>
 <?php unset($_SESSION['resp_allo']); }elseif(isset($_SESSION['resp_error'])){ ?>
 <script>
 //bootsrap modal for errors
 </script>
 <?php unset($_SESSION['resp_error']); } ?>
 <script>dashboard();</script>

<div id='chat' class="modal">
        <div class="col-lg-12" style="">
            <div class="col-sm-3" style="padding: 0px; height: 100%;" onclick="cloz('chat')"></div>
            <div class="col-sm-6 card" style=" background: #c1bdba; margin-top: 5%;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('chat')">&times;</span>
                <center><h3 style="text-transform: uppercase; font-size: 120%;"></h3></center> 
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="col-sm-12" id="put-chat" style="padding: 0px; min-height: 500px;"></div>
               </div>
            </div>
            <div class="col-sm-3" style="padding: 0px; height: 100%;"  onclick="cloz('chat')"></div>
        </div>
    </div>
    
</body>


</html>
        
  <?php  }else{
        $_SESSION['error'] = "Unauthorised Login Attempt!!!";
        header('location: ../') ;
    }
}else{
    header('location: ../') ;
}


