<?php

require_once("../initialize.php");

$html = "";

$input = "";

if(isset($_GET['input']))
{
  $input = $_GET['input'];
}

$filename = 0;

if(isset($_GET['itemtype']))
{
  $items = array();

  if($_GET['itemtype'] == "user")
  {
    $items = User::search($input);

    if(count($items) > 0)
    {
      foreach ($items as $item) 
      {
        $html .= "<tr>";
        $html .= "  <td><img src='data:image/jpeg;base64, ".$item->picture."' height='40' width='40'/></td>";
        $html .= "  <td>".$item->username."</td>";
        $html .= "  <td>".$item->get_full_name()."</td>";
        $html .= "  <td><a class='btn btn-primary' href='updateuser.php?id=".$item->id."'>Update</a></td>";
        $html .= "  <td><button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else if($_GET['itemtype'] == "featureditem")
  {
    $items = FeaturedItem::get_all();

    if(count($items) > 0)
    {
      $html .= "<thead>";
      $html .= "  <th>Icon</th>";
      $html .= "  <th>Name</th>";
      $html .= "  <th>App ID</th>";
      $html .= "  <th>Platform</th>";
      $html .= "  <th>Version</th>";
      $html .= "  <th>Action</th>";
      $html .= "</thead>";

      foreach ($items as $item) 
      {
        $imageFile = "images/".$item->id.".jpg";

        file_put_contents($imageFile, base64_decode($item->picture));

        $picture = HOST."droidstore/slir/w100/droidstore/includes/webservices/".$imageFile;

        $html .= "<tr>";
        $html .= "  <td><img src='".$picture."' style='height:50px;' /></td>";
        $html .= "  <td>".$item->name."</td>";
        $html .= "  <td>".$item->appid."</td>";
        $html .= "  <td>".$item->platform."</td>";
        $html .= "  <td>".$item->version."</td>";
        $html .= "  <td><a class='btn btn-primary' href='updatefeatureditem.php?id=".$item->id."'>Update</a> <button class='btn btn-danger btndelete'>Delete <span hidden>".$item->id."</span></button></td>";
        $html .= "</tr>";
      }

      $filename = 0;

      echo $html;
    }
    else
    {
      echo "no data";
    }
  }
  else
  {
    echo "unknown itemtype";
  }
}
else
{
  echo "no itemtype";
}

?>