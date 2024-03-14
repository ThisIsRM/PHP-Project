<?php include('partials-front/menu.php'); ?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<br>
<center>
<img src="images/cakes3.gif" alt="Restaurant Logo" class="img-responsive" style="width:160px;height:130px;">
<img src="images/cakes3.gif" alt="Restaurant Logo" class="img-responsive" style="width:160px;height:130px;">
<img src="images/cakes3.gif" alt="Restaurant Logo" class="img-responsive" style="width:160px;height:130px;">
</center>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center b"><b><p style="font-family:Edwardian Script ITC">Explore All the Sweet Bakes with a fresh auroma...</p></b></h2>

        <?php

        //Display all the cateories that are active
        //Sql Query
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Count Rows
        $count = mysqli_num_rows($res);

        //CHeck whether categories available or not
        if ($count > 0) {
            //CAtegories Available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the Values
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>

                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            //Image not Available
                            echo "<div class='error'>Image not found.</div>";
                        } else {
                            //Image Available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="item" class="img-responsive img-curve category-card-image">
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
            //CAtegories Not Available
            echo "<div class='error'>Category not found.</div>";
        }

        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>