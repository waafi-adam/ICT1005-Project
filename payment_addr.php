<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Billing Address</title>
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />

    <!-- styles css -->
    <link rel="stylesheet" href="css/styles.css" />
  </head>
    <body>
      <!-- To check if user is login else redirect -->
       <?php include "includes/checkSession.php"; 
             $userID=$_SESSION['userID'];
             if(!$userID){
                 $_SESSION['message'] = "Please login before checking out.";
                 header("Location: http://35.212.148.163/login.php");
                 exit();
             }
       ?>
       <?php include "includes/nav-white.inc.php"; ?> 
       <?php include "includes/sidebar.php"; ?>
        
       
               
        <!-- hero -->
        <section class="page-hero">
          <div class="section-center">
            <h3 class="page-hero-title">
              Billing Address
            </h3>
          </div>
        </section>
        
        <!-- Payment -->
        <main class="container"> 
            <!-- display errors returned by createToken -->
            <span class="payment-errors"></span>
            
            <form action="process_payment.php" method="post">

            <div class="row">

                <div class="col">

                    <h3 class="title">Billing address</h3>

                    <div class="inputBox">
                        <span>Full name:</span>
                        <input type="text" id="fName" name="fName"
                               placeholder="Enter Full Name">
                    </div>
                    <div class="inputBox">
                        <span>Email:</span>
                        <input type="email" id="email" name="email"
                               required placeholder="Enter email" class="form-control">
                    </div>
                    <div class="inputBox">
                        <span>Address:</span>
                        <input type="text" id="address" name="address"
                               placeholder="room - street - locality">
                    </div>
                    <div class="inputBox">
                        <span>City:</span>
                        <input type="text" id="city" name="city"
                               placeholder="Singapore">
                    </div>

                    <div class="flex">
                        <div class="inputBox">
                            <span>State:</span>
                            <input type="text" id="state" name="state"
                                   placeholder="Singapore">
                        </div>
                        <div class="inputBox">
                            <span>zip code:</span>
                            <input type="text" id="zcode" name="zcode"
                                   placeholder="123 456">
                        </div>
                    </div>

                </div>
            </div>

            
            <input type="submit" value="proceed to checkout" class="submit-btn" formaction="payment_test.php">

        </form>

            
        <style>
           

            *{
              font-family: 'Poppins', sans-serif;
              margin:0; padding:0;
              box-sizing: border-box;
              outline: none; border:none;
              text-transform: capitalize;
              transition: all .2s linear;
            }

            .container{
              display: flex;
              justify-content: center;
              align-items: center;
              padding:25px;
              min-height: 100vh;
              background: linear-gradient(90deg, #CBDAE1 60%, #F0F3F3 40.1%);
            }

            .container form{
              padding:20px;
              width:700px;
              background: #fff;
              box-shadow: 0 5px 10px rgba(0,0,0,.1);
            }

            .container form .row{
              display: flex;
              flex-wrap: wrap;
              gap:15px;
            }

            .container form .row .col{
              flex:1 1 250px;
            }

            .container form .row .col .title{
              font-size: 20px;
              color:#333;
              padding-bottom: 5px;
              text-transform: uppercase;
            }

            .container form .row .col .inputBox{
              margin:15px 0;
            }

            .container form .row .col .inputBox span{
              margin-bottom: 10px;
              display: block;
            }

            .container form .row .col .inputBox input{
              width: 100%;
              border:1px solid #ccc;
              padding:10px 15px;
              font-size: 15px;
              text-transform: none;
            }

            .container form .row .col .inputBox input:focus{
              border:1px solid #000;
            }

            .container form .row .col .flex{
              display: flex;
              gap:15px;
            }

            .container form .row .col .flex .inputBox{
              margin-top: 5px;
            }

            .container form .row .col .inputBox img{
              height: 34px;
              margin-top: 5px;
              filter: drop-shadow(0 0 1px #000);
            }

            .container form .submit-btn{
              width: 100%;
              padding:12px;
              font-size: 17px;
              background: #F0F3F3;
              color:#fff;
              margin-top: 5px;
              cursor: pointer;
            }

            .container form .submit-btn:hover{
              background: #CBDAE1;
            }
        </style>
        
    </body>
</html>
