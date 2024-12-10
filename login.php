<?php

  include '../core/init.php';
  $error = null;

  if (isset($_REQUEST['login'])) {
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    
    if (!empty($username) && !empty($email) && !empty($password)) {
      $username = $getFromA->checkInput($username);
      $email = $getFromA->checkInput($email);
      $password = $getFromA->checkInput($password);
      
      // Concatenate the password and salt, then hash
      $password_hash = hash('sha256', $password);

      if ($getFromA->login($username, $email, $password) === false) {
        $error = "The username or email or password is incorrect";
      } else {
        header('Location: ../admin-alt-2/dashboard.php');
      }
    } else {
      $error = "Please enter email and password!";
    }
  }
?>

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Vocabill
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="js/translations.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet"/>
  <style>
   body {
     font-family: 'Inter', sans-serif;
   }
  </style>
 </head>
 <body class="bg-white flex justify-center items-center min-h-screen">
  <div class="rounded-lg p-8 max-w-6xl mx-auto flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-8 w-full">
   <div class="lg:w-1/2 p-4">
    <div class="flex items-center mb-6">
        <i class="fas fa-cog text-orange-600 text-3xl mr-2"></i>
        <span class="text-2xl font-bold text-orange-600">vocabill</span>
    </div>
    <h2 class="text-3xl font-bold text-gray-800 mb-6">
     Organized Invoicing Solutions
    </h2>
    <p class="text-gray-600 mb-8">
     Find the perfect invoice template for every client!
    </p>
    <div class="border p-6 rounded-lg mb-8">
     <img alt="Illustration of a person organizing invoices" class="mx-auto mb-6" height="300" src="https://storage.googleapis.com/a1aa/image/VHtXhUBkmfzHZisOFOrqmBkbCe31ESsMJOpueenxfcrAqjf9E.jpg" width="400"/>
     <p class="text-center text-gray-600">
      Send invoices on the go with ease.
     </p>
    </div>
   </div>
   <div class="lg:w-1/2 p-4 bg-white w-full text-gray-800">
    <div class="flex flex-row space-x-6 justify-between language-switcher mb-6">
        <h2 class="text-2xl font-bold">
            Get Started for Free
        </h2>
        <div class="flex flex-row items-center">
            <p id="language-title">Language:</p>
            <button class="text-orange-500 px-2 hover:text-gray-800" onclick="setLanguage('en')">En</button>
            <button class="text-orange-500 hover:text-gray-800" onclick="setLanguage('gr')">Gr</button>
        </div>
    </div>
    
    <p class="text-gray-600 mb-8">
     Enjoy 7 days of premium features. No commitment.
    </p>
    <form>
     <input id="username" name="username" class="w-full p-4 mb-6 border rounded-lg" placeholder="Your username" type="text">
     <input id="email" name="email" class="w-full p-4 mb-6 border rounded-lg" placeholder="Your email address" type="text">
     <input id="password" name="password" class="w-full p-4 mb-6 border rounded-lg" placeholder="Create a password" type="password">
     <button id="login" name="login" class="w-full bg-orange-500 text-white p-4 rounded-lg mb-6" type="submit">
      Sign in
     </button>
     <div class="text-left mb-6">
        <a href="signup.php" class="text-gray-800">
            Don't have an account yet?
            <span class="text-orange-500">
                Sign up.
            </span>
        </a>
     </div>
    </form>
    <div class="text-center text-gray-600 mb-6">
     or connect with
    </div>
    <div class="flex justify-center space-x-6">
     <button class="bg-red-500 text-white p-4 rounded-lg flex items-center">
      <i class="fab fa-google mr-2">
      </i>
      Google
     </button>
     <button class="bg-blue-600 text-white p-4 rounded-lg flex items-center">
      <i class="fab fa-facebook-f mr-2">
      </i>
      Facebook
     </button>
    </div>
   </div>
  </div>
 </body>
</html>