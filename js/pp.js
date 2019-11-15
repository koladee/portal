function readURL(input, ele) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#blah")
                        .attr('src', e.target.result)
                        .width("250px")
                        .height("250px");
                    $("#dp")
                        .attr('src', e.target.result)
                        .width("65px")
                        .height("65px");
                $("#blah1")
                        .attr('src', e.target.result)
                        .width("150px")
                        .height("150px");
                $("#passp")
                        .attr('src', e.target.result)
                        .width("150px")
                        .height("150px");
                $("#dash_p")
                        .attr('src', e.target.result)
                        .width("200px")
                        .height("200px");
                };
                

                reader.readAsDataURL(input.files[0]);
            }
        };
function readURL1(input, ele) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#signature")
                        .attr('src', e.target.result)
                        .height("20px");
                   
                };
                

                reader.readAsDataURL(input.files[0]);
            }
        };
        
        function signature() {
    var tis = document.getElementById("upload2");
    //alert(tis);
    var file_data = $('#upload2').prop('files')[0]; 
    var bla1 = document.getElementById("signature");
  // alert(bla1.src);
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    
    $.ajax({
        
                url: 'signature.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                   if(data.trim() !== ""){
                    //$("#alert_mes").html(data);
                    //$("#alert").modal("show");
                    alert(data);
                }else{
                readURL1(tis, bla1);
                   
                  // $("#alert_mes").html("Profile picture successfully uploaded");
                   // $("#alert").modal("show");
               }
                }
     });
}
        function passp() {
    var tis = document.getElementById("upload3");
    //alert(tis);
    var file_data = $('#upload3').prop('files')[0]; 
    var bla1 = document.getElementById("passp");
  // alert(bla1.src);
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    
    $.ajax({
        
                url: 'upload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                   if(data.trim() !== ""){
                    //$("#alert_mes").html(data);
                    //$("#alert").modal("show");
                    alert(data);
                }else{
                readURL(tis, bla1);
                   
                  // $("#alert_mes").html("Profile picture successfully uploaded");
                   // $("#alert").modal("show");
               }
                }
     });
}
        function load() {
    var tis = document.getElementById("upload1");
    //alert(tis);
    var file_data = $('#upload1').prop('files')[0]; 
    var bla1 = document.getElementById("blah1");
  // alert(bla1.src);
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    
    $.ajax({
        
                url: 'upload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                   if(data.trim() !== ""){
                    //$("#alert_mes").html(data);
                    //$("#alert").modal("show");
                    alert(data);
                }else{
                readURL(tis, bla1);
                   
                  // $("#alert_mes").html("Profile picture successfully uploaded");
                   // $("#alert").modal("show");
               }
                }
     });
}
$('#upload').on('change', function() {
    var tis = document.getElementById("upload");
    var file_data = $('#upload').prop('files')[0];  
    var bla = document.getElementById("blah");
    
    //alert(file_data);
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    
    $.ajax({
        
                url: 'upload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                   if(data.trim() !== ""){
                    //$("#alert_mes").html(data);
                    //$("#alert").modal("show");
                    alert(data);
                }else{
                    readURL(tis, bla);
                   
                  // $("#alert_mes").html("Profile picture successfully uploaded");
                   // $("#alert").modal("show");
                   
                }
                }
     });
});