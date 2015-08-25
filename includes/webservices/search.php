<?php 

require_once("../initialize.php");

$input 	 = $_POST['input'];

if(isset($_GET['itemtype']))
{
	if($_GET['itemtype'] == "user")
	{
		$users 	  	= User::search($input);
	}
}
else
{
	$users 	  	= User::search($input);
}

$tables = array();

if($users != null)
{
	$table = new Table("users", $users);
	array_push($tables, $table);
}

if(count($tables) > 0)
{
	echo json_encode($tables);
}

class Table
{
	public $name;
	public $objects;

	function __construct($name, $objects)
	{
		$this->name 	= $name;
		$this->objects 	= $objects;
	}
}

?>