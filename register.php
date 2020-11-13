<!DOCTYPE php>
<html>
<head>
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/login.css">
<link href="https://fonts.googleapis.com/css2?family=Nunito&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<style>

.error {color: #FF0000;}
.form_input input{
  border: 1px solid lightgray;
}

.form_input input:focus, input:hover, input:active, .column3 .btn:hover {
  border: 1px solid black;
}
</style>
</head>
<body>

  <!-- NAVIGATION STARTS -->

  <nav>
    <!--burger is the icon for the drop down menu-->

    <div class="logo">
      <a href="index.php">
        <header>XGAMES</header>
      </a>
    </div>

    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="product_page.php">Products</a></li>
      <?php
        $file = 'user.txt';
        if($handle = fopen($file, 'r')) { // read this Hello World! from filetest.txt
           // fill in your own code. Hint! each character is 1 byte
            $content = fread($handle,12);
            fclose($handle);
        }
        if(trim(file_get_contents('user.txt')) == false){

         echo "<li><a href=\"login.php\">Login</a></li>";
        }else{
          echo "Welcome  $content";
          echo "<li><a href=\"logout.php\">Logout</a></li>";
        }

      ?>
    </ul>
  </nav>
  <!-- NAVIGATION ENDS -->

<?php
// Reference from https://www.w3schools.com/php/php_form_complete.asp
$nameErr = $emailErr = $numberErr = $passwordErr = "";
$name = $email = $number = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = $_POST["name"];
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = $_POST["email"];
  }

  if (empty($_POST["number"])) {
    $numberErr = "Phone number is required";
  } else {
    $number = $_POST["number"];
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = $_POST["password"];
  }
}

//Saving data to textfile https://www.dummies.com/programming/php/how-to-write-a-basic-text-file-in-php-for-html5-and-css3-programming/
/*
$saveData = <<< HERE
$email|$password|$name|$number

HERE;
 $fp = fopen("data.txt", "a");
 fwrite($fp, $saveData);
 fclose($fp);

function test_input($data) {
  return $data;
}*/
?>
<div class="register-box">
  <div class="register-container">
<p><span class="error"></span></p>
<form method="post" class="form_input_center">
  <h2>Register</h2><br>
  <label for="inputname">Full name</label>
  <input type="text" class="form-text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br>
  <label for="inputemail">Email</label>
  <input type="text" class="form-text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br>
  <label for="inputemail">Phone Number</label>
  <input type="text" class="form-text" name="number" value="<?php echo $number;?>">
  <span class="error">* <?php echo $numberErr;?></span>
  <br>
  <label for="inputemail">Password</label>
  <input type="text" class="form-text" name="password" value="<?php echo $password;?>">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br>
  <input type="submit" class="buy-btn1" name="submit" value="Submit">
</form>
</div>
</div>

<?php
require_once('connection.php');
session_start();
if(isset($_POST['submit']))
    {
       if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['number']) || empty($_POST['password']))
       {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_POST["name"])) {
            $nameErr = "Name is required";
          } else {
            $name = test_input($_POST["name"]);
          }

          if (empty($_POST["email"])) {
            $emailErr = "Email is required";
          } else {
            $email = test_input($_POST["email"]);
          }

          if (empty($_POST["number"])) {
            $numberErr = "Phone number is required";
          } else {
            $number = test_input($_POST["number"]);
          }

          if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
          } else {
            $password = test_input($_POST["password"]);
          }
        }

       }
       else
       {

        $query="select * from users where email='".$_POST['email']."'";
      $check=mysqli_query($connection,$query);

      if(mysqli_fetch_assoc($check))
      {
        echo 'Account existed!';
      }else{

        $name = addslashes($_POST['name']);
        $email = addslashes($_POST['email']);
        $phone_no = addslashes($_POST['number']);
        $password = addslashes($_POST['password']);

            $query2= "INSERT INTO users (email, password, name, phone_no) VALUES (
              '{$email}', '{$password}', '{$name}', '{$phone_no}')";


            $result=mysqli_query($connection,$query2);

            if(mysqli_fetch_assoc($result))
            {
              $_SESSION['User']=$_POST['email'];
              $_SESSION['Name']=$_POST['name'];
              echo 'Register Successful!';
            }else{
              
            }

       }
    }
  }

?>


<!--begin footer-->
<div class="footer">
  <div class="inner-footer">

    <div class="footer-items">
      <h2> XGAMES </h2>
      <p> Sells The Trendiest Video Games</p>
    </div>
    <div class="footer-items">
      <div class="contact">
        <h3> Contact Us </h3>
        <span><i class="fas fa-envelope"></i>xgames@gmail.com</span>
        <i class="fas fa-phone"></i>604-123-1244
      </div>
    </div>

    <div class="footer-items">
      <div class="social">
        <h3> Social Media </h3>
        <a href="https://twitter.com"><i class="fab fa-twitter"></i></a>
        <a href="https://facebook.com"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
      </div>
    </div>

    <div class="footer-items">
      <h3> Quick Links </h3>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="product_page.php">Products</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    Copyright &copy;
  </div>
</div>
</body>
</html>
