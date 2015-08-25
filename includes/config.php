<?php 

// ----------------------------------------- USERS TABLE  ------------------------------------------------------- \\
defined('T_USERS') ? null :						define("T_USERS"					, "users");
defined('C_USER_ID') ? null : 					define("C_USER_ID"					, "id");
defined('C_USER_USERNAME') ? null : 			define("C_USER_USERNAME"			, "username");
defined('C_USER_PASSWORD') ? null : 			define("C_USER_PASSWORD"			, "password");
defined('C_USER_EMAIL') ? null : 				define("C_USER_EMAIL"				, "email");
defined('C_USER_FIRSTNAME') ? null : 			define("C_USER_FIRSTNAME"			, "firstname");
defined('C_USER_MIDDLENAME') ? null : 			define("C_USER_MIDDLENAME"			, "middlename");
defined('C_USER_LASTNAME') ? null : 			define("C_USER_LASTNAME"			, "lastname");
defined('C_USER_BIRTHDATE') ? null : 			define("C_USER_BIRTHDATE"			, "birthdate");
defined('C_USER_GENDER') ? null : 				define("C_USER_GENDER"				, "gender");
defined('C_USER_PICTURE') ? null : 				define("C_USER_PICTURE"				, "picture");
defined('C_USER_TWITTERID') ? null : 			define("C_USER_TWITTERID"			, "twitterid");
defined('C_USER_FACEBOOKID') ? null :			define("C_USER_FACEBOOKID"			, "facebookid");
defined('C_USER_FOURSQUAREID') ? null : 		define("C_USER_FOURSQUAREID"		, "foursquareid");
defined('C_USER_SCORELOOPID') ? null :			define("C_USER_SCORELOOPID"			, "scoreloopid");
defined('C_USER_PENDING') ? null : 				define("C_USER_PENDING"				, "pending");
defined('C_USER_ENABLED') ? null : 				define("C_USER_ENABLED"				, "enabled");
defined('C_USER_DATETIME') ? null :				define("C_USER_DATETIME"			, "datetime");

// ----------------------------------------- FEATURED ITEMS TABLE  ------------------------------------------------------- \\
defined('T_FEATUREDITEMS') ? null :				define("T_FEATUREDITEMS"			, "featureditems");
defined('C_FEATUREDITEM_ID') ? null : 			define("C_FEATUREDITEM_ID"			, "id");
defined('C_FEATUREDITEM_PLATFORM') ? null : 	define("C_FEATUREDITEM_PLATFORM"	, "platform");
defined('C_FEATUREDITEM_APPID') ? null : 		define("C_FEATUREDITEM_APPID"		, "appid");
defined('C_FEATUREDITEM_NAME') ? null : 		define("C_FEATUREDITEM_NAME"		, "name");
defined('C_FEATUREDITEM_DESCRIPTION') ? null : 	define("C_FEATUREDITEM_DESCRIPTION"	, "description");
defined('C_FEATUREDITEM_VERSION') ? null : 		define("C_FEATUREDITEM_VERSION"		, "version");
defined('C_FEATUREDITEM_DEVELOPER') ? null : 	define("C_FEATUREDITEM_DEVELOPER"	, "developer");
defined('C_FEATUREDITEM_PRICE') ? null : 		define("C_FEATUREDITEM_PRICE"		, "price");
defined('C_FEATUREDITEM_PICTURE') ? null : 		define("C_FEATUREDITEM_PICTURE"		, "picture");
defined('C_FEATUREDITEM_PRIORITY') ? null : 	define("C_FEATUREDITEM_PRIORITY"	, "priority");
defined('C_FEATUREDITEM_PENDING') ? null : 		define("C_FEATUREDITEM_PENDING"		, "pending");
defined('C_FEATUREDITEM_ENABLED') ? null : 		define("C_FEATUREDITEM_ENABLED"		, "enabled");
defined('C_FEATUREDITEM_DATETIME') ? null :		define("C_FEATUREDITEM_DATETIME"	, "datetime");

// ----------------------------------------- SUPERADMINS TABLE  ------------------------------------------------------- \\
defined('T_SUPERADMINS') ? null :				define("T_SUPERADMINS"				, "superadmins");
defined('C_SUPERADMIN_ID') ? null : 			define("C_SUPERADMIN_ID"			, "id");
defined('C_SUPERADMIN_USERID') ? null : 		define("C_SUPERADMIN_USERID"		, "userid");
defined('C_SUPERADMIN_PENDING') ? null : 		define("C_SUPERADMIN_PENDING"		, "pending");
defined('C_SUPERADMIN_ENABLED') ? null : 		define("C_SUPERADMIN_ENABLED"		, "enabled");
defined('C_SUPERADMIN_DATETIME') ? null :		define("C_SUPERADMIN_DATETIME"		, "datetime");

// ----------------------------------------- REVIEWS TABLE  ------------------------------------------------------- \\
defined('T_REVIEWS') ? null :					define("T_REVIEWS"					, "reviews");
defined('C_REVIEW_ID') ? null : 				define("C_REVIEW_ID"				, "id");
defined('C_REVIEW_USERID') ? null : 			define("C_REVIEW_USERID"			, "userid");
defined('C_REVIEW_ITEMID') ? null : 			define("C_REVIEW_ITEMID"			, "itemid");
defined('C_REVIEW_ITEMTYPE') ? null : 			define("C_REVIEW_ITEMTYPE"			, "itemtype");
defined('C_REVIEW_REVIEW') ? null : 			define("C_REVIEW_REVIEW"			, "review");
defined('C_REVIEW_RATING') ? null : 			define("C_REVIEW_RATING"			, "rating");
defined('C_REVIEW_PENDING') ? null : 			define("C_REVIEW_PENDING"			, "pending");
defined('C_REVIEW_ENABLED') ? null : 			define("C_REVIEW_ENABLED"			, "enabled");
defined('C_REVIEW_DATETIME') ? null :			define("C_REVIEW_DATETIME"			, "datetime");

// ----------------------------------------- LOGS TABLE  ------------------------------------------------------- \\
defined('T_LOGS') ? null :						define("T_LOGS"						, "logs");
defined('C_LOGS_ID') ? null : 					define("C_LOGS_ID"					, "id");
defined('C_LOGS_USERID') ? null : 				define("C_LOGS_USERID"				, "userid");
defined('C_LOGS_IP') ? null : 					define("C_LOGS_IP"					, "ip");
defined('C_LOGS_PLATFORM') ? null : 			define("C_LOGS_PLATFORM"			, "platform");
defined('C_LOGS_DATETIME') ? null : 			define("C_LOGS_DATETIME"			, "datetime");
defined('C_LOGS_ACTION') ? null : 				define("C_LOGS_ACTION"				, "action");

// ----------------------------------------- ITEM TYPES ------------------------------------------------------- \\
defined('USER') ? null :						define("USER"						, "USER");

// ----------------------------------------- GENDERS ------------------------------------------------------- \\
defined('MALE') ? null : 						define("MALE"							, 1);
defined('FEMALE') ? null : 						define("FEMALE"							, 2);

// ----------------------------------------- ACCESS ------------------------------------------------------- \\
defined('ENABLED') ? null : 					define("ENABLED"						, 1);
defined('DISABLED') ? null : 					define("DISABLED"						, 0);

// ----------------------------------------- STATUS ------------------------------------------------------- \\
defined('PENDING') ? null : 					define("PENDING"						, 1);
defined('NOTPENDING') ? null : 					define("NOTPENDING"						, 0);

?>