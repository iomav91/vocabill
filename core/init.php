<?php
  include 'database/connection.php';
  include 'classes/base.php';
  include 'classes/payment.php';
  include 'classes/admin.php';
  include 'classes/invoice.php';
  include 'classes/client.php';

  global $db;

  session_start();
  $getFromA = new Admin($db);
  $getFromP = new Payment($db);
  $getFromInv = new Invoice($db);
  $getFromC = new Client($db);
  //$getFromCli = new Client($db);

  define("BASE_URL", "http://localhost/vocabill-demo/admin-alt-2/signup.php");
?>
