<?php
$version=$_GET["version"];
if (file_exists("conf-$version.php")) {
	include("conf-$version.php");
}
else {
	if (file_exists("conf.php")) {
		include("conf.php");
	}
}
$package=$_GET["package"];
if ("$package") {
	if (file_exists("$log_dir/$package.html")) {
		include ("$log_dir/$package.html");
	}	
	else {
		echo "No log available for $package.";
	}
}
else {
	echo "Strange things happen...";
}
?>
