<?php 
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $mssg = $_POST['mssg'];
 if (!empty($email) && !empty($mssg)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $reciever = 'ibraheemedrys@gmail.com';
       $subject = "From: $name <$email>";
       $body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $mssg\n\nRegards,\n$name";
       $sender = "From: $email";

       if (mail($reciever, $subject, $body, $sender)) {
        echo "Email sent successfully to $reciever!"; 
       } else {
        echo "Sorry, failed to send your message"; 
       }
       
    }else{
        echo "Enter a valid Email!"; 
    }
 } else {
    echo "Email and Message field is required!"; 
 }
 
?>