<?

	$usr = "root";
	
	$pwd = "";
	
	$db = "hixy";
	
	$host = "localhost";

	// connect to database
	$cid =  mysqli_connect($host,$usr,$pwd, $db);
	if (!$cid) { echo("ERROR: " . mysqli_connect_error() . "\n");	}

?>
