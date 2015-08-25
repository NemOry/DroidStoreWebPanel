<?php

require_once("../initialize.php");

$message = "";

$review           = new Review();
$review->itemtype = $_POST['itemtype'];
$review->review   = $_POST['review'];

$review->create();

$message .= "success";

echo $message;

?>