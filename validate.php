<?php
$u_name = filter_var($_POST['u_name'], FILTER_SANITIZE_STRING);
$phone_no = filter_var($_POST['phone_no'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

if(empty($u_name) || empty($phone_no) || empty($email) || empty($subject) || empty($message)) {
    die("Please Enter the Values to all the fields");

}

session_start();
if ($_SESSION['form_submitted'] === true){
    die("Duplicate Submission");

}

$_SESSION['form_submitted'] = true;

$servername = "localhost";
$username = "uname";
$password = "";
$db = "cmp";

$conn = new mysqli($servername, $username, $password, $db);

if (conn->connect_error) {
    die("connection failed:" . $conn->connect_error);
}

$sql = "INSERT INTO login (u_name, phone_no, email, subject, message, ip_address, timestamp)
VALUES ('$u_name', 'phone_no', 'email','subject', 'message', '{$_SERVER['REMOTE_ADDR']}', NOW())";

if($conn->query($sql) == TRUE) {

$to = "abc@gmail.com";
$subject = "other Query";
$message = " xyz";
mail($to, $subject, $message);

echo "Form Submitted";
} 
else {
    echo "Error: " . $sql . $conn->error;
}

$conn->close();

?>

