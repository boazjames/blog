
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <title>Shout it!</title>
    </head>
    <body>
        <div id="container" style="width: 50%; margin: 100px 25%">
            <p id="message">hello there</p>
            <form id="insert_form" class="well" method="post">
                <label>Name</label>
                <input id="email" name="name" class="form-control" type="text">
                <label>Email</label>
                <input id="email" name="email" class="form-control" type="email">
                <label>Contact</label>
                <input id="contact" name="contact" class="form-control" type="text">
                <br>
                <input id="insert" name="insert" type="submit" class="btn btn-default" value="Insert">
                
            </form>
            
        </div>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
        <script>
            $(document).ready(function(){
                $("#insert").click(function(event){
                    event.preventDefault();
                  $.ajax({
                   url: "insert.php",
                   method: "POST",
                   data: $('#insert_form').serialize(),
                   dataType: "html",
                   success: function(strMessage){
                       $('#insert_form')[0].reset();
                       $('#message').html(strMessage);
                   }
               }); 
                });
            });
            </script>
    </body>
</html>
