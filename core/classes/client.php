<?php
  class Client extends Base {

    function __construct($db) {
      $this->pdo = $db;
    }

    public function checkInput($input) {
      $input = htmlspecialchars($input);
      $input = trim($input);
      $input = stripslashes($input);
      return $input;
    }

    /*public function login($email, $password) {
      $stmt = $this->pdo->prepare("SELECT customer_id FROM customers WHERE email = :email AND customer_password = :customer_password");
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->bindParam(":customer_password", $password, PDO::PARAM_STR);
      $stmt->execute();

      $customer = $stmt->fetch(PDO::FETCH_OBJ);
      $count = $stmt->rowCount();

      if ($count > 0) {
        $_SESSION['customer_id'] = $customer->customer_id;
        header('Location: /includes/home.php');
      } else {
        return false;
      }
    }*/

    /*public function checkUsername($username) {
      $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = :username");
      $stmt->bindParam(":username", $username, PDO::PARAM_STR);
      $stmt->execute();

      $count = $stmt->rowCount();

      if ($count > 0) {
        return false;
      } else {
        return true;
      }
    }*/

    /*public function checkEmail($email) {
      $stmt = $this->pdo->prepare("SELECT customer_id FROM customers WHERE email = :email");
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->execute();

      $count = $stmt->rowCount();

      if ($count > 0) {
        return false;
      } else {
        return true;
      }
    }*/

    /*public function checkPassword($password) {
      $stmt = $this->pdo->prepare("SELECT customer_id FROM customers WHERE customer_password = :customer_password");
      $stmt->bindParam(":customer_password", $password, PDO::PARAM_STR);
      $stmt->execute();

      $count = $stmt->rowCount();

      if ($count > 0) {
        return false;
      } else {
        return true;
      }
    }*/

    public function findClientAddressRow($client_id) {
      $stmt = $this->pdo->prepare("SELECT client_id FROM client_addresses WHERE client_id = :client_id");
      $stmt->bindParam(":client_id", $client_id, PDO::PARAM_INT);
      $stmt->execute();

      $count = $stmt->rowCount();

      if ($count > 0) {
        return false;
      } else {
        return true;
      }
    }

    public function clientData($client_id) {
      $stmt = $this->pdo->prepare("SELECT * FROM clients WHERE client_id = :client_id");
      $stmt->bindParam(":client_id", $client_id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function clientAddressData($client_id) {
      $stmt = $this->pdo->prepare("SELECT * FROM client_addresses WHERE client_id = :client_id");
      $stmt->bindParam(":client_id", $client_id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function clients() {
      $stmt = $this->pdo->prepare("SELECT * FROM clients");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function clientsCountTotal() {
      $stmt = $this->pdo->prepare("SELECT * FROM clients");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function clientsCountActive() {
      $stmt = $this->pdo->prepare("SELECT * FROM clients WHERE status=1");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function clientsCountInactive() {
      $stmt = $this->pdo->prepare("SELECT * FROM clients WHERE status=2");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function clientByPaidInv($client_id) {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE client_id = :client_id AND status='paid'");
      $stmt->bindParam(":client_id", $client_id, PDO::PARAM_INT);
      $stmt->execute();
      //$invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      return $count;
    }

    /*public function logout() {
      session_destroy();
      header('Location: ../index.php');
    }

    public function loggedIn() {
      if (isset($_SESSION['customer_id'])) {
        return true;
      }
      return false;
    }*/
  }
?>
