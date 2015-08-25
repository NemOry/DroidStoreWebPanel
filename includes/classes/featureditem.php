<?php 

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class FeaturedItem extends DatabaseObject
{
	protected static $table_name = T_FEATUREDITEMS;
	protected static $col_id = C_FEATUREDITEM_ID;

	public $id;
	public $platform 	= "android";
	public $appid;
	public $name;
	public $description;
	public $version;
	public $developer;
	public $price		= 0;
	public $picture;
	public $priority 	= 0;
	public $pending 	= 0;
	public $enabled 	= 1;
	public $datetime;

	public function create()
	{
		global $db;

		$sql = "INSERT INTO " 				. self::$table_name . " (";
		$sql .= C_FEATUREDITEM_PLATFORM		.", ";
		$sql .= C_FEATUREDITEM_APPID 		.", ";
		$sql .= C_FEATUREDITEM_NAME 		.", ";
		$sql .= C_FEATUREDITEM_DESCRIPTION 	.", ";
		$sql .= C_FEATUREDITEM_VERSION 		.", ";
		$sql .= C_FEATUREDITEM_DEVELOPER 	.", ";
		$sql .= C_FEATUREDITEM_PRICE 		.", ";
		$sql .= C_FEATUREDITEM_PICTURE 		.", ";
		$sql .= C_FEATUREDITEM_PRIORITY 	.", ";
		$sql .= C_FEATUREDITEM_PENDING 		.", ";
		$sql .= C_FEATUREDITEM_ENABLED 		.", ";
		$sql .= C_FEATUREDITEM_DATETIME;
		$sql .=") VALUES (";
		$sql .= " '".$db->escape_string($this->platform) 	."', ";
		$sql .= " '".$db->escape_string($this->appid) 		."', ";
		$sql .= " '".$db->escape_string($this->name) 		."', ";
		$sql .= " '".$db->escape_string($this->description) ."', ";
		$sql .= " '".$db->escape_string($this->version) 	."', ";
		$sql .= " '".$db->escape_string($this->developer) 	."', ";
		$sql .= " '".$db->escape_string($this->price) 		."', ";
		$sql .= " '".$db->escape_string($this->picture) 	."', ";
		$sql .= " ".$db->escape_string($this->priority) 	.", ";
		$sql .= " ".$db->escape_string($this->pending) 		.", ";
		$sql .= " ".$db->escape_string($this->enabled) 		.", ";
		$sql .= " NOW() ";
		$sql .=")";

		if($db->query($sql))
		{
			$this->id = $db->get_last_id();
			return true;
		}
		else
		{
			return false;	
		}
	}
	
	public function update()
	{
		global $db;

		$sql = "UPDATE " 					. self::$table_name . " SET ";
		$sql .= C_FEATUREDITEM_APPID 		. "='" . $db->escape_string($this->appid) 		. "', ";
		$sql .= C_FEATUREDITEM_PLATFORM 	. "='" . $db->escape_string($this->platform) 		. "', ";
		$sql .= C_FEATUREDITEM_NAME			. "='" . $db->escape_string($this->name) 			. "', ";
		$sql .= C_FEATUREDITEM_DESCRIPTION	. "='" . $db->escape_string($this->description) 	. "', ";
		$sql .= C_FEATUREDITEM_VERSION		. "='" . $db->escape_string($this->version) 		. "', ";
		$sql .= C_FEATUREDITEM_DEVELOPER	. "='" . $db->escape_string($this->developer) 		. "', ";
		$sql .= C_FEATUREDITEM_PRICE		. "='" . $db->escape_string($this->price) 			. "', ";
		$sql .= C_FEATUREDITEM_PICTURE		. "='" . $db->escape_string($this->picture) 		. "', ";
		$sql .= C_FEATUREDITEM_PRIORITY 	. "=" . $db->escape_string($this->priority) 		. ", ";
		$sql .= C_FEATUREDITEM_PENDING 		. "=" . $db->escape_string($this->pending) 			. ", ";
		$sql .= C_FEATUREDITEM_ENABLED 		. "=" . $db->escape_string($this->enabled) 			. ", ";
		$sql .= C_FEATUREDITEM_DATETIME 		. "= NOW() ";
		$sql .="WHERE " . self::$col_id . "=" . $db->escape_string($this->id) 	. "";

		$db->query($sql);

		return ($db->get_affected_rows() == 1) ? true : false;
	}

	public function delete()
	{
		global $db;
		$sql = "DELETE FROM " . self::$table_name . " WHERE " . self::$col_id . "=" . $this->id . "";
		$db->query($sql);
		return ($db->get_affected_rows() == 1) ? true : false;
	}
	
	protected static function instantiate($record)
	{
		$this_class = new self;

		$this_class->id 			= $record[C_FEATUREDITEM_ID];
		$this_class->platform 		= $record[C_FEATUREDITEM_PLATFORM];
		$this_class->appid 			= $record[C_FEATUREDITEM_APPID];
		$this_class->name 			= $record[C_FEATUREDITEM_NAME];
		$this_class->description 	= $record[C_FEATUREDITEM_DESCRIPTION];
		$this_class->version 		= $record[C_FEATUREDITEM_VERSION];
		$this_class->developer 		= $record[C_FEATUREDITEM_DEVELOPER];
		$this_class->price 			= $record[C_FEATUREDITEM_PRICE];
		$this_class->picture 		= base64_encode($record[C_FEATUREDITEM_PICTURE]);
		$this_class->priority 		= $record[C_FEATUREDITEM_PRIORITY];
		$this_class->pending 		= $record[C_FEATUREDITEM_PENDING];
		$this_class->enabled 		= $record[C_FEATUREDITEM_ENABLED];
		$this_class->datetime		= $record[C_FEATUREDITEM_DATETIME];

		return $this_class;
	}

	public function picture()
	{
		return $this->picture;
	}

	public static function exists($itemid, $itemtype)
	{
		global $db;

		$itemid = $db->escape_string($itemid);
		$itemtype = $db->escape_string($itemtype);

		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE " . C_FEATUREDITEM_ITEMID . " = " . $itemid . "";
		$sql .= " AND " . C_FEATUREDITEM_ITEMTYPE . " = '" . $itemid . "'";

		$result = $db->query($sql);

		return ($db->get_num_rows($result) == 1) ? true : false;
	}
}

?>