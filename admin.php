<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <?php include "./includes/head.inc.php" ?>
        <title>Admin</title>
    </head>
    <body>
         <?php include "includes/nav-black.inc.php"; ?>
        <!-- modal -->
        <div class="modal-overlay">
            <div class="modal-container">
                <form class="form"  data-form_type="delete-product">
                    <h3>Product ID: 123</h3>
                    <div class="form-row">
                        <label for="delete" class="form-label">Type the product id to comfirm delete:</label>
                        <input type="email" name="delete" class="form-input" value="">
                    </div>
                    <button type="submit" class="btn btn-block">comfirm</button>
                    <button type="button" class="btn btn-block btn-hipster">cancel</button>
                </form>
                <button class="close-btn"><i class="fas fa-times"></i></button>
                </div>
        </div>
        <!-- end modal -->
        <!-- dashboard tab -->
        <div class="dashboard-center section-center">
            <article class="dashboard">
                <!-- btn container -->
                <div class="btn-container">
                    <button class="tab-btn active" data-id="history">Products</button>
                    <button class="tab-btn" data-id="vision">Orders</button>
                    <button class="tab-btn" data-id="goals">Users</button>
                </div>
                <div class="dashboard-content">
                    <!-- tab info -->
                    <div class="content active" id="history">
                        <div class="table-center">
                            <div class="table">
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
                            <!-- delete all & import csv -->
                            <div class="products-btns">
                                <button class="btn deleteAll-btn">Delete All Products</button>
                                <button class="btn importCSV-btn">import CSV</button>
                            </div>
                        </div>
                    </div>
                    <!-- end of tab info -->
                    <!-- tab info -->
                    <div class="content" id="vision">
                        <h4>vision</h4>
                        <p>
                            Man bun PBR&B keytar copper mug prism, hell of helvetica. Synth
                            crucifix offal deep v hella biodiesel. Church-key listicle
                            polaroid put a bird on it chillwave palo santo enamel pin,
                            tattooed meggings franzen la croix cray. Retro yr aesthetic four
                            loko tbh helvetica air plant, neutra palo santo tofu mumblecore.
                            Hoodie bushwick pour-over jean shorts chartreuse shabby chic.
                            Roof party hammock master cleanse pop-up truffaut, bicycle
                            rights skateboard affogato readymade sustainable deep v
                            live-edge schlitz narwhal.
                        </p>
                        <ul>
                            <li>list item</li>
                            <li>list item</li>
                            <li>list item</li>
                        </ul>
                    </div>
                    <!-- end of tab info -->
                    <!-- tab info -->
                    <div class="content" id="goals">
                        <h4>goals</h4>
                        <p>
                            Chambray authentic truffaut, kickstarter brunch taxidermy vape
                            heirloom four dollar toast raclette shoreditch church-key.
                            Poutine etsy tote bag, cred fingerstache leggings cornhole
                            everyday carry blog gastropub. Brunch biodiesel sartorial mlkshk
                            swag, mixtape hashtag marfa readymade direct trade man braid
                            cold-pressed roof party. Small batch adaptogen coloring book
                            heirloom. Letterpress food truck hammock literally hell of wolf
                            beard adaptogen everyday carry. Dreamcatcher pitchfork yuccie,
                            banh mi salvia venmo photo booth quinoa chicharrones.
                        </p>
                    </div>
                    <!-- end of tab info -->
                </div>
            </article>
        </div>
        <?php 
//            echo "hello";
//            $config = parse_ini_file('../../private/db-config.ini');
//            echo $config['servername'];
//            echo $config['username'];
//            echo $config['password'];
//            echo $config['dbname'];
//            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        ?>
        <script type="module" src="js/pages/admin.js"></script>
    </body>
</html>