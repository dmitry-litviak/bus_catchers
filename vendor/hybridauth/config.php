<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$whitelist = array('buscatchers.loc');
return 
	array(
		"base_url" => in_array($_SERVER['HTTP_HOST'], $whitelist) ? 'http://'.$_SERVER['HTTP_HOST']."/loginauth" : 'http://'.$_SERVER['HTTP_HOST']."/bus_catchers/loginauth", 

		"providers" => array ( 
			// openid providers
			"OpenID" => array (
				"enabled" => false
			),

			"AOL"  => array ( 
				"enabled" => false 
			),

			"Yahoo" => array ( 
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" )
			),

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "5840884008.apps.googleusercontent.com", "secret" => "dkHPLKz7zMdv-l8fcOJ1oq_9" )
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "134627846735967", "secret" => "f4384045beff97c7d66080de9d6385cf" )
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "YbSBoulZyExYguViH6Mqg", "secret" => "eJIgAUgKfleAB49CTUQIjrxTI63R8vUdNTTc6MUY7Vw" ) 
			),

			// windows live
			"Live" => array ( 
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),

			"MySpace" => array ( 
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" ) 
			),

			"LinkedIn" => array ( 
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" ) 
			),

			"Foursquare" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,

		"debug_file" => ""
	);
