<?php
    ob_start();
    session_start(); 
    include "koneksi.php";
    if (isset($_SESSION['user'])) {
            header("location:index.php");
        }else{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Informasi Penerima Bantuan</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body style="background-color:#5e5e5e;">
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-4 col-md-offset-4">
                <br /><br />
                <h2 style="color:white;">LOGIN</h2>
                <h5 style="color:white;">Silahkan login terlebih dahulu!</h5>
                <hr>
            </div>
        </div>
        <div class="row ">
               
          <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-50 col-xs-offset-1">

                <div class="panel panel-default">
                    <div class="panel-body" style="background-color:#bbbfbd;">
                        <center><img src="assets/img/find_user.png"></center>                             
                        <form role="form" method="post" id="frmlogin">
                               <br />
                            <label>Masukkan Username :</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                <input type="text" class="form-control" name="username" placeholder="Username" id="username" required/>
                            </div>

                            <label>Masukkan Password :</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required/>
                            </div>
                             
                            <button type="submit" class="btn btn-success btn-lg btn-block" id="login" name="login">Sign-In</button>
                            <hr />
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content" id="notif" name="notif">

                    </div>
                </div>
            </div>
        </div>
            
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <script type="text/javascript">
     $("#frmlogin").submit(function(event){
        event.preventDefault();
        var username = document.getElementById("username").value;  
        var password = document.getElementById("password").value;
        // console.log(username);
        $.ajax({
            url: "function.php",
            method: "POST",
            data: {username:username, password:password},
            success: function(data){
                $("#notif").html(data)
                $("#myModal").modal('show')
            }
        })
    });
    </script>


</body>
</html>

<?php

}

?>