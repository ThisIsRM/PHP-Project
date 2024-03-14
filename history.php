<?php include('partials-front/menu.php'); ?>
<section class="food-menu">
    <div class="container">
        <h1 class="text-center b"><b><p style="font-family:Harrington">Previous Orders</p></b></h1>
        <center> <img src="images/feedback.gif" alt="Cart Logo" class="img-responsive" style="width:120px;height:130px;"> </center>
        <br><br><br>
        <style>
            table,
            td,
            th {

                border: 1px solid #ddd;
                text-align: left;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th,
            td {
                padding: 15px;
            }
        </style>
        <table>
            <tr>
                <th><h1><b><p style="font-family:Blackadder ITC">S.No</p></b></th></h1>
                <th><h1><b><p style="font-family:Blackadder ITC">Product</p></b></th></h1>
                <th><h1><b><p style="font-family:Blackadder ITC">Image</p></b></th></h1>
                <th><h1><b><p style="font-family:Blackadder ITC">Dietary Restrictions</p></b></th></h1>
                <th><h1><b><p style="font-family:Blackadder ITC">Price</p></b></th></h1>
                <th><h1><b><p style="font-family:Blackadder ITC">Quantity</p></b></th></h1>
                <th><h1><b><p style="font-family:Blackadder ITC">Total Price</p></b></th></h1>
            </tr>
            <?php
            $customer_id = $_SESSION['cust1'];
            if (!$customer_id) {
                $customer_id = $_SESSION['cust2'];
            }

            //Query to Get all CAtegories from Database
            $sql = "SELECT * FROM tbl_cart WHERE customer_id=$customer_id and cart_status='inactive'";

            //Execute Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Create Serial Number Variable and assign value as 1
            $sn = 1;

            //Check whether we have data in database or not
            if ($count > 0) {
                //We have data in database
                //get the data and display
                while ($row = mysqli_fetch_assoc($res)) {
                    $name = $row['product_name'];
                    $price = $row['product_price'];
                    $image = $row['product_image'];
                    $quantity = $row['product_quantity'];
                    $diet = $row['diet'];
                    $tprice = $row['product_totalprice'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $name; ?></td>

                        <td>

                            <?php
                            //Check whether image name is available or not
                            if ($image != "") {
                                //Display the Image
                                //echo $image;
                            ?>

                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image; ?>" class="img-responsive img-curve card-image">


                            <?php
                            } else {
                                //DIsplay the MEssage
                                echo "<div class='error'>Image not Added.</div>";
                            }
                            ?>

                        </td>

                        <td><?php echo $diet; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $tprice; ?></td>

                    </tr>


            <?php

                }
            }

            ?>