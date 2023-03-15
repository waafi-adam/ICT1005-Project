<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment</title>
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />

    <!-- styles css -->
    <link rel="stylesheet" href="css/styles.css" />
  </head>
    <body>
            <!--     navbar -->
        
          
        <!-- hero -->
        <section class="page-hero">
          <div class="section-center">
            <h3 class="page-hero-title">
              Payment
            </h3>
          </div>
        </section>

<!--         sidebar 
        <div class="sidebar-overlay">
          <aside class="sidebar">
             close 
            <button class="sidebar-close">
              <i class="fas fa-times"></i>
            </button>
             links 
            <ul class="sidebar-links">
              <li>
                <a href="index.html" class="sidebar-link">
                  <i class="fas fa-home fa-fw"></i>
                  home
                </a>
              </li>
              <li>
                <a href="products.html" class="sidebar-link">
                  <i class="fas fa-couch fa-fw"></i>
                  products
                </a>
              </li>
              <li>
                <a href="about.html" class="sidebar-link">
                  <i class="fas fa-book fa-fw"></i>
                  about
                </a>
              </li>
            </ul>
          </aside>
        </div>-->
<!--         cart 
        <div class="cart-overlay">
          <aside class="cart">
            <button class="cart-close">
              <i class="fas fa-times"></i>
            </button>
            <header>
              <h3 class="text-slanted">your bag</h3>
            </header>
             cart items 
            <div class="cart-items"></div>
             footer 
            <footer>
              <h3 class="cart-total text-slanted">
                total: $12.00
              </h3>
              <button class="cart-checkout btn">checkout</button>
            </footer>
          </aside>
        </div>-->
        
        <!-- Payment -->
        <main class="container"> 
            <!-- display errors returned by createToken -->
            <span class="payment-errors"></span>
            
            <form action="">

            <div class="row">

                <div class="col">

                    <h3 class="title">billing address</h3>

                    <div class="inputBox">
                        <span>Full name:</span>
                        <input type="text" id="fName" name="fName"
                               placeholder="Enter Full Name">
                    </div>
                    <div class="inputBox">
                        <span>Email:</span>
                        <input type="email" id="email" name="email"
                               placeholder="example@example.com">
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

                <div class="col">

                    <h3 class="title">payment</h3>

                    <div class="inputBox">
                        <span>Cards accepted:</span>
                        <img src="images/card_img.png" alt="">
                    </div>
                    <div class="inputBox">
                        <span>Name on card:</span>
                        <input type="text" id="name" name="name"
                               placeholder="Enter Name">
                    </div>
                    <div class="inputBox">
                        <span>Credit card number:</span>
                        <input type="number" id="cNum" name="cNum"
                               placeholder="1111-2222-3333-4444">
                    </div>
                    <div class="inputBox">
                        <span>Expiry month:</span>
                        <input type="text" id="eMonth" name="eMonth"
                               placeholder="january">
                    </div>

                    <div class="flex">
                        <div class="inputBox">
                            <span>Expiry year:</span>
                            <input type="number" id="eYear" name="eYear"
                                   placeholder="2023">
                        </div>
                        <div class="inputBox">
                            <span>CVV:</span>
                            <input type="text" id="cvv" name="cvv"
                                   placeholder="1234">
                        </div>
                    </div>

                </div>

            </div>

            <input type="submit" value="proceed to checkout" class="submit-btn">

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
