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
    <main class="container">
        <form action="" method="post" id="payment-form">
            <div class="form-rowrow">
                <div class="col">
                    <h3 class="title">Payment</h3>
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
                <div id="card-element" class="form-control">

              <!-- a Stripe Element will be inserted here. -->
                    <div id="card-errors" role="alert"></div>
                </div>
            </div>
            <button>Submit Payment</button>
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
        </style>
  </main>
            
            
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="./js/payment/charge.js"></script>
</body>
</html>