<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Hixy.org - Shorten That URL!</title>
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
		
		<div id="description">
			<form action="shorten.php" method="post">
			<h1>Enter the long url you would like shortened below:</h1>
			<input value="http://" name="url_location" type="text" size="55" class="url_location" />
			<input type="submit" value="Go!" name="url_submit"  class="url_submit" />
			</form>
		</div>
		
		<? if(isset($error)){ ?>
		<div id="error">
			<h3>Error:</h3>
		<? echo "<h1>" . $error . "</h1>"; ?>
		</div>
		<? } ?>
		
		<? if(isset($url_tag)){ ?>
		<div id="generated">
		<h3>Success!</h3>
			<h1>Original url: <b><?
				$url_location =  wordwrap($url_location, 40, "<br />", true);
				echo $url_location;
			?></b></h1>
			<h1>Shortened url: <b><input type="text" class="short_url" onclick="javascript:this.focus();this.select();" value="http://hixy.org/?<? echo $url_tag ?>" size="20" readonly="true" /><a target="_blank" href="http://hixy.org/<? echo $url_tag; ?>">[open]</a></b></h1>
			<h1>Preview url: <b>
			<input type="text" class="short_url" onclick="javascript:this.focus();this.select();" value="http://hixy.org/?<? echo $url_tag ?>-" size="20" readonly="true" /><a target="_blank" href="http://hixy.org/<? echo $url_tag; ?>-">[open]</a></b></h1>
		</div>
		<? } ?>
		
		<? if(isset($preview)){ ?>
		<div id="data">
			<h3>Url Preview:</h3>
			<h1>This url redirects to: <b><a href="<?
			$url_location =  wordwrap($url_location, 40, "<br />", true);
			echo $url_location;
			?>"><? echo $url_location; ?></a></b></h1>
		</div>
		<? } ?>
		
		<div id="footer">
			&copy; 2008 <a href="http://hixy.org">Hixy.org</a> | All Rights Reserved
		</div>
	</div>
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	var pageTracker = _gat._getTracker("UA-3868885-3");
	pageTracker._trackPageview();
	</script>
</body>
</html>
