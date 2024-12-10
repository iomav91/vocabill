<?php 
    include 'core/init.php';

    if (isset($_REQUEST['signup'])) {
        $firstname = $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        $username = $_REQUEST['username'];    
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
  
        if (!empty($firstname) && !empty($lastname) &&!empty($username) && !empty($email) && !empty($password)) {
            $firstname = $getFromA->checkInput($firstname);
            $lastname = $getFromA->checkInput($lastname);  
            $username = $getFromA->checkInput($username);
            $email = $getFromA->checkInput($email);
            $password = $getFromA->checkInput($password);
  
            // Concatenate the password and salt, then hash
            $password_hash = hash('sha256', $password);
  
            if ($getFromA->checkEmail($email) === false) {
                $error = "There is already an admin with the same email!";
            } else if ($getFromA->checkUsername($username) === false) {
                $error = "There is already an admin with the same username!";
            } else if ($getFromA->checkPassword($password_hash) === false) {
                $error = "There is already an admin with the same password!";
            } else {
                $admin_id = $getFromA->create('admins', array('username' => $username, 'password_hash' => $password_hash, 'email' => $email, 'firstname' => $firstname, 'lastname' => $lastname, 'status' => 'Active'));
                $_SESSION['admin_id'] = $admin_id;
                header('Location: login.php');
            }
        } else {
            $error = "Please fill out all fields!";
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
  <script src="https://cdn.tailwindcss.com">
  </script>
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
    <div class="flex items-center">
     <i class="fas fa-cog text-orange-500 text-4xl mr-4">
     </i>
     <h1 class="text-3xl font-bold lowercase">
      vocabill
     </h1>
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
   <div class="lg:w-1/2 p-4 bg-white w-full">
    <div class="text-right mb-6">
     <a href="login.php" class="text-gray-600">
      Already have an account?
      <span class="text-blue-600">
       Sign in.
      </span>
     </a>
    </div>
    <h2 class="text-2xl font-bold text-gray-800 mb-4">
     Get Started for Free
    </h2>
    <p class="text-gray-600 mb-8">
     Enjoy 7 days of premium features. No commitment.
    </p>
    <form>
     <input id="firstname" name="firstname" class="w-full p-4 mb-6 border rounded-lg" placeholder="Your firstname" type="text">
     <input id="lastname" name="lastname" class="w-full p-4 mb-6 border rounded-lg" placeholder="Your lastname" type="text">
     <input id="username" name="username" class="w-full p-4 mb-6 border rounded-lg" placeholder="Your username" type="text">
     <input id="email" name="email" class="w-full p-4 mb-6 border rounded-lg" placeholder="Your email address" type="text">
     <input id="password" name="password" class="w-full p-4 mb-6 border rounded-lg" placeholder="Create a password" type="password">
     <button id="signup" name="signup" class="w-full bg-orange-500 text-white p-4 rounded-lg mb-6" type="submit">
      Sign up
     </button>
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
