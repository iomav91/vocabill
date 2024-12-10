<?php
  class Admin extends Base {

    function __construct($db) {
      $this->pdo = $db;
    }

    public function checkInput($input) {
      $input = htmlspecialchars($input);
      $input = trim($input);
      $input = stripslashes($input);
      return $input;
    }

    public function login($username, $email, $password) {
      // Generate a salt
      //$salt = bin2hex(random_bytes(16)); // Generate a random salt

      // Concatenate the password and salt, then hash
      $password_hash = hash('sha256', $password);

      $stmt = $this->pdo->prepare("SELECT admin_id FROM admins WHERE username = :username AND email = :email AND password_hash = :password_hash");
      $stmt->bindParam(":username", $username, PDO::PARAM_STR);
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->bindParam(":password_hash", $password_hash, PDO::PARAM_STR);
      $stmt->execute();

      $admin = $stmt->fetch(PDO::FETCH_OBJ);
      $count = $stmt->rowCount();

      if ($count > 0) {
        $_SESSION['admin_id'] = $admin->admin_id;
        return true;
      } else {
        return false;
      }
    }

    public function checkUsername($username) {
      $stmt = $this->pdo->prepare("SELECT admin_id FROM admins WHERE username = :username");
      $stmt->bindParam(":username", $username, PDO::PARAM_STR);
      $stmt->execute();

      $count = $stmt->rowCount();

      if ($count > 0) {
        return false;
      } else {
        return true;
      }
    }

    public function checkEmail($email) {
      $stmt = $this->pdo->prepare("SELECT admin_id FROM admins WHERE email = :email");
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->execute();

      $count = $stmt->rowCount();

      if ($count > 0) {
        return false;
      } else {
        return true;
      }
    }

    public function checkPassword($password) {
      // Generate a salt
      //$salt = bin2hex(random_bytes(16)); // Generate a random salt

      // Concatenate the password and salt, then hash
      $password_hash = hash('sha256', $password);

      $stmt = $this->pdo->prepare("SELECT admin_id FROM admins WHERE password_hash = :password_hash");
      $stmt->bindParam(":password_hash", $password_hash, PDO::PARAM_STR);
      $stmt->execute();

      $count = $stmt->rowCount();

      if ($count > 0) {
        return false;
      } else {
        return true;
      }
    }

    /*public function findAddressRow($user_id) {
      $stmt = $this->pdo->prepare("SELECT user_id FROM addresses WHERE customer_id = :customer_id");
      $stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
      $stmt->execute();

      $count = $stmt->rowCount();

      if ($count > 0) {
        return false;
      } else {
        return true;
      }
    }*/

    public function adminData($admin_id) {
      $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE admin_id = :admin_id");
      $stmt->bindParam(":admin_id", $admin_id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function adminDataByPassword($password) {

      $password_hash = hash('sha256', $password);

      $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE password_hash = :password_hash");
      $stmt->bindParam(":password_hash", $password_hash, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /*public function customerAddressData($customer_id) {
      $stmt = $this->pdo->prepare("SELECT * FROM addresses WHERE customer_id = :customer_id");
      $stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    }*/

    public function admins() {
      $stmt = $this->pdo->prepare("SELECT * FROM admins");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function logout() {
      session_destroy();
      header('Location: ../admin-alt-2/login.php');
    }

    public function loggedIn() {
      if (isset($_SESSION['admin_id'])) {
        return true;
      }
      return false;
    }
  }
?>
