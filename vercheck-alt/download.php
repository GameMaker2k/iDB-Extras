<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2009-2011 iDB Support - http://idb.berlios.de/
    Copyright 2009-2011 Game Maker 2k - http://gamemaker2k.org/

    $FileInfo: index.php - Last Update: 08/02/2011 Ver 3.1.2 - Author: cooldude2k $
*/
@ini_set("html_errors", false);
@ini_set("track_errors", false);
@ini_set("display_errors", false);
@ini_set("report_memleaks", false);
@ini_set("display_startup_errors", false);
//@ini_set("error_log","logs/error.log"); 
//@ini_set("log_errors","On"); 
@ini_set("docref_ext", "");
@ini_set("docref_root", "http://php.net/");
@ini_set("date.timezone","UTC"); 
@ini_set("default_mimetype","text/html");
@error_reporting(E_ALL ^ E_NOTICE);
@set_time_limit(30); @ignore_user_abort(true);
if(function_exists("date_default_timezone_set")) { 
	@date_default_timezone_set("UTC"); }
function idb_output_handler($buffer) { return $buffer; }
@ob_start("idb_output_handler");
header("Cache-Control: private, no-cache, no-store, must-revalidate, pre-check=0, post-check=0, max-age=0");
header("Pragma: private, no-cache, no-store, must-revalidate, pre-check=0, post-check=0, max-age=0");
header("P3P: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\"");
header("Date: ".gmdate("D, d M Y H:i:s")." GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
output_reset_rewrite_vars();
$_GET['file'] = null;
if($_GET['file']==null) {
$mirrors['mirror'] = array("downloads.sourceforge.net","idb.gamemaker2k.org","of.openfoundry.org"); 
$mirrors['url'] = array("http://downloads.sourceforge.net/intdb/","http://of.openfoundry.org/download_path/idb/0.4.6.696/");
$mirrors['name'] = array("SourceForge","iDB Support FTP","OpenFoundry"); 
$mirrors['links'] = array("http://sourceforge.net/projects/intdb","http://idb.gamemaker2k.org/","http://of.openfoundry.org/projects/1220");
//$files = array("iDB.zip","iDB.tar.gz","iDB.tar.bz2","iDB.tar.lzma","iDB.tar.xz","iDB.7z","iDB.deb","iDB.rpm","iDB-Host.zip","iDB-Host.tar.gz","iDB-Host.lzma","iDB-Host.tar.xz","iDB-Host.tar.bz2","iDB-Host.7z","iDB-Host.deb","iDB-Host.rpm","iDBEH-Mod.zip","iDBEH-Mod.tar.gz","iDBEH-Mod.tar.bz2","iDBEH-Mod.tar.lzma","iDBEH-Mod.tar.xz","iDBEH-Mod.7z");
$files = array("iDB.zip","iDB.tar.gz","iDB.tar.bz2","iDB.tar.xz","iDB.7z","iDB-Host.zip","iDB-Host.tar.gz","iDB-Host.tar.xz","iDB-Host.tar.bz2","iDB-Host.7z","iDBEH-Mod.zip","iDBEH-Mod.tar.gz","iDBEH-Mod.tar.bz2","iDBEH-Mod.tar.xz","iDBEH-Mod.7z","iDBEH-SubMod.zip","iDBEH-SubMod.tar.gz","iDBEH-SubMod.tar.bz2","iDBEH-SubMod.tar.xz","iDBEH-SubMod.7z","webinstaller.zip","webinstaller.tar.gz","webinstaller.tar.bz2","webinstaller.7z");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title> iDB Download List </title>
<meta http-equiv="content-language" content="en-US">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-15">
<meta name="Generator" content="EditPlus">
<meta name="Author" content="Cool Dude 2k">
<meta name="Keywords" content="iDB Download List">
<meta name="Description" content="iDB Download List">
<meta name="ROBOTS" content="Index, FOLLOW">
<meta name="revisit-after" content="1 days">
<meta name="GOOGLEBOT" content="Index, FOLLOW">
<meta name="resource-type" content="document">
<meta name="distribution" content="global">
<link rel="icon" href="favicon.ico" type="image/icon">
<link rel="shortcut icon" href="favicon.ico" type="image/icon">
<?php echo "<!-- Katarzyna o_O -->"; ?>
</head>

<body>
<?php $i = 0; $num = count($mirrors['mirror']);
echo "<!-- Renee Sabonis ^_^ -->";
while($i < $num) {
$l = 0; $nums = count($files); ?>
<ul><li><a href="<?php echo $mirrors['links'][$i]; ?>"><?php echo $mirrors['name'][$i]; ?></a><ul>
<?php while($l < $nums) { ?>
	<li><a href="<?php echo $mirrors['url'][$i]; ?><?php echo $files[$l]; ?>"><?php echo $files[$l]; ?></a></li>
<?php ++$l; } 
echo "<!-- Renee Sabonis ^_^ -->"; ?>
</ul></li></ul>
<?php ++$i; } ?>
<div class="copyright">Powered by <a href="http://idb.berlios.de/" title="iDB Al 0.4.7 SVN 753" onclick="window.open(this.href);return false;">iDB VerCheck</a> &copy; <a href="http://idb.berlios.de/support/category.php?act=view&amp;id=2" title="Game Maker 2k" onclick="window.open(this.href);return false;">Game Maker 2k</a> @ 2004 - 2011</div>
<?php echo "<!-- Dagmara O_o -->"; ?>
</body>
</html>
<?php } ?>
