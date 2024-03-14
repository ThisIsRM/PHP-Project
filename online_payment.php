<?php include('partials-front/menu.php'); ?>
<section class="online-payment">
    <div class="container">
        <h2 class="text-center b"><b><p style="font-family:Edwardian Script ITC">Online payment</p></b></h2>

        <?php
        if (isset($_SESSION['totamt'])) //Checking whether the SEssion is Set of Not
        {
            echo $_SESSION['totamt']; //Display the SEssion Message if SEt
            unset($_SESSION['totamt']); //Remove Session Message
        }
        ?>


        <?php

        $bill_no = $_SESSION['bill2'];
        $customer_id = $_SESSION['cust1'];
        if (!$customer_id) {
            $customer_id = $_SESSION['cust2'];
        }
        //Query to Get all CAtegories from Database
        $sql = "SELECT * FROM tbl_bill WHERE bill_no = $bill_no";

        //Execute Query
        $res = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $amount = $row['amount'];
        }
        ?>
        <h3 class="text-center b"><b><p style="font-family:Harrington">Your total amount to pay is ₹ <?php echo $amount; ?>.</h3>

        <form action="" method="POST" class="online-payment">
            <fieldset>

                <div class="order-label">Please enter your card details </div>
                


                <div class="order-label">Card number</div>
                <input type="number" name="card" placeholder="xxxxxxxxxx" class="input-responsive" required>

                <div class="order-label">Amount</div>
                <input type="number" name="amount" placeholder=" ₹xxxx" class="input-responsive" required>

                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </fieldset>

        </form>
        <?php

        if ((isset($_POST['submit'])) and (($_POST['amount'] != $amount))) {
            $_SESSION['totamt'] = "<div class='error'>Please add correct value for amount.</div>";
            //Redirect Page to online_payment.php
            header("location:" . SITEURL . 'online_payment.php');
        } elseif (isset($_POST['submit'])) {
            // Get all the details from the form
            $type = $_POST['type'];
            $number = $_POST['card'];


            //Save the Order in Databaase
            //Create SQL to save the data

            $sql2 = "UPDATE tbl_bill SET 
    bill_status='Delivered',
    card_type = '$type',
    card_number = $number
    WHERE bill_no=$bill_no";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);
            $sql3 = "UPDATE tbl_cart SET cart_status='inactive' WHERE customer_id=$customer_id";
            $res3 = mysqli_query($conn, $sql3);

            //Check whether query executed successfully or not
            if ($res2 == true) {
                header('location:' . SITEURL . 'final.php');
            } else {
                echo 'order not placed correctly please retry';
            }
        }
        ?>
        <?php include('partials-front/footer.php'); ?>