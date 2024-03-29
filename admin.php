<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <?php include "./includes/head.inc.php" ?>
        <title>Admin</title>

        <!-- libraries for statistics section -->
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
        <?php include "includes/nav-black.inc.php"; ?>
        <!-- modal -->
    </div>
    
    <!-- cart icon -->
    <div class="toggle-container">
        <button class="toggle-cart">
            <i class="fas fa-shopping-cart"></i>
        </button>
        <span class="cart-item-count">0</span>
    </div>
</div>
</nav> 
<?php include "includes/sidebar.php"; ?>
<div class="cart-overlay">
    <aside class="cart">
        <button class="cart-close">
            <i class="fas fa-times"></i>
        </button>
        <header>
            <h3 class="text-slanted">your bag</h3>
        </header>
        <!-- cart items -->
        <div class="cart-items"></div>
        <!-- footer -->
        <footer>
            <h3 class="cart-total text-slanted">
                total: $12.00
            </h3>
            <button class="cart-checkout btn">checkout</button>
        </footer>
    </aside>
</div>
<?php
global $adminMode;
//Check if admin is enabled
if ($adminMode == 1) {

    echo'<div class="modal-overlay">
            <div class="modal-container">
                <form class="form delete"  data-form_type="delete-product">
                    <h3>Product ID: 123</h3>
                    <p class="alert "></p>
                    <div class="form-row">
                        <label for="delete" class="form-label">Type the product id to confirm delete:</label>
                        <input type="number" name="productID" class="form-input" value="">
                    </div>
                    <button type="submit" class="btn btn-block">comfirm</button>
                </form>
                <button class="close-btn"><i class="fas fa-times"></i></button>
                </div>
        </div>';
}
?>
<!-- end modal -->
<!-- dashboard tab -->
<?php
global $adminMode;
if ($adminMode == 1) {
    ?>
    <div class="dashboard-center section-center">
        <article class="dashboard">
            <!-- btn container -->
            <div class="btn-container">
                <button class="tab-btn active" data-id="product">Products</button>
                <button class="tab-btn" data-id="order">Orders</button>
                <button class="tab-btn" data-id="user">Users</button>
                <button class="tab-btn" data-id="statistic">Statistics</button>
            </div>
            <div class="dashboard-content">
                <!-- tab info -->
                <div class="content active" id="product">
                    <div class="table-center">
                        <div class="table product">
                            <div class="table-row">
                                <div class="item-display">
                                    <div class="item-btns"></div>
                                    <div class="item-info">
                                        <div class="item-col">Product ID</div>
                                        <div class="item-col">Name</div>
                                        <div class="item-col">Brand</div>
                                        <div class="item-col">Price</div>
                                    </div>
                                </div>
                            </div>
                            <!--Items here-->
                            <div class="table-row add">
                                <!-- add product btn -->
                                <button class="btn add_product-btn product_form-open-btn" data-form_type="add">Add Products</button>
                                <!-- edit form -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end of tab info -->
                <!-- tab info -->
                <div class="content" id="order">
                    <div class="table-center">
                        <div class="table order">
                            <div class="table-row">
                                <div class="item-display">
                                    <div class="item-btns"></div>
                                    <div class="item-info">
                                        <div class="item-col">Order Detail</div>
                                        <div class="item-col">Product Name</div>
                                        <div class="item-col">Price</div>
                                        <div class="item-col">UserID</div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>



                </div>
                <!-- end of tab info -->
                <!-- tab info -->
                <div class="content" id="user">
                    <div class="table-center">
                        <div class="table user">
                            <div class="table-row">
                                <div class="item-display">
                                    <div class="item-btns"></div>
                                    <div class="item-info">
                                        <div class="item-col">Order Detail</div>
                                        <div class="item-col">Product Name</div>
                                        <div class="item-col">Price</div>
                                        <div class="item-col">UserID</div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end of tab info -->
                <!-- tab info -->
                <div class="content" id="statistic">
                    <?php include "includes/statistics.php"; ?>
                </div>
                <!-- end of tab info -->
            </div>
        </article>
    </div>
    <script type="module" src="js/pages/admin.js"></script>';
<?php } ?>
<script type="module" src="js/toggleSidebar.js"></script>
<script type="module" src="js/cart/setupCart.js"></script>
<script type="module" src="js/cart/toggleCart.js"></script> 
</body>
</html>