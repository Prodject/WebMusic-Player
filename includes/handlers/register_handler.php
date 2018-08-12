<?php

function santizeFormUsername($inputtext){
  $inputtext = strip_tags($inputtext);
  $inputtext = str_replace(" ", "", $inputtext);
  return $inputtext;
}

function santizeFormPassword($inputtext){
  $inputtext = strip_tags($inputtext);
  return $inputtext;
}

function santizeFormString($inputText){
  $inputText = strip_tags($inputText);
  $inputText = str_replace(" ", "", $inputText);
  $inputText = ucfirst(strtolower($inputText));
  return $inputText;
}


if (isset($_POST['registerButton'])) {
  
  $username = santizeFormUsername($_POST['username']);
  $lastname = santizeFormString($_POST['lastname']);
  $firstname = santizeFormString($_POST['firstname']);
  $email = santizeFormUsername($_POST['email']);
  $email2 = santizeFormUsername($_POST['email2']); 
  $password = santizeFormPassword($_POST['password']);
  $password2 = santizeFormPassword($_POST['password2']);

  $wasSuccessful =$account->register($username,$firstname,$lastname,$password,$password2,$email,$email2);
  if ($wasSuccessful) {
    $_SESSION['userLoggedIn'] = $username;
    header("Location: index.php");
  }
   
}

?>