

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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SliTaz Build Bot</title>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
    <meta name="description" content="Tazbb web interface" />
    <meta name="robots" content="index nofollow" />
    <link rel="shortcut icon" href="web/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="web/slitaz.css" />
</head>
<body>

<!-- Header -->
<div id="header">
	<!-- Access -->
	<div id="access">
	    <?php
			$versions_list = fopen('repositories.list', 'r');
				if($versions_list)
				{
					$otherversion   = '';
					while(!feof($versions_list))
					{
						$otherversion = fgets($versions_list);
						echo "<a href=\"?version=$otherversion\">$otherversion</a>";
					}
				fclose($versions_list);
				}
		?>
	</div>
    <a href="http://bb.slitaz.org/"><img id="logo"
		src="web/logo.png"
		title="bb.slitaz.org" alt="bb.slitaz.org" /></a>
    <p id="titre">#!/Build/Bot/<?php echo $version; ?></p>
</div>

<!-- Content -->
<div id="content-full">

<!-- Block begin -->
<div class="block">
	<!-- Nav block begin -->
	<div id="block_nav">
		<h3><img src="pics/website/development.png" alt="" />Developers</h3>
		<ul>
			<li><a href="http://www.slitaz.org/en/devel/">Website/devel</a></li>
			<li><a href="http://labs.slitaz.org/">Laboratories</a></li>
			<li><a href="http://hg.slitaz.org/">Mercurial Repos</a></li>
			<li><a href="http://people.slitaz.org/">People Stuff</a></li>
			<li><a href="http://scn.slitaz.org/">Community Network</a></li>
		</ul>
	<!-- Nav block end -->
	</div>
	<!-- Top block begin -->
	<div id="block_top">
		<h1>Build Bot</h1>
		<p>
			Tazwok-experimental is a <a href="http://www.slitaz.org/">SliTaz GNU/Linux</a>
			Build Bot, it automatically cooks and tests packages commited in
			the wok. SliTaz <a href="http://pkgs.slitaz.org/">packages</a> are
			cooked on the project main server: code name 
			<a href="http://tank.slitaz.org">Tank</a>. This web interface gives
			the current status of the build bot and the last report
			about any packages modified by the SliTaz contributors in 
			the Mercurial repositories, aka 
			<a href="http://hg.slitaz.org/">Hg repos</a>.
		</p>
	<!-- Top block end -->
	</div>
<!-- Block end -->
</div>

<h2>Cooklog</h2>

<p>
	<form action="log.php" method="get">
		<input type="hidden" name="version" value="<?php
echo "$version";
?>
" />
		Show pkg log:<br />
		 <input type="text" name="package" />
		<!-- <input type="submit" value="Show" /> -->
	</form><br />
Note:<br />
Flavors/Iso build log are named iso-?flavor <br />
Temporary toolchain log are named tmp-toolchain-?package <br />
</p>

<h2>Summary</h2>
<pre class="package">
<?php
// Check curent status (update in real time) and display summary.
if (file_exists($lockfile)) {
	echo "Status   : Chroot is mounted\n";
}
else {
	echo "Status   : Chroot is not mounted\n";
}
include("$db_dir/summary");
?>
</pre>
<p>
Packages in the wok: <?php
system("cd $wok && ls -1 | wc -l"); ?><br />
Commited packages: <?php
system("wc -l $packages/commit | cut -f 1 -d ' '"); ?><br />
Packages to cook: <?php
system("wc -l $packages/cooklist | cut -f 1 -d ' '"); ?><br />
Broken packages: <?php
system("wc -l $packages/broken | cut -f 1 -d ' '"); ?><br />
Blocked packages: <?php
system("wc -l $packages/blocked | cut -f 1 -d ' '"); ?>
</p>

<h3>Commit</h3>
<pre class="package">
<?php
include("$db_dir/commit");
?>
</pre>

<h3>Cooklist</h3>
<pre class="package">
<?php
include("$db_dir/cooklist");
?>
</pre>

<h3>Broken</h3>
<pre class="package">
<?php
include("$db_dir/broken");
?>
</pre>

<h3>Blocked</h3>
<pre class="package">
<?php
include("$db_dir/blocked");
?>
</pre>

<h3>Last cooked packages</h3>
<pre class="package">
<?php
system("cd $incoming && ls -1t *.tazpkg | head -20 | \
	while read file; do echo -n \$(stat -c '%y' $incoming/\$file | \
	cut -d. -f1); echo '   '\$file; done"); ?>
</pre>

<h3>Last removed packages</h3>
<pre class="package">
<?php
include("$db_dir/removed");
?>
</pre>

<h3>Last cooked flavors</h3>
<pre class="package">
<?php
system("cd $packages && ls -1t *.flavor | head -20 | \
	while read file; do echo -n \$(stat -c '%y' $packages/\$file | \
	cut -d. -f1); echo '   '\$file; done"); ?>
</pre>

<!-- End of content -->
</div>

<!-- Footer -->
<div id="footer">
	<div class="right_box">
	<h4>SliTaz Network</h4>
		<ul>
			<li><a href="http://www.slitaz.org/">Main Website</a></li>
			<li><a href="http://doc.slitaz.org/">Documentation</a></li>
			<li><a href="http://forum.slitaz.org/">Support Forum</a></li>
			<li><a href="http://scn.slitaz.org/">Community Network</a></li>
			<li><a href="http://labs.slitaz.org/">Laboratories</a></li>
			<li><a href="http://twitter.com/slitaz">SliTaz on Twitter</a></li>
		</ul>
	</div>
	<h4>SliTaz Website</h4>
	<ul>
		<li><a href="#header">Top of the page</a></li>
		<li>Copyright &copy; <span class="year"></span>
			<a href="http://www.slitaz.org/">SliTaz</a></li>
		<li><a href="http://www.slitaz.org/en/about/">About the project</a></li>
		<li><a href="http://www.slitaz.org/netmap.php">Network Map</a></li>
		<li>Page modified the <?php echo (date( "d M Y", getlastmod())); ?></li>
		<li><a href="http://validator.w3.org/check?uri=referer"><img
		src="pics/website/xhtml10.png" alt="Valid XHTML 1.0"
		title="Code valid� XHTML 1.0"
		style="width: 80px; height: 15px; vertical-align: middle;" /></a></li>
	</ul>
</div>

</body>
</html>
