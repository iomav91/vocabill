<?php
  class Invoice extends Base {
    function __construct($pdo) {
      $this->pdo = $pdo;
    }
    
    public function invoices() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices ORDER BY invoice_id DESC");
      $stmt->execute();
      $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $invoices;
    }

    public function invoicesCountTotal() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function invoicesCountPaid() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE status=2");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function invoicesCountUnpaid() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE status=3");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function invoicesByJan() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE due_date BETWEEN '2024-01-01' AND '2024-01-31' AND status=2");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function invoicesByFeb() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE due_date BETWEEN '2024-02-01' AND '2024-02-29' AND status=2");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function invoicesByMar() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE due_date BETWEEN '2024-03-01' AND '2024-03-31' AND status=2");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function invoicesByApril() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE due_date BETWEEN '2024-04-01' AND '2024-04-30' AND status=2");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function invoicesByMay() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE due_date BETWEEN '2024-05-01' AND '2024-05-30' AND status=2");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function invoicesByJun() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE due_date BETWEEN '2024-06-01' AND '2024-06-31' AND status=2");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function invoicesByJul() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE due_date BETWEEN '2024-07-01' AND '2024-01-30' AND status=2");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function invoicesByClient($customer_id) {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE customer_id = :customer_id ORDER BY invoice_id DESC");
      $stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
      $stmt->execute();
      $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $invoices;
    }

    /*public function countTweets($user_id) {
      $stmt = $this->pdo->prepare("SELECT COUNT(tweet_id) AS totalTweets FROM tweets where tweetBy = :user_id");
      $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
      $stmt->execute();
      $count = $stmt->fetch(PDO::FETCH_OBJ);
      return $count->totalTweets;
    }*/
  }
?>
