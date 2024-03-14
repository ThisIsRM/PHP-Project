<?php include('partials-front/menu.php'); ?>
<link rel="stylesheet" href="css/admin.css">

<br><br>
<div class="main-content">
    <div class="wrapper">
        <h1><b><p style="font-family:Edwardian Script ITC">Feedback</p></b></h1>
        <img src="images/thank.gif" alt="Cart Logo" class="img-responsive" style="width:120px;height:130px;">

        <br><br>

        
        <?php
        if (isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
        {
            echo $_SESSION['add']; //Display the SEssion Message if SEt
            unset($_SESSION['add']); //Remove Session Message
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td><b><p style="font-family:Harrington">Full Name : </p></b></td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">

                    </td>
                </tr>

                <tr>
                    <td><b><p style="font-family:Harrington">Feedback : </p></b></td>
                    <td>
                        <input type="text" name="feedback" placeholder="Your Feedback" style="height:100px;">
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="submit" class="btn-secondary" style="font-family:Harrington">
                    </td>
                </tr>

            </table>

        </form>
        
        
        <?php
        //Process the Value from Form and Save it in Database

        //Check whether the submit button is clicked or not

        if (isset($_POST['submit'])) {
            // Button Clicked
            //echo "Button Clicked";

            //1. Get the Data from form
            $full_name = $_POST['full_name'];
            $feedback = $_POST['feedback'];




            //2. SQL Query to Save the data into database
            $sql = "INSERT INTO tbl_feedback SET 
            customer_name='$full_name',
            customer_feedback='$feedback'
            ";

            //3. Executing Query and Saving Data into Datbase
            $res = mysqli_query($conn, $sql); //or die(mysqli_connect_error());
            //echo $res;
            //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
            if ($res == TRUE) {
                //Data Inserted
                //echo "Data Inserted";
                //Create a Session Variable to Display Message
                $_SESSION['add'] = "<div class='success'>Feedback Submitted.</div>";
                //Redirect Page to Manage Admin
                header("location:" . SITEURL . 'index.php');
            } else {
                //FAiled to Insert DAta
                //echo "Faile to Insert Data";
                //Create a Session Variable to Display Message
                $_SESSION['add'] = "<div class='error'>Failed to submit feedback.</div>";
                //Redirect Page to Add Admin
                header("location:" . SITEURL . 'feedback.php');
            }
        }

        ?>
    </div>
</div>
<div class="main-content">
<center> <h4><b><p style="font-family:Harrington">Please rate your experience with us</p></b></h4>
        <div class="stars">
  <form action="">
    <input class="star star-5" id="star-5" type="radio" name="star"/>
    <label class="star star-5" for="star-5"></label>
    <input class="star star-4" id="star-4" type="radio" name="star"/>
    <label class="star star-4" for="star-4"></label>
    <input class="star star-3" id="star-3" type="radio" name="star"/>
    <label class="star star-3" for="star-3"></label>
    <input class="star star-2" id="star-2" type="radio" name="star"/>
    <label class="star star-2" for="star-2"></label>
    <input class="star star-1" id="star-1" type="radio" name="star"/>
    <label class="star star-1" for="star-1"></label>
  </form>
</div>
</center>
</div>

<style>
div.stars {
  width: 270px;
  display: inline-block;
}
input.star { display: none; }
label.star 
{
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}
input.star:checked ~ label.star:before {
  content: '\f005';
  background-color:  #cc99ff;
  padding: -20px ;
  color:  #cc99ff;
  transition: all .25s;
}
input.star-5:checked ~ label.star:before 
{
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }
label.star:hover { transform: rotate(-15deg) scale(1.3); }
label.star:before 
{
  content: '\f006';
  font-family: FontAwesome;
}
</style>

<br><br>
<?php include('partials-front/footer.php'); ?>