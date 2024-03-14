    <?php include('partials-front/menu.php'); ?>
        <body style="background:#eaeafb">
    <!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->


    <div style="text-align:center;"><br>
    <img src="images/cakes4.gif" alt="Restaurant Logo" class="img-responsive" style="width:120px;height:130px;">
    <img src="images/cakes5.gif" alt="Restaurant Logo" class="img-responsive" style="width:140px;height:130px;">
    
    <h1><p style="font-family:gabriola" class="text-center" ><br><br> Sweet Confections include sweet, sugar-based foods, which are usually eaten as snack food. <br>
        This includes sugar candies, chocolates, candied fruits and nuts, chewing gum, and sometimes ice cream. <br>
        Specially formulated chocolate has been manufactured in the past for military use as a high- density food energy source.<br></p></h1>
    </div>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
    if (isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center b"><b><p style="font-family:Harrington">Explore All the Sweet Bakes with a fresh auroma...</p></b></h2>

            <?php
            //Create SQL Query to Display CAtegories from Database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 10";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //CAtegories Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the Values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

            ?>

                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>"style="font-family:Harrington" >
                        <div class="box-3 float-container">
                            <?php
                            //Check whether Image is available or not
                            if ($image_name == "") {
                                //Display MEssage
                                echo "<div class='error'>Image not Available</div>";
                            } else {
                                //Image Available
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="product" class="img-responsive img-curve category-card-image">
                            <?php
                            }
                            ?>

                            <br><br><br>
                            <h1 class=" a text-center" style="font-family:Edwardian Script ITC"><?php echo $title; ?></h1>
                        </div>
                    </a>

            <?php
                }
            } else {
                //Categories not Available
                echo "<div class='error'>Category not Added.</div>";
            }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center b"><b><p style="font-family:Harrington">Bakery Items Menu</p></b></h2>

            <?php

            //Getting Foods from Database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 10";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Count Rows
            $count2 = mysqli_num_rows($res2);

            //CHeck whether food available or not
            if ($count2 > 0) {
                //Food Available
                while ($row = mysqli_fetch_assoc($res2)) {
                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    $discount = $row['discount'];

            ?>

                    <div class="food-menu-box" >
                        <div class="food-menu-img">
                            <?php
                            //Check whether image available or not
                            if ($image_name == "") {
                                //Image not Available
                                echo "<div class='error'>Image not available.</div>";
                            } else {
                                //Image Available
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="item" class="img-responsive img-curve card-image">
                            <?php
                            }
                            ?>

                        </div>

                        <div class="food-menu-desc">
                            <h4 style="font-family:Harrington"><?php echo $title; ?></h4>
                            <p class="food-price" style="font-family:Harrington">
                                <?php

                                //calculating discount
                                if ($discount == '0%') {
                                    echo ('₹' . $price . "<br><br>");
                                } else if ($discount == '25%') {
                                    echo ('Real Price: ₹' . ($price) . "<br>");
                                    echo ('Discounted Price: ₹' . (0.75 * $price));
                                } else if ($discount == '40%') {
                                    echo ('Real Price: ₹' . ($price) . "<br>");
                                    echo ('Discounted Price: ₹' . (0.6 * $price));
                                } else if ($discount == '50%') {
                                    echo ('Real Price: ₹' . ($price) . "<br>");
                                    echo ('Discounted Price: ₹' . (0.5 * $price));
                                }

                                ?>
                            </p>
                            <p class="food-detail" style="font-family:Harrington">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>customercart.php?food_id=<?php echo $id; ?>" class="btn btn-primary" style="font-family:Algerian">Add to Cart</a>
                        </div>
                    </div>

            <?php
                }
            } else {
                //Food Not Available 
                echo "<div class='error'>Food not available.</div>";
            }

            ?>





            <div class="clearfix"></div>



        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php" style="font-family:Harrington">See All Bakery Items available</a>

        </p>
    </section>
    <!-- fOOD Menu Section Ends Here <a href="#">See All Foods</a>-->

        </body>
    <?php include('partials-front/footer.php'); ?>