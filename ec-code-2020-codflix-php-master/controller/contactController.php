<?php


function showContact(){
    require('view/contactUsView.php');
}

function sendMail(){
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']) && !empty($_POST['subject'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $subject = $_POST['subject'];
        $content = "From: $name \n Email: $email \n Message: $message";
        $recipient = "coding@gmail.com";
        $mailheader = "From: $email \r\n";
        mail($recipient, $subject, $content, $mailheader) or die("Error!");
        echo "<script>alert('mail envoyé!')</script>";
    }else{
        echo "<script>alert('Veuillez compléter tous les champs')</script>";
    }


    showContact();
}