<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "social"); //connection variable

if(mysqli_connect_errno())
{
    echo "Failed to connect: " . mysqli_connect_errno();
}

//Declaring variables to prevent errors

$fname = ""; // First name
$lname = ""; // Last name
$em = ""; //Email
$em2 = ""; // Email confirm
$password = ""; // Password
$password2 = ""; // Password confirm
$date = ""; // reg date
$error_array = array(); // array to hold error messages

if(isset($_POST["register_button"])){
    // Registration form info

    //First Name
    $fname = strip_tags($_POST['reg_fname']); // Remove HTML tags
    $fname = str_replace(' ', '', $fname); // Remove spaces
    $fname = ucfirst(strtolower($fname)); // Convert to lower and capilaize first letter
    $_SESSION['reg_fname'] = $fname;
    //Last Name
    $lname = strip_tags($_POST['reg_lname']); // Remove HTML tags
    $lname = str_replace(' ', '', $lname); // Remove spaces
    $lname = ucfirst(strtolower($lname)); // Convert to lower and capilaize first letter
    $_SESSION['reg_lname'] = $lname;
    //Email
    $em = strip_tags($_POST['reg_email']); // Remove HTML tags
    $em = str_replace(' ', '', $em); // Remove spaces
    $em = ucfirst(strtolower($em)); // Convert to lower and capilaize first letter
    $_SESSION['reg_email'] = $em;
    //Email2
    $em2 = strip_tags($_POST['reg_email2']); // Remove HTML tags
    $em2 = str_replace(' ', '', $em2); // Remove spaces
    $em2 = ucfirst(strtolower($em2)); // Convert to lower and capilaize first letter
    $_SESSION['reg_email2'] = $em2;
    //Password
    $password = strip_tags($_POST['password']); // Remove HTML tags
    $password2 = strip_tags($_POST['password2']); // Remove HTML tags

    // Get Current Date
    $Date = date("Y-m-d");

    if($em == $em2){
        
        // Check if email already in use
        $e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'");
        $num_rows = mysqli_num_rows($e_check);

        if($num_rows > 0) {
            array_push($error_array, "Email already is use.</br>");
        }

        // Check if email is a valid format
        if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            //Check if email exists
        } else {
            array_push($error_array, "Invalid format.</br>");
        }
    } else {
        array_push($error_array, "Emails don't match.</br>");
    }

    if(strlen($fname) > 25 || strlen($fname) < 2){
        array_push($error_array, "First name must be between 2 and 25 charachters.</br>");
    }
    if(strlen($lname) > 25 || strlen($lname) < 2){
        array_push($error_array, "Last name must be between 2 and 25 charachters.</br>");
    }

    if($password != $password2) {
        array_push($error_array, "Passwords do not match.</br>");
    } else {
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "Your password may only contain English letters and numbers.</br>");
        }
    }

    if(strlen($password) > 30 || strlen($password) < 5) {
        array_push($error_array, "Your password must be between 5 and 30 characters.</br>");
    }
}

?>


<html>
<head><title>Register</title></head>

<body>

    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="First Name" value="<?php
        if(isset($_SESSION['reg_fname'])){
            echo $_SESSION['reg_fname'];
        }?>" required ></br>
        <?php if(in_array("First name must be between 2 and 25 charachters.</br>", $error_array)) echo "First name must be between 2 and 25 charachters.</br>";?>

        <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
        if(isset($_SESSION['reg_lname'])){
            echo $_SESSION['reg_lname'];
        }?>" required></br>
        <?php if(in_array("Last name must be between 2 and 25 charachters.</br>", $error_array)) echo "Last name must be between 2 and 25 charachters.</br>";?>

        <input type="email" name="reg_email" placeholder="Email" value="<?php
        if(isset($_SESSION['reg_email'])){
            echo $_SESSION['reg_email'];
        }?>" required></br>

        <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
        if(isset($_SESSION['reg_email2'])){
            echo $_SESSION['reg_email2'];
        }?>" required></br>
        <?php if(in_array("Invalid format.</br>", $error_array)) echo "Invalid format.</br>";
         else if(in_array("Email already is use.</br>", $error_array)) echo "Email already is use.</br>";
         else if(in_array("Emails don't match.</br>", $error_array)) echo "Emails don't match.</br>";?>

        <input type="password" name="password" placeholder="Password" required></br>
        <input type="password" name="password2" placeholder="Confirm Password" required></br>
        <?php if(in_array("Your password may only contain English letters and numbers.</br>", $error_array)) echo "Your password may only contain English letters and numbers.</br>";
        else if(in_array("Your password must be between 5 and 30 characters.</br>", $error_array)) echo "Your password must be between 5 and 30 characters.</br>";
        else if(in_array("Passwords do not match.</br>", $error_array)) echo "Passwords do not match.</br>";?>

        <input type="submit" name="register_button" value="Register">
    </form>

</body>
</html>