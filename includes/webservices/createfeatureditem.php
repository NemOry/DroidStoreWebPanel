<?php

require_once("../initialize.php");

$message = "";

$object                	= new FeaturedItem();
$object->platform 		= $_POST["platform"];
$object->appid 			= $_POST["appid"];
$object->name 			= $_POST["name"];
$object->description 	= $_POST["description"];
$object->version 		= $_POST["version"];
$object->developer 		= $_POST["developer"];
$object->price 			= $_POST["price"];
$object->priority      	= $_POST['priority'];
$object->pending       	= $_POST['pending'];
$object->enabled       	= $_POST['enabled'];

if(isset($_FILES['picture']))
{
  $file             = new File($_FILES['picture']);
  $object->picture  = $file->data;
}

$object->create();

$log = new Log($session->userid, $clientip, "WEB", "CREATED FEATURED ITEM: ".$object->id); $log->create();

$message .= "success";

echo $message;

?>