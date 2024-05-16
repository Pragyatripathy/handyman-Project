<?php
session_start();

//messages displayed
$msg = '';

//database parameters
$conn = mysqli_connect('localhost', 'root', '', 'handyman');

// Check if the connection was established
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//Handle form data
$name = '';
$email = '';
$address = '';
$phone_number = '';
$role = '';
$message = '';

//Handle errors messages
$errors = array();


if (empty($_POST['name']))
  $errors['name'] = 'Name is mandatory.';
else
  $name = strip_tags(trim($_POST['name']));

if (empty($_POST['address']))
  $errors['address'] = 'Address is mandatory.';
else
  $address = strip_tags(trim($_POST['address']));

if (empty($_POST['phone_number']))
  $errors['phone_number'] = 'Phone_number is mandatory.';
else
  $phone_number = strip_tags(trim($_POST['phone_number']));

if (empty($_POST['email']))
  $errors['email'] = 'Email is mandatory.';
else
  $email = strip_tags(trim($_POST['email']));

if (empty($_POST['role']))
  $errors['role'] = 'Role is mandatory.';
else
  $role = strip_tags(trim($_POST['role']));

if (empty($_POST['message']))
  $errors['role'] = 'Message is mandatory.';
else
  $message = strip_tags(trim($_POST['message']));



// insert student if no errors

if (empty($errors)) {
  $query = "INSERT INTO services(name,email,address,phone_number,role,message)
            VALUES('$name','$email','$address','$phone_number','$role','$message')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo '<span class="success" style="color: green; font-weight: bold; display: block; text-align: center;margin-top:20px;margin-bottom:20px;">successfully inserted!</span>';
    echo '<script>document.getElementById("formId").reset();</script>'; // Replace "yourFormId" with the ID of your form
  } else
    echo '<span class="error">Problem inserting in the database.</span>';
} else {
  foreach ($errors as $key => $msg) {
    echo "<span class='error'>$key : $msg</span><br>";
  }
}

mysqli_close($conn);
