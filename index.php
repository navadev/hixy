<?php

include ('dbconn.php');
include ('clean.php');

$tag = clean($_SERVER['QUERY_STRING'], $cid); //Grab the TAG in the URL
$preview = false;
$url_location = null;

if ($tag != "") {
    if (strrpos($tag, "-") == 5)
        $preview = true;
    $tag = substr($tag, 0, 5);
    $SQL = "select * from urls where url_tag='$tag'";
    $result = mysqli_query($cid, $SQL);
    if (!$result) {
        echo (mysqli_error($cid));
    }
    else {
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) > 0) {
            if ($preview) {
                $url_location = wordwrap($row['url_location'], 40, "<br />", true);
            }
            else {
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=".$row['url_location']."\">";
                exit();
            }
        }
        else {
            $error = "The url given does not exist.";
        }
    }
}
include('home.php');
?>
