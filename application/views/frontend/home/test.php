<script type="text/javascript">
$(document).ready(function(){   

    $("#send").click(function()
    {
        var str_url = "post_action";
     $.ajax({
         type: "POST",
         url: str_url, 
         data: {textbox: $("#textbox").val()},
         dataType: "text",  
         cache:false,
         success: 
              function(data){
                alert(data);  //as a debugging message.
              }

     });// you have missed this bracket
     return false;
 });
 });
</script>

<form method="post">
    <input id="textbox" type="text" name="textbox">
    <input id="send" type="submit" name="send" value="Send">
</form>