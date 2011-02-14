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
$filename=preg_replace('/.*\//', '', $package);
if (file_exists("$version-$package")) {
	header("Content-disposition: attachment; filename=$filename");
	readfile("$version-$package");
}
else {
	echo "Strange things happens...";
}
?>