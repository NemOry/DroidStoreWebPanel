<?php

require_once("../initialize.php");

$message = "";

if(isset($_GET['itemid']) && isset($_GET['itemtype']))
{
  $message = "success";

  if($_GET['itemtype'] == "user")
  {
    User::get_by_id($_GET['itemid'])->delete();
  }
  else if($_GET['itemtype'] == "featureditem")
  {
    FeaturedItem::get_by_id($_GET['itemid'])->delete();
  }
  else
  {
    $message = "unknown parameter passed";
  }
}
else
{
  $message = "missing required parameter";
}

echo $message;

?>