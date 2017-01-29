<?
include ('dbconn.php');
include ('clean.php');

//Get url
if (isset($_GET['url_location'])) {
    $url_location = clean($_GET['url_location'], $cid);
}
else {
    $url_location = clean($_POST['url_location'], $cid);
}

$url_tag = null;
$bare_domain_location = parse_url(strtolower($url_location), PHP_URL_HOST);
$banned_domains = array("hixy.org", "tinyurl.com");

//Start shortening URL
if ($url_location == "http://" || $url_location == "") {
    $error = "No url was submitted. Please insert a url.";
}
else if (in_array($bare_domain_location, $banned_domains)) {
    $error = "That domain is not allowed.";
}
else {
    //Database
    $SQL = "select * from urls where url_location='$url_location'";
    $result = mysqli_query($cid,$SQL);
    if (!$result) {
        echo (mysqli_error());
    }
    else {
        if (mysqli_num_rows($result) > 0) { // load TAG
            $row = mysqli_fetch_array($result);
            $url_tag = $row["url_tag"];
        }
        else { // Make tag
            $url_tag = strtolower(substr(md5($url_location), 0, 5));
                
            //Insert into the database
            $SQL = "INSERT INTO urls (url_location, url_tag, time_made) VALUES ('$url_location', '$url_tag', NOW())";
            $result = mysqli_query($cid,$SQL);
            if (!$result) {
                echo(mysqli_error());
            }
        }
    } 
}
include ('home.php');
?>
