<?
include ('dbconn.php');
$tag = $_SERVER['QUERY_STRING']; //Grab the TAG in the URL

if($tag != ""){
	if (strrpos($tag, "-") == 5){
		$tag = substr($tag, 0, 5);
		//SQL
		$SQL = "select * from urls where url_tag='$tag'";
			$result = mysql_db_query($db,$SQL,$cid);
			if(!$result) { echo (mysql_error()); }
			else{
				$row = mysql_fetch_array($result);
			}
		//
		$url_location = $row["url_location"];
		$preview = true;
		include('home.php');
	}
	else{

		$SQL = "select * from urls where url_tag='$tag'";
			$result = mysql_db_query($db,$SQL,$cid);
			if(!$result) { echo (mysql_error()); }
			else{
				$row = mysql_fetch_array($result);
			}
		if ($tag != $row['url_tag']){	
			$error = "The url given does not exist.";
			include('home.php'); //Do not remove
		}
		else{
			print "<meta http-equiv=\"refresh\" content=\"0;URL=".$row["url_location"]."\">";
		}
	}
}
else{
	include('home.php');
}
?>
