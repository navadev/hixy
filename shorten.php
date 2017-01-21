<?
include ('dbconn.php');

//Put system tags into an array
$main_dir = './';
$system_tags = array();

if($main_dir = opendir($main_dir)){
	while(($internal_dir = readdir($main_dir)) !== false) {
		if($internal_dir != '.' && $internal_dir != '..' && is_dir($internal_dir)){
			 $system_tags[] = $internal_dir;
		}
	}
	closedir($main_dir);
}


//Get url
$url_location = $_GET['url_location'];

if ($url_location == ""){
	$url_location = $_POST['url_location'];
}

//Start shortening URL
if ($url_location == "http://"){
	$error = "No url was submitted. Please insert a url.";
	include ('home.php');
	exit;
}
$bare_domain_location = parse_url(strtolower($url_location), PHP_URL_HOST);
$banned_domains = array("hixy.org", "tinyurl.com");
if(in_array($bare_domain_location, $banned_domains)){
	$error = "That domain is not allowed.";
	include ('home.php');
}
else{
	if ($url_location == ""){
		$error = "No url was submitted. Please insert a url.";
		include ('home.php');
	}
	else{
		if(substr($url_location, 0, 7) != "http://"){ //If no http then add http
			$url_location = "http://" . $url_location; 
		}
		//Database
		$SQL = "select * from urls where url_location='$url_location'";
		$result = mysql_db_query($db,$SQL,$cid);
		if(!$result) { echo (mysql_error()); }
		else{
		$row = mysql_fetch_array($result);
		}	
		
		if ($url_location == $row["url_location"]){ //If URL Exists Load TAG
			$url_tag = $row["url_tag"];
		}
		else{	//If URL doesn't exist make TAG
			$url_tag = strtolower(substr(md5($url_location), 0, 5));
				
			if(in_array($url_tag, $system_tags)){
				$url_tag = strtolower(substr(sha1($url_location), 0, 5));
			}
			//Insert into the database
			$SQL = "INSERT INTO urls (url_location, url_tag, time_made) VALUES ('$url_location', '$url_tag', NOW())";
			$result = mysql_db_query($db, $SQL, $cid);
			if (!$result) {
				echo(mysql_error());
			}
		}
		include ('home.php');
	}
}
?>