<?php

require_once("../initialize.php");

$message = "";

$object            		= FeaturedItem::get_by_id($_POST['featureditemid']);
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

$file = new File($_FILES['picture']);

if($file->valid)
{
  $object->picture  = $file->data;
}
else
{
  $object->picture  = base64_decode($object->picture);
}

$object->update();

$log = new Log($session->userid, $clientip, "WEB", "UPDATED FEATURED ITEM: ".$object->id); $log->create();

$message .= "success";

echo $message;

?>