<?php include('partials-front/menu.php'); ?>

<?php
$bill_no = $_SESSION['bill1'];

$customer_id = $_SESSION['cust1'];
if (!$customer_id) {
    $customer_id = $_SESSION['cust2'];
}

//Query to Get all CAtegories from Database
$sql = "SELECT * FROM tbl_bill WHERE bill_no = $bill_no";

//Execute Query
$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $address = $row['customer_address'];
    $amount = $row['amount'];
}
$sql2 = "UPDATE tbl_bill SET bill_status='Delivered' WHERE bill_no=$bill_no";
$res2 = mysqli_query($conn, $sql2);
$sql3 = "UPDATE tbl_cart SET cart_status='inactive' WHERE customer_id=$customer_id";
$res3 = mysqli_query($conn, $sql3);



?>

<section class="payment">
    <div class="container">
        <br><br>
        <h2 class="text-center b" style="font-family:gabriola">Thank you for shopping with Sweet Confections Bakery!</h2>
        <br><br><br>

        <h2 class="text-center b" style="font-family:gabriola">Your order will be arriving shortly to this given address: <?php echo $address; ?></h2><br><br>
        <h2 class="text-center b" style="font-family:gabriola">Please pay ₹ <?php echo $amount; ?> to the delivery agent.</h2>

        <br><br><br>
        <a href="<?php echo SITEURL; ?>feedback.php" class="btn btn-primary">Share your Feedback!</a>


        <?php include('partials-front/footer.php'); ?>