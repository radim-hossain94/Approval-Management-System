
<!DOCTYPE html>
<html lang="en">
<head>

    <title>METAL</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<!--Bootsrap 4 CDN-->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

      <!--Fontawesome CDN-->
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  	<!--Custom styles-->
  	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<style media="screen">
@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
      margin: 10;
      padding: 100;
      font-family: sans-serif;
      background-image: url("images/test1.jpg");
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;

    }

    body, html {
      height: 100%;
    }

.container{
height: 100%;
align-content: center;
}

.card{
height: 370px;
margin-top:20%;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
</style>







  <body>


<?php

  if (isset($_SESSION['u_id'])) {
              echo
              '
              ';
            }
            else {  ?>

              <form class="" action="includes/login.inc.php" method="post" onsubmit="return Validate()" name="vform">

              <div class="container">
               <div class="d-flex justify-content-center h-100">
                 <div class="card">

               <div class="card-header">
                  <h3>Sign In</h3>
                   <div class="d-flex justify-content-end social_icon">
                      <a href="https://www.facebook.com/metalbd" target="_blank"> <span><i class="fab fa-facebook-square"></i></span></a>
                       <span><i class=""></i></span>
                       <span><i class=""></i></span>
                       <span><i class=""></i></span>

                       <!-- <span><i class="fab fa-google-plus-square"></i></span>
                       <span><i class="fab fa-twitter-square"></i></span> -->
                  </div>


              </div>

                         <div class="card-body">
                     <form>
<br>
                         <!-- <div class="input-group form-group">
                           <div class="input-group-prepend">
                             <span class="input-group-text" ><i class="fas fa-user"></i></span>
                          </div>
                              <input type="text" class="form-control" name="" id="" value="ADMIN" readonly>
                          </div> -->

                         <div class="input-group form-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-user"></i></span>
                           </div>
                                <input type="text" class="form-control" name="uid" id="uid" value="" placeholder="Username">
                         </div>




                       <div class="input-group form-group">
                         <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fas fa-key"></i></span>
                          </div>
                         <input type="password" class="form-control" name="pwd" id="pwd" value="" placeholder="password">
                       </div>



                      <?php if( !empty( $_REQUEST['Message'] ) )
                          {
                          ?>
                          <div class="" align="middle" style="color:Red" id="">
                             <?php echo sprintf($_REQUEST['Message']); ?>
                         </div>
                          <?php
                          }

                          else{    ?>

                        <div class="" align="middle" style="color:Red" id="username_error"></div>
                           <div class="" align="middle" style="color:Red" id="password_error"></div>

                            <?php } ?>
<br>
                            <div class="form-group">
                            <input type="submit" name="submit" value="Login" onclick="Validate()" class="btn float-right login_btn">
                          </div>
                      </form>
                    </div>
                 <div class="card-footer">
               </div>
             </div>
              </div>
                </div>
                 </form>

          <?php
            }
          ?>


</body>
</html>


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
