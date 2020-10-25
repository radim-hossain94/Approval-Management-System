
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>METAL</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<script type="text/javascript">



  function Validate(){

      var username = document.getElementById("uid").value;
      var password = document.getElementById("pwd").value;


      var username_error = document.getElementById("username_error");
      var password_error = document.getElementById("password_error");

      username_error.innerHTML=" ";
      password_error.innerHTML=" ";

         if(username ==""){

         username_error.textContent="Username is required";
         return false;
         }


         if(password ==""){
         password_error.textContent="Password is required";
         return false;
         }


         return true;
}



</script >


<style media="screen">
  @import "https://use.fontawesome.com/releases/v5.5.0/css/all.css";

    body{
      margin: 10;
      padding: 100;
      font-family: sans-serif;
      background-image: url("Images/test1.jpg");
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;

    }

    body, html {
      height: 100%;
    }


    .login-box{
  width: 280px;
  position: absolute;
  top: 55%;
  left: 50%;
  transform: translate(-50%,-50%);
  color: white;
  }
  .login-box h2{
  float: left;
  font-size: 30px;
  border-bottom: 6px solid #F9F9F9 ;
  margin-bottom: 50px;
  padding: 13px 0;
  }
.textbox{
  width: 100%;
  overflow: hidden;
  font-size: 20px;
  padding: 8px 0;
  margin: 8px 0;
  border-bottom: 1px solid #F9F9F9 ;
}

.alert{
  width: 100%;
  font-size: 20px;
  padding: 8px 0;
  margin: 8px 0;
}

.textbox input{
  border: none;
  outline: none;
  background: none;
  color: white;
  font-size: 18px;
  width: 80%;
  float: left;
  margin: 0 10px;
}
.btn{
  width: 100%;
  background: none;
  border: 2px solid #F9F9F9 ;
  color: #F9F9F9;
  padding: 5px;
  font-size: 18px;
  cursor: pointer;
  margin: 12px 0;
}

  </style>


  <body>



  <br>
  <br>


<?php

  if (isset($_SESSION['u_id'])) {
              echo
              '
              ';
            }
            else {
              echo'<form class="" action="includes/login.inc.php" method="post" onsubmit="return Validate()" name="vform">


                 <div class="login-box">
                 <form method="post">

                   <h3>Login</h3>
                   <div class="textbox">
                   <i class="fas fa-user"></i>

                     <input type="text" placeholder="User Name" name="uid" id="uid" value="">
                   </div>
                   <div class="" align="middle" style="color:Red" id="username_error"></div>

                   <div class="textbox">
                   <i class="fas fa-lock"></i>
                     <input type="password" placeholder="Password" name="pwd" id="pwd" value="">
                   </div>
                   <div class="" align="middle" style="color:Red" id="password_error"></div>
                   <input class="btn btn-success" type="submit" name="submit" value="Login" onclick="Validate()">
                   </form>

                 </div>


                 </form>';
            }
 ?>





<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
