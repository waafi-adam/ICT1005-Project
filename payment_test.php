<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Payment</title>
      
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"

    />
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



<body>
    
    <main class="container">
        <form action="process_payment.php" method="post" id="payment-form">
            <div class="form-rowrow">
                <div class="col">
                    <h3 class="title">Payment and Billing Address</h3>
                    <div class="inputBox">
                        <span>Cards accepted:</span>
                        <img src="images/card_img.png" alt="">
                    </div>   
                </div>
                <div class="inputBox">
                    <input type="text" id="name" name="name" class="form-control mb-3 StripeElement StripeElement--empty" 
                            placeholder="Enter Name on card">
                </div>    
                <div class="inputBox"> 
                    <input type="email" id="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" 
                            accesskey="" placeholder="Email Address">
                </div>
                <div class="inputBox">
                    <input type="text" id="address" name="address" class="form-control mb-3 StripeElement StripeElement--empty" 
                             placeholder="Shipping Address">
                </div>
                <div id="card-element" class="form-control">

              <!-- a Stripe Element will be inserted here. -->
                    <div id="card-errors" role="alert"></div>
                </div>
            </div>
            <button class="submit-btn">Submit Payment</button> 
            
        </form>
      
        <style>
          .StripeElement {
            background-color: white;
            height: 40px;
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
            }

            .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
            }

            .StripeElement--invalid {
            border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
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
  </main>
            
            
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="./js/payment/charge.js"></script>
</body>
</html>