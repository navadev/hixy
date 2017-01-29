<?
session_start();



// Catpcha
if (!isset($_SESSION['captchaid'])){
  $_SESSION['captchaid'] = rand(0, 5);
}
$questions = array("4 + 6", "3 + 1", "3 + 5", "8 - 3", "4 - 2", "10-4");
$answers = array(10, 4, 8, 5, 2, 6);
  
// Email
 if (isset($_POST['submit'])){
     //Set variables
        $email = $_POST['email'];
        $inquiry = $_POST['inquiry'];
        $captcha = $_POST['captcha'];
    //
      if ($email == "" || $inquiry == "" || $captcha == "") {
          $message = "<h1>One or more fields are blank. All fields are required.</h1>";
      } else {
        if (!preg_match("/[a-zA-Z0-9.-_+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $email)) {
          $message = "<h1>That email is invalid.</h1>";
          } else {
              if (isset($_POST['captcha'])) {
                            if ($_POST['captcha'] != $answers[$_SESSION['captchaid']]) {
                                  $message = "<h1>Sorry, the answer to the captcha is wrong.</h1>";
                            }
                            else{
                            mail('admin@hixy.org','Email from Hixy.org', $inquiry);
                            $message = "<h1 style='color:green'>Thank you for your message.</h1>";
                            unset($_SESSION['captchaid']);
                            $_SESSION['captchaid'] = rand(0, 5);
                          }
                      }
                  }
              }
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Hixy.org - Send Us A Message!</title>
<meta name="keywords" content="url, shortener, redirection, hixy" />
<meta name="description" content="Shorten your url using Hixy.org with url redirection." />
<link rel="stylesheet" href="css/main.css" />
</head>

<body>
    <div class="wrapper">
        <div id="logo">
            <a class="noborder" href="index.php"><img src="img/logo.png" border="0" alt="Shorten that URL!" /></a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="terms.php">Terms</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="faq.php">FAQ</a></li>
            </ul>
        </div>
        
        <div id="contact">
          <form action="<? echo $PHP_SELF; ?>" method="post">
          <?
            if(isset($message)){
                echo "<div id=\"error\">";
                echo $message;
                echo "</div>";
            }
          ?>
          <p>Email:</p><input name="email" type="text" size="22" />
          <p>Inquiry:</p><textarea name="inquiry" cols="22" rows="3"></textarea>
          <p>What's <? echo $questions[$_SESSION['captchaid']]; ?>?:</p><input name="captcha" type="text" size="22" />
          <input type="submit" name="submit" value="Submit" class="submit" />
          </form>
        </div>
        
        <div id="footer">
            &copy; 2008 <a href="http://hixy.org">Hixy.org</a> | All Rights Reserved
        </div>
    </div>
    </body>
</html>
