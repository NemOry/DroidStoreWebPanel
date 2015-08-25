<?php

require_once("../initialize.php");

$where = " 1=1";

$limit = " LIMIT 1000 ";

$sortorder = " DESC ";

$sort = " ORDER BY ".C_FEATUREDITEM_PRIORITY." ".$sortorder;

//======================================================

if(isset($_GET['priority']))
{
	$where .= " AND ".C_FEATUREDITEM_PRIORITY.equallike($_GET['priority'], "int");
}

if(isset($_GET['id']))
{
	$where .= " AND ".C_FEATUREDITEM_ID.equallike($_GET['id'], "int");
}

if(isset($_GET['pending']))
{
	$where .= " AND ".C_FEATUREDITEM_PENDING.equallike($_GET['pending'], "int");
}

if(isset($_GET['enabled']))
{
	$where .= " AND ".C_FEATUREDITEM_ENABLED.equallike($_GET['enabled'], "int");
}

//======================================================

if(isset($_GET['limit']))
{
	$limit = " LIMIT ".$_GET['limit']." ";
}

if(isset($_GET['sortby']) && isset($_GET['sortorder']))
{
	$sort = " ORDER BY ".$_GET['sortby']." ".$_GET['sortorder']." ";
}

if(isset($_GET['sortby']) && !isset($_GET['sortorder']))
{
	$sort = " ORDER BY ".$_GET['sortby'].$sortorder." ";
}

//======================================================

$sql = "SELECT * FROM ".T_FEATUREDITEMS." WHERE ".$where.$sort.$limit;

//echo $sql."<br />";

$items = FeaturedItem::get_by_sql($sql);

$filename = 0;

$featured = array();

if(!isset($_GET['blob']))
{
	foreach ($items as $item)
	{
		$imageFile = "images/".$item->id.".jpg";

		file_put_contents($imageFile, base64_decode($item->picture));

		$item->picture = HOST."includes/webservices/".$imageFile;

		if($item->id == 7 && $item->appprice <= $version || $item->pending == 1)
		{

		}
		else
		{
			array_push($featured, $item);
		}
	}
}

echo str_replace('\/','/',json_encode($featured));

// echo str_replace('\/','/',json_encode($items));

function equallike($field, $type)
{
	$string = "";

	if($type == "string")
	{
		if(isset($_GET['equal']))
		{
			$string = " = '".$field."'";
		}
		else
		{
			$string = " LIKE '%".$field."%'";
		}
	}
	else if($type == "int")
	{
		$string = " = ".$field."";
	}

	return $string;
}

?>