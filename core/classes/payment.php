<?php
  class Payment extends Base {
    function __construct($pdo) {
      $this->pdo = $pdo;
    }
    
    public function payments() {
      $stmt = $this->pdo->prepare("SELECT * FROM payments ORDER BY invoice_id DESC");
      $stmt->execute();
      $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $invoices;
    }

    public function paymentsCountTotal() {
      $stmt = $this->pdo->prepare("SELECT * FROM payments");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    /*public function invoicesCountPaid() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE status=2");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function paymentsCountUnpaid() {
      $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE status=3");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }*/

    public function paymentsByJan() {
      $stmt = $this->pdo->prepare("SELECT * FROM payments WHERE payment_date BETWEEN '2024-01-01' AND '2024-01-31'");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function paymentsByFeb() {
      $stmt = $this->pdo->prepare("SELECT * FROM payments WHERE payment_date BETWEEN '2024-02-01' AND '2024-02-29'");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function paymentsByMar() {
      $stmt = $this->pdo->prepare("SELECT * FROM payments WHERE payment_date BETWEEN '2024-03-01' AND '2024-03-31'");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function paymentsByApril() {
      $stmt = $this->pdo->prepare("SELECT * FROM payments WHERE payment_date BETWEEN '2024-04-01' AND '2024-04-30'");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function paymentsByMay() {
      $stmt = $this->pdo->prepare("SELECT * FROM payments WHERE payment_date BETWEEN '2024-05-01' AND '2024-05-30'");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function paymentsByJun() {
      $stmt = $this->pdo->prepare("SELECT * FROM payments WHERE payment_date BETWEEN '2024-06-01' AND '2024-06-31'");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function paymentsByJul() {
      $stmt = $this->pdo->prepare("SELECT * FROM payments WHERE payment_date BETWEEN '2024-07-01' AND '2024-01-30'");
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
    }

    public function paymentsByClient($client_id) {
      $stmt = $this->pdo->prepare("SELECT c.client_id, c.company_name,
                                          COUNT(p.payment_id) as total_payments,
                                          SUM(p.amount) as total_amount_paid,
                                          MIN(p.payment_date) as first_payment,
                                          MAX(p.payment_date) as last_payment,
                                          GROUP_CONCAT(DISTINCT p.payment_method) as payment_methods_used
                                    FROM clients c WHERE c.client_id = :client_id
                                    JOIN invoices i ON c.client_id = i.client_id
                                    JOIN payments p ON i.invoice_id = p.invoice_id
                                    GROUP BY c.client_id, c.company_name
                                    ORDER BY total_amount_paid DESC;"
                                    );
      $stmt->bindParam(":client_id", $client_id, PDO::PARAM_INT);
      $stmt->execute();
      $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $clients;
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