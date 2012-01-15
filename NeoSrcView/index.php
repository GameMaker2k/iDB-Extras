<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2011 Cool Dude 2k - http://idb.berlios.de/
    Copyright 2004-2011 Game Maker 2k - http://intdb.sourceforge.net/

    $FileInfo: index.php - Last Update: 01/04/2011 Ver. 2.0.5 RC 1 - Author: cooldude2k $
*/
$disfunc = @ini_get("disable_functions");
$disfunc = @trim($disfunc);
$disfunc = @preg_replace("/([\\s+|\\t+|\\n+|\\r+|\\0+|\\x0B+])/i", "", $disfunc);
if($disfunc!="ini_set") { $disfunc = explode(",",$disfunc); }
if($disfunc=="ini_set") { $disfunc = array("ini_set"); }
if(!in_array("ini_set", $disfunc)) {
/* Change to your url. */
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
@ini_set("default_mimetype","text/html"); }
if(!defined("E_DEPRECATED")) { define("E_DEPRECATED", 0); }
@error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
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
$urltype = 1;//URL type to use can be 1 or 2
$urlview = "html";//URL view type can be html or view
$dirstyle = "old";//DIR list style can be old, new. :P
$url = "http://localhost/srcview/";//Program url path
$sourcedir = "./tarball";//Program url path
$urlfname = "index.php";//Not used dont ask why its here. :P
$appname = "TAR Source Viewer";//Name of program also not used. :P
$dwntarlink = "dwntargz";
$downloadlink = "downloadgz";
$appver = array(2,0,5,"RC 1");//Version of program
$PathSep = ":";//You can set this to : ! @ ;
//$PathSep = "!"; $PathSep = "@"; $PathSep = ";";
$dir_image = "icnres/dir.gif";
$unknown_image = "icnres/unknown.gif";
$back_image = "icnres/back.gif";
//List of text type files
$txt_type = "htm,html,php,txt,xml,xsl,js,css,htaccess,null,";
$txt_type = explode(",",$txt_type);
//List of text mime types
$txt_mine_type = array(
	"htm" => "text/plain",
	"html" => "text/plain",
	"php" => "text/plain",
	"txt" => "text/plain",
	"xml" => "text/plain",
	"xsl" => "text/plain",
	"js" => "text/plain",
	"css" => "text/plain",
	"htaccess" => "text/plain",
	"null" => "text/plain",
	"" => "text/plain");
//List of text highlight types
$txt_highlight_type = array(
	"htm" => "highlight_php_source",
	"html" => "highlight_php_source",
	"php" => "highlight_php_source",
	"txt" => "highlight_php_source",
	"xml" => "highlight_php_source",
	"xsl" => "highlight_php_source",
	"js" => "highlight_php_source",
	"css" => "highlight_php_source",
	"htaccess" => "highlight_php_source",
	"null" => "highlight_php_source",
	"" => "highlight_php_source");
//List of text images
$txt_image = array(
	"htm" => "icnres/text.gif",
	"html" => "icnres/text.gif",
	"php" => "icnres/text.gif",
	"txt" => "icnres/text.gif",
	"xml" => "icnres/text.gif",
	"xsl" => "icnres/text.gif",
	"js" => "icnres/text.gif",
	"css" => "icnres/text.gif",
	"htaccess" => "icnres/text.gif",
	"null" => "icnres/text.gif",
	"" => "icnres/text.gif");
//List of image type files
$img_type = "gif,png,ico,jpg,jpeg,jpe,bmp";
$img_type = explode(",",$img_type);
//List of image mime types
$img_mine_type = array(
	"gif" => "image/gif",
	"png" => "image/png",
	"ico" => "image/x-icon",
	"jpg" => "image/jpeg",
	"jpeg" => "image/jpeg",
	"jpe" => "image/jpeg",
	"bmp" => "image/bmp");
//List of image images
$img_image = array(
	"gif" => "icnres/image.gif",
	"png" => "icnres/image.gif",
	"ico" => "icnres/image.gif",
	"jpg" => "icnres/image.gif",
	"jpeg" => "icnres/image.gif",
	"jpe" => "icnres/image.gif",
	"bmp" => "icnres/image.gif");
//List of binary type files
$bin_type = "ttf,tar";
//List of binary mime types
$bin_mine_type = array(
	"ttf" => "application/x-font-ttf",
	"tar" => "application/x-tar");
//List of binary images
$bin_image = array(
	"ttf" => "icnres/binary.gif",
	"tar" => "icnres/binary.gif");
$bin_type = explode(",",$bin_type);
function version_info($proname,$subver,$ver,$supver,$reltype,$svnver,$showsvn) {
	$return_var = $proname." ".$reltype." ".$subver.".".$ver.".".$supver;
	if($showsvn==false) { $showsvn = null; }
	if($showsvn==true) { $return_var .= " SVN ".$svnver; }
	if($showsvn!=true&&$showsvn!=null) { $return_var .= " ".$showsvn." ".$svnver; }
	return $return_var; }
$appversion = version_info($appname,$appver[0],$appver[1],$appver[2],$appver[3]." Ver.",null,false);
function highlight_php_source($text)
{
$phpsrcs = highlight_string($text, true);
$phpsrcs = str_replace("<br />", "<br />\n", $phpsrcs);
$phpsrcs = str_replace("<br>", "<br />\n", $phpsrcs);
$phpsrcs = preg_replace("/\<font color=\"(.*?)\"\>/i", "<span style=\"color: \\1;\">", $phpsrcs);
$phpsrcs = preg_replace("/\<\/font>/i", "</span>", $phpsrcs);
return $phpsrcs;
}
if(!isset($_GET['act'])) { $_GET['act'] = "list"; }
if($_GET['act']=="text") { $_GET['act'] = "view"; }
if(!isset($_GET['dir'])) { $_GET['dir'] = "/"; }
if(!isset($_GET['output'])) { $_GET['output'] = "none"; }
if($dirstyle=="neo") { $dirstyle = "new"; }
if($dirstyle!="new"&&$dirstyle!="old") {
	$dirstyle = "new"; }
if($_GET['act']=="downloadgz"||$_GET['act']=="downloadgzip") {
	$_GET['act'] = "download";
	$_GET['output'] = "gzip"; }
if($_GET['act']=="downloadbz"||$_GET['act']=="downloadbz2") {
	$_GET['act'] = "download";
	$_GET['output'] = "bzip2"; }
if($_GET['act']=="downloadbzip"||$_GET['act']=="downloadbzip2") {
	$_GET['act'] = "download";
	$_GET['output'] = "bzip2"; }
if($downloadlink!="downloadgz"&&$downloadlink!="downloadgzip"&&
	$downloadlink!="downloadbz"&&$downloadlink!="downloadbz2"&&
	$downloadlink!="downloadbzip"&&$downloadlink!="downloadbzip2"&&
	$downloadlink!="download") { $downloadlink = "downloadgz"; }
if($dwntarlink!="dwntargz"&&$dwntarlink!="dwntargzip"&&
	$dwntarlink!="dwntarbz"&&$dwntarlink!="dwntarbz2"&&
	$dwntarlink!="dwntarbzip"&&$dwntarlink!="dwntarbzip2"&&
	$dwntarlink!="dwntar") { $dwntarlink = "dwntargz"; }
if($_GET['act']=="dwntargz"||$_GET['act']=="dwntargzip") {
	$_GET['act'] = "dwntar";
	$_GET['output'] = "gzip"; }
if($_GET['act']=="dwntarbz"||$_GET['act']=="dwntarbz2") {
	$_GET['act'] = "dwntar";
	$_GET['output'] = "bzip2"; }
if($_GET['act']=="dwntarbzip"||$_GET['act']=="dwntarbzip2") {
	$_GET['act'] = "dwntar";
	$_GET['output'] = "bzip2"; }
if($_GET['output']=="gz") {
	$_GET['output'] = "gzip"; }
if($_GET['output']=="bz2") {
	$_GET['output'] = "bzip2"; }
if($_GET['output']!="none"&&$_GET['output']!="gzip"&&$_GET['output']!="bzip2") {
	$_GET['output'] = "none"; }
require_once("./untar.php");
// http://www.php.net/manual/en/function.sort.php#99700
    function array_sort($array, $on, $order='SORT_DESC')
    {
      $new_array = array();
      $sortable_array = array();
 
      if (count($array) > 0) {
          foreach ($array as $k => $v) {
              if (is_array($v)) {
                  foreach ($v as $k2 => $v2) {
                      if ($k2 == $on) {
                          $sortable_array[$k] = $v2;
                      }
                  }
              } else {
                  $sortable_array[$k] = $v;
              }
          }
 
          switch($order)
          {
              case 'SORT_ASC':   
                  //echo "ASC";
                  asort($sortable_array);
              break;
              case 'SORT_DESC':
                  //echo "DESC";
                  arsort($sortable_array);
              break;
          }
 
          foreach($sortable_array as $k => $v) {
              $new_array[] = $array[$k];
          }
      }
      return $new_array;
    } 
function format_size($size, $round = 0) {
    //Size must be bytes!
    $sizes = array(' B', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB');
    for ($i=0; $size > 1024 && $i < count($sizes); $i++) $size /= 1024;
    return round($size,$round).$sizes[$i];
}
// Change Time Stamp to a readable time
function GMTimeChange($format,$timestamp,$offset,$minoffset=null,$dst=null) {
global $utshour,$utsminute;
$dstake = null;
if(!is_numeric($minoffset)) { $minoffset = "00"; }
$ts_array = explode(":",$offset);
if(count($ts_array)!=2) {
	if(!isset($ts_array[0])) { $ts_array[0] = "0"; }
	if(!isset($ts_array[1])) { $ts_array[1] = "00"; }
	$offset = $ts_array[0].":".$ts_array[1]; }
if(!is_numeric($ts_array[0])) { $ts_array[0] = "0"; }
if(!is_numeric($ts_array[1])) { $ts_array[1] = "00"; }
if($ts_array[1]<0) { $ts_array[1] = "00"; $offset = $ts_array[0].":".$ts_array[1]; }
$tsa = array("offset" => $offset, "hour" => $ts_array[0], "minute" => $ts_array[1]);
//$tsa['minute'] = $tsa['minute'] + $minoffset;
if($dst!="on"&&$dst!="off") { $dst = "off"; }
if($dst=="on") { if($dstake!="done") { 
	$dstake = "done"; $tsa['hour'] = $tsa['hour']+1; } }
$utimestamp = $tsa['hour'] * $utshour;
$utimestamp = $utimestamp + $tsa['minute'] * $utsminute;
$utimestamp = $utimestamp + $minoffset * $utsminute;
$timestamp = $timestamp + $utimestamp;
return date($format,$timestamp); }
	$Names['SB'] = "Stephanie Braun";
define("_stephanie_", $Names['SB']);
// Change Time Stamp to a readable time
function TimeChange($format,$timestamp,$offset,$minoffset=null,$dst=null) {
return GMTimeChange($format,$timestamp,$offset,$minoffset,$dst); }
// Make a GMT Time Stamp
function GMTimeStamp() {
$GMTHour = gmdate("H");
$GMTMinute = gmdate("i");
$GMTSecond = gmdate("s");
$GMTMonth = gmdate("n");
$GMTDay = gmdate("d");
$GMTYear = gmdate("Y");
return mktime($GMTHour,$GMTMinute,$GMTSecond,$GMTMonth,$GMTDay,$GMTYear); }
// Get Server offset
function GetSeverZone() {
$TestHour1 = date("H");
@putenv("OTZ=".getenv("TZ"));
@putenv("TZ=GMT");
$TestHour2 = date("H");
@putenv("TZ=".getenv("OTZ"));
$TestHour3 = $TestHour1-$TestHour2;
return $TestHour3; }
// Get Server offset alt version
function SeverOffSet() {
$TestHour1 = date("H");
$TestHour2 = gmdate("H");
$TestHour3 = $TestHour1-$TestHour2;
return $TestHour3; }
// Get Server offset new version
function SeverOffSetNew() {
return gmdate("g",mktime(0,date("Z"))); }
function gmtime() { return time() - (int) date('Z'); }
if(!isset($_GET['dst'])) {
$_GET['dst'] = "on"; }
if($_GET['dst']!="on"&&
	$_GET['dst']!="off") {
	$_GET['dst'] = "off"; }
if(!isset($_GET['offset'])) {
$_GET['offset'] = "-6"; }
if(!is_numeric($_GET['offset'])) { $_GET['offset'] = "0"; }
if($_GET['offset']>=12) { $_GET['offset'] = "12"; }
if($_GET['offset']<=-12) { $_GET['offset'] = "-12"; }
if(!isset($_GET['minoffset'])) { $_GET['minoffset'] = "00"; }
if(!is_numeric($_GET['minoffset'])) { $_GET['minoffset'] = "00"; }
if($_GET['minoffset']>=59) { $_GET['minoffset'] = "59"; }
if($_GET['minoffset']<=0) { $_GET['minoffset'] = "00"; }
$TimeOffSet = $_GET['offset'].":".$_GET['minoffset'];
// Renee Marilyn Sabonis is the best ever. ^_^
	$Names['RS'] = "Renee Sabonis";
define("_renee_", $Names['RS']);
if(isset($_GET['tar'])&&$_GET['act']=="dwntar") {
if($_GET['output']=="none") {
$FileType = "application/x-tar";
header("Content-Disposition: attachment; filename=\"".basename($_GET['tar'])."\"");
header("Content-type: ".$FileType);
echo file_get_contents($sourcedir.$_GET['tar']); }
if($_GET['output']=="gzip") {
$FileType = "application/x-gzip";
header("Content-Disposition: attachment; filename=\"".basename($_GET['tar']).".gz\"");
header("Content-type: ".$FileType);
echo gzencode(file_get_contents($sourcedir.$_GET['tar'])); }
if($_GET['output']=="bzip2") {
$FileType = "application/x-bzip2";
header("Content-Disposition: attachment; filename=\"".basename($_GET['tar']).".bz2\"");
header("Content-type: ".$FileType);
echo bzcompress(file_get_contents($sourcedir.$_GET['tar'])); }
die(); exit(); }
if(isset($_GET['tar'])&&$_GET['act']!="view"&&$_GET['act']!="html") {
$File = array_sort(untar($sourcedir.$_GET['tar'],"/",null,false,true),"FileType",'SORT_DESC'); }
if((isset($_GET['tar'])&&$_GET['act']=="view")||
	(isset($_GET['tar'])&&$_GET['act']=="html")||
	(isset($_GET['tar'])&&$_GET['act']=="download")) {
$File = array_sort(untar($sourcedir.$_GET['tar'],"/",null,false,false,$_GET['file']),"FileType",'SORT_DESC'); }
if($_GET['act']=="view"||$_GET['act']=="html"||$_GET['act']=="download") {
$i = 0; $num = count($File);
$fileview = false;
while ($i < $num) {
if($_GET['file']==$File[$i]['FileName']) {
	if(count(explode(".",$File[$i]['FileName']))>1) {
	$FileExp = strtolower(end(explode(".",$File[$i]['FileName']))); }
	if(count(explode(".",$File[$i]['FileName']))<=1) {
	$FileExp = "null"; }
	if(isset($FileExp)) { $FileExt = $FileExp; }
	if(!in_array($FileExt, $txt_type)) { $_GET['act'] = "view";
	$FileType = "application/octet-stream"; }
	if(in_array($FileExt, $txt_type)) { 
	$FileType = $txt_mine_type[$FileExt]; 
	if($_GET['act']=="html") { $FileType = "text/html"; } }
	if(in_array($FileExt, $bin_type)) { 
	if($_GET['act']=="html") { $_GET['act'] = "view"; }
	$FileType = $bin_mine_type[$FileExt]; }
	if(in_array($FileExt, $img_type)) { 
	if($_GET['act']=="html") { $_GET['act'] = "view"; }
	$FileType = $img_mine_type[$FileExt]; }
	if($_GET['act']=="download") {
	if($_GET['output']=="none") {
	$FileType = "application/octet-stream";
	header("Content-Disposition: attachment; filename=\"".basename($File[$i]['FileName'])."\""); }
	if($_GET['output']=="gzip") {
	$FileType = "application/x-gzip";
	header("Content-Disposition: attachment; filename=\"".basename($File[$i]['FileName']).".gz\""); } 
	if($_GET['output']=="bzip2") {
	$FileType = "application/x-bzip2";
	header("Content-Disposition: attachment; filename=\"".basename($File[$i]['FileName']).".bz2\""); } }
	header("Content-type: ".$FileType);
	if($_GET['act']=="html") {?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> Source Viewer 2k </title>
  <meta name="generator" content="<?php echo $appversion; ?>" />
  <base href="<?php echo $url; ?>" />
  <link rel="icon" href="favicon.ico" type="image/icon" />
  <link rel="shortcut icon" href="favicon.ico" type="image/icon" />
<style type="text/css">
img { border: 0; padding: 0 2px; vertical-align: text-bottom; }
/*
td  { font-family: monospace; padding: 2px 3px; text-align: right; vertical-align: bottom; }
td:first-child { text-align: left; padding: 2px 10px 2px 3px; }
table { border: 0; }
a.symlink { font-style: italic; }
*/
</style>
 </head>
 <body>
  <?php
  echo $txt_highlight_type[$FileExt]($File[$i]['FileContent']);
  ?>
 </body>
</html>
<?php }
	if($_GET['act']=="view") {
	echo $File[$i]['FileContent']; }
	if($_GET['act']=="download") {
	if($_GET['output']=="none") {
	echo $File[$i]['FileContent']; }
	if($_GET['output']=="gzip") {
	echo gzencode($File[$i]['FileContent']); }
	if($_GET['output']=="bzip2") {
	echo bzcompress($File[$i]['FileContent']); } }
	$fileview = true; }
++$i; }
if($fileview===false) { $_GET['act'] = "list"; } }
if($_GET['act']=="list") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> Source Viewer 2k </title>
  <meta name="generator" content="<?php echo $appversion; ?>" />
  <base href="<?php echo $url; ?>" />
  <link rel="icon" href="favicon.ico" type="image/icon" />
  <link rel="shortcut icon" href="favicon.ico" type="image/icon" />
<style type="text/css">
img { border: 0; padding: 0 2px; vertical-align: text-bottom; }
td  { font-family: monospace; padding: 2px 3px; text-align: right; vertical-align: bottom; }
td:first-child { text-align: left; padding: 2px 10px 2px 3px; }
table { border: 0; }
a.symlink { font-style: italic; }
</style>
 </head>

 <body>
<?php
header("Content-type: text/html");
if(!isset($_GET['tar'])) { 
if(isset($_GET['dir'])) { 
	$_GET['dir'] = preg_replace("/(.*?)\.\/(.*?)/", "/", $_GET['dir']); }
chdir($sourcedir.$_GET['dir']);
if($dirstyle=="new") {
echo "Reading dir ".$_GET['dir']."<br />\n";
if($urltype===1) {
echo "<img style=\"text-decoration: none;\" src=\"".$back_image."\" alt=\"dir\" /> <a href=\"?act=list&amp;&amp;dir=".$_GET['dir']."\">./</a><br />\n";
echo "<img style=\"text-decoration: none;\" src=\"".$back_image."\" alt=\"dir\" /> <a href=\"?act=list&amp;dir=".preg_replace("/^\\\\/isU", "",preg_replace('{/$}', '', dirname($_GET['dir'])))."/\">../</a><br />\n"; }
if($urltype===2) {
echo "<img style=\"text-decoration: none;\" src=\"".$back_image."\" alt=\"dir\" /> <a href=\"list".$_GET['dir']."\">./</a><br />\n";
echo "<img style=\"text-decoration: none;\" src=\"".$back_image."\" alt=\"dir\" /> <a href=\"list".preg_replace("/^\\\\/isU", "",preg_replace('{/$}', '', dirname($_GET['dir'])))."/\">../</a><br />\n"; } }
if($dirstyle=="old") {
echo "<h1>Index of ".$_GET['dir']."</h1>\n"; 
echo "<hr /><table><tbody>\n";
if($urltype===1) {
echo "<tr><td style=\"text-align: left;\"><img src=\"".$back_image."\" alt=\"dir\" /> <a href=\"?act=list&amp;dir=".preg_replace("/^\\\\/isU", "",preg_replace('{/$}', '', dirname($_GET['dir'])))."/\">Parent Directory</a></td></tr>\n"; }
if($urltype===2) {
echo "<tr><td style=\"text-align: left;\"><img src=\"".$back_image."\" alt=\"dir\" /> <a href=\"list".preg_replace("/^\\\\/isU", "",preg_replace('{/$}', '', dirname($_GET['dir'])))."/\">Parent Directory</a></td></tr>\n"; } }
	if (is_array(glob("*",GLOB_ONLYDIR))) {
	foreach (glob("*",GLOB_ONLYDIR) as $filename) {
	$FilePic = $dir_image;
	$FileType = "dir";
	if($urltype===1) {
	if($dirstyle=="new") {
	echo "<img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /> <a href=\"?act=list&amp;dir=".$_GET['dir'].$filename."/\">".$filename."</a><br />\n"; } 
	if($dirstyle=="old") {
	echo "<tr>";
	echo "<td style=\"text-align: left;\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /> <a href=\"?act=list&amp;dir=".$_GET['dir'].$filename."/\">".$filename."</a></td>";
	echo "<td>&nbsp;</td>";
	echo "<td>".GMTimeChange("n/j/Y",filemtime($filename),$TimeOffSet,null,$_GET['dst'])."</td>";
	echo "<td>".GMTimeChange("g:i:s A",filemtime($filename),$TimeOffSet,null,$_GET['dst'])."</td>";
	echo "</tr>\n"; } } 
	if($urltype===2) {
	if($dirstyle=="new") {
	echo "<img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /> <a href=\"list".$_GET['dir'].$filename."/\">".$_GET['dir'].$filename."</a><br />\n"; } 
		if($dirstyle=="old") {
	echo "<tr>";
	echo "<td style=\"text-align: left;\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /> <a href=\"list".$_GET['dir'].$filename."/\">".$filename."</a></td>";
	echo "<td>&nbsp;</td>";
	echo "<td>".GMTimeChange("n/j/Y",filemtime($filename),$TimeOffSet,null,$_GET['dst'])."</td>";
	echo "<td>".GMTimeChange("g:i:s A",filemtime($filename),$TimeOffSet,null,$_GET['dst'])."</td>";
	echo "</tr>\n"; } } } }
	if (is_array(glob("*.tar"))) {
	foreach (glob("*.tar") as $filename) {
	$FilePic = $bin_image['tar'];
	$FileType = "bin";
	if($urltype===1) {
	if($dirstyle=="new") {
	echo "<a href=\"?act=".$dwntarlink."&amp;output=gzip&amp;tar=".$_GET['dir'].$filename."\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /></a> <a href=\"?act=list&amp;tar=".$_GET['dir'].$filename."&amp;dir=/\" title=\"".format_size(filesize($filename))."\">".$_GET['dir'].$filename."</a><br />\n"; } 
	if($dirstyle=="old") {
	echo "<tr>";
	echo "<td style=\"text-align: left;\"><a href=\"?act=".$dwntarlink."&amp;output=gzip&amp;tar=".$_GET['dir'].$filename."\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /></a> <a href=\"?act=list&amp;tar=".$_GET['dir'].$filename."&amp;dir=/\">".$filename."</a></td>";
	echo "<td>".format_size(filesize($filename))."</td>";
	echo "<td>".GMTimeChange("n/j/Y",filemtime($filename),$TimeOffSet,null,$_GET['dst'])."</td>";
	echo "<td>".GMTimeChange("g:i:s A",filemtime($filename),$TimeOffSet,null,$_GET['dst'])."</td>";
	echo "</tr>\n"; } } 
	if($urltype===2) {
	if($dirstyle=="new") {
	echo "<a href=\"".$dwntarlink.$_GET['dir'].$filename."\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /></a> <a href=\"list".$_GET['dir'].$filename.$PathSep."/\" title=\"".format_size(filesize($filename))."\">".$_GET['dir'].$filename."</a><br />\n"; } 
	if($dirstyle=="old") {
	echo "<tr>";
	echo "<td style=\"text-align: left;\"><a href=\"".$dwntarlink.$_GET['dir'].$filename."\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /></a> <a href=\"list".$_GET['dir'].$filename.$PathSep."/\">".$filename."</a></td>";
	echo "<td>".format_size(filesize($filename))."</td>";
	echo "<td>".GMTimeChange("n/j/Y",filemtime($filename),$TimeOffSet,null,$_GET['dst'])."</td>";
	echo "<td>".GMTimeChange("g:i:s A",filemtime($filename),$TimeOffSet,null,$_GET['dst'])."</td>";
	echo "</tr>\n"; } } } }
if($dirstyle=="old") {
echo "</tbody></table><hr />"; } }
if(isset($_GET['tar'])) {
$_GET['tar'] = preg_replace("/(.*?)\.\/(.*?)/", "/iDB.tar", $_GET['tar']);
if(isset($_GET['dir'])&&strlen($_GET['dir'])>1) { 
	$_GET['dir'] = preg_replace('{/$}', '', $_GET['dir']); }
if($dirstyle=="new") {
echo "Reading dir ".$_GET['tar'].$PathSep.$_GET['dir']."<br />\n"; }
if($dirstyle=="old") {
echo "<h1>Index of ".$_GET['tar'].$PathSep.$_GET['dir']."</h1>\n"; 
echo "<hr /><table>\n<tbody>"; 
if($urltype===1) {
if(isset($_GET['dir'])&&strlen($_GET['dir'])>1) {
echo "<tr><td style=\"text-align: left;\"><img src=\"".$back_image."\" alt=\"dir\" /> <a href=\"?act=list&amp;tar=".$_GET['tar']."&amp;dir=".preg_replace("/^\\\\/isU", "/",dirname($_GET['dir']))."\">Parent Directory</a></td></tr>\n"; }
if(isset($_GET['dir'])&&strlen($_GET['dir'])<=1) {
echo "<tr><td style=\"text-align: left;\"><img src=\"".$back_image."\" alt=\"dir\" /> <a href=\"?act=list&amp;dir=".preg_replace("/^\\\\/isU", "/",preg_replace('{/$}', '', dirname($_GET['tar'])))."/\">Parent Directory</a></td></tr>\n"; } }
if($urltype===2) {
if(isset($_GET['dir'])&&strlen($_GET['dir'])>1) {
echo "<tr><td style=\"text-align: left;\"><img src=\"".$back_image."\" alt=\"dir\" /> <a href=\"list".$_GET['tar'].$PathSep.preg_replace("/^\\\\/isU", "/",dirname($_GET['dir']))."\">Parent Directory</a></td></tr>\n"; }
if(isset($_GET['dir'])&&strlen($_GET['dir'])<=1) {
echo "<tr><td style=\"text-align: left;\"><img src=\"".$back_image."\" alt=\"dir\" /> <a href=\"list".preg_replace("/^\\\\/isU", "/",preg_replace('{/$}', '', dirname($_GET['tar'])))."/\">Parent Directory</a></td></tr>\n"; } } }
if($dirstyle=="new") {
if($urltype===1) {
echo "<img style=\"text-decoration: none;\" src=\"".$back_image."\" alt=\"dir\" /> <a href=\"?act=list&amp;tar=".$_GET['tar']."&amp;dir=".$_GET['dir']."\">./</a><br />\n";
if(isset($_GET['dir'])&&strlen($_GET['dir'])>1) {
echo "<img style=\"text-decoration: none;\" src=\"".$back_image."\" alt=\"dir\" /> <a href=\"?act=list&amp;tar=".$_GET['tar']."&amp;dir=".preg_replace("/^\\\\/isU", "/",dirname($_GET['dir']))."\">../</a><br />\n"; }
if(isset($_GET['dir'])&&strlen($_GET['dir'])<=1) {
echo "<img style=\"text-decoration: none;\" src=\"".$back_image."\" alt=\"dir\" /> <a href=\"?act=list&amp;dir=".preg_replace("/^\\\\/isU", "/",preg_replace('{/$}', '', dirname($_GET['tar'])))."/\">../</a><br />\n"; } }
if($urltype===2) {
echo "<img style=\"text-decoration: none;\" src=\"".$back_image."\" alt=\"dir\" /> <a href=\"list".$_GET['tar'].$PathSep.$_GET['dir']."\">./</a><br />\n";
if(isset($_GET['dir'])&&strlen($_GET['dir'])>1) {
echo "<img style=\"text-decoration: none;\" src=\"".$back_image."\" alt=\"dir\" /> <a href=\"list".$_GET['tar'].$PathSep.preg_replace("/^\\\\/isU", "/",dirname($_GET['dir']))."\">../</a><br />\n"; }
if(isset($_GET['dir'])&&strlen($_GET['dir'])<=1) {
echo "<img style=\"text-decoration: none;\" src=\"".$back_image."\" alt=\"dir\" /> <a href=\"list".preg_replace("/^\\\\/isU", "/",preg_replace('{/$}', '', dirname($_GET['tar'])))."/\">../</a><br />\n"; } } }
$i = 0; $num = count($File);
while ($i < $num) {
if($File[$i]['FileType']=="0"&&$_GET['dir']==preg_replace("/^\\\\/isU", "/",dirname($File[$i]['FileName']))) {
	if(count(explode(".",$File[$i]['FileName']))>1) {
	$FileExp = strtolower(end(explode(".",$File[$i]['FileName']))); }
	if(count(explode(".",$File[$i]['FileName']))<=1) {
	$FileExp = "null"; }
	if(isset($FileExp)) { $FileExt = $FileExp; }
	$FilePic = $unknown_image;
	if(in_array($FileExt, $txt_type)) { 
	$FilePic = $txt_image[$FileExt]; }
	if(in_array($FileExt, $bin_type)) { 
	$FilePic = $bin_image[$FileExt]; }
	if(in_array($FileExt, $img_type)) { 
	$FilePic = $img_image[$FileExt]; }
	if(!isset($FilePic)||$FilePic==""||$FilePic===null) {
		$FilePic = $unknown_image; }
	$FileType = "file";
	if($urltype===1) {
	if($dirstyle=="new") {
	echo "<a href=\"?act=".$downloadlink."&amp;tar=".$_GET['tar']."&amp;file=".$File[$i]['FileName']."\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /></a> <a href=\"?act=".$urlview."&amp;tar=".$_GET['tar']."&amp;file=".$File[$i]['FileName']."\" title=\"".format_size($File[$i]['FileSize'])."\">".basename($File[$i]['FileName'])."</a><br />\n"; }
	if($dirstyle=="old") {
	echo "<tr>";
	echo "<td style=\"text-align: left;\"><a href=\"?act=".$downloadlink."&amp;tar=".$_GET['tar']."&amp;file=".$File[$i]['FileName']."\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /></a> <a href=\"?act=".$urlview."&amp;tar=".$_GET['tar']."&amp;file=".$File[$i]['FileName']."\">".basename($File[$i]['FileName'])."</a></td>";
	echo "<td>".format_size($File[$i]['FileSize'])."</td>";
	echo "<td>".date("n/j/Y", $File[$i]['LastEdit'])."</td>";
	echo "<td>".date("g:i:s A", $File[$i]['LastEdit'])."</td>";
	echo "</tr>\n"; } } 
	if($urltype===2) {
	if($dirstyle=="new") {
	echo "<a href=\"".$downloadlink.$_GET['tar'].$PathSep.$File[$i]['FileName']."\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /></a> <a href=\"".$urlview.$_GET['tar'].$PathSep.$File[$i]['FileName']."\" title=\"".format_size($File[$i]['FileSize'])."\">".basename($File[$i]['FileName'])."</a><br />\n"; }
	if($dirstyle=="old") {
	echo "<tr>";
	echo "<td style=\"text-align: left;\"><a href=\"".$downloadlink.$_GET['tar'].$PathSep.$File[$i]['FileName']."\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /></a> <a href=\"".$urlview.$_GET['tar'].$PathSep.$File[$i]['FileName']."\">".basename($File[$i]['FileName'])."</a></td>";
	echo "<td>".format_size($File[$i]['FileSize'])."</td>";
	echo "<td>".date("n/j/Y", $File[$i]['LastEdit'])."</td>";
	echo "<td>".date("g:i:s A", $File[$i]['LastEdit'])."</td>";
	echo "</tr>\n"; } } }
if($File[$i]['FileType']=="5"&&$_GET['dir']==preg_replace("/^\\\\/isU", "/",dirname($File[$i]['FileName']))) {
	$FilePic = $dir_image;
	$FileType = "dir";
	if($urltype===1) {
	if($dirstyle=="new") {
	echo "<img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /> <a href=\"?act=list&amp;tar=".$_GET['tar']."&amp;dir=".preg_replace('{/$}', '', $File[$i]['FileName'])."\">".basename($File[$i]['FileName'])."</a><br />\n"; } 
	if($dirstyle=="old") {
	echo "<tr>";
	echo "<td style=\"text-align: left;\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /> <a href=\"?act=list&amp;tar=".$_GET['tar']."&amp;dir=".preg_replace('{/$}', '', $File[$i]['FileName'])."\">".basename($File[$i]['FileName'])."</a></td>";
	echo "<td>&nbsp;</td>";
	echo "<td>".date("n/j/Y", $File[$i]['LastEdit'])."</td>";
	echo "<td>".date("g:i:s A", $File[$i]['LastEdit'])."</td>";
	echo "</tr>\n"; } } 
	if($urltype===2) {
	if($dirstyle=="new") {
	echo "<img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /> <a href=\"list".$_GET['tar'].$PathSep.preg_replace('{/$}', '', $File[$i]['FileName'])."\">".basename($File[$i]['FileName'])."</a><br />\n"; }
	if($dirstyle=="old") {
	echo "<tr>";
	echo "<td style=\"text-align: left;\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /> <a href=\"list".$_GET['tar'].$PathSep.preg_replace('{/$}', '', $File[$i]['FileName'])."\">".basename($File[$i]['FileName'])."</a></td>";
	echo "<td>&nbsp;</td>";
	echo "<td>".date("n/j/Y", $File[$i]['LastEdit'])."</td>";
	echo "<td>".date("g:i:s A", $File[$i]['LastEdit'])."</td>";
	echo "</tr>\n"; } } }
if($File[$i]['FileType']=="7"&&$_GET['dir']==preg_replace("/^\\\\/isU", "/",dirname($File[$i]['FileName']))) {
	if(count(explode(".",$File[$i]['FileName']))>1) {
	$FileExp = strtolower(end(explode(".",$File[$i]['FileName']))); }
	if(count(explode(".",$File[$i]['FileName']))<=1) {
	$FileExp = "null"; }
	if(isset($FileExp)) { $FileExt = $FileExp; }
	if(in_array($FileExt, $txt_type)) { 
	$FilePic = $txt_image[$FileExt]; }
	if(in_array($FileExt, $bin_type)) { 
	$FilePic = $bin_image[$FileExt]; }
	if(in_array($FileExt, $img_type)) { 
	$FilePic = $img_image[$FileExt]; }
	$FileType = "file";
	if($urltype===1) {
	if($dirstyle=="new") {
	echo "<a href=\"?act=".$downloadlink."&amp;tar=".$_GET['tar']."&amp;file=".$File[$i]['FileName']."\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /></a> <a href=\"?act=".$urlview."&amp;tar=".$_GET['tar']."&amp;file=".$File[$i]['FileName']."\" title=\"".format_size($File[$i]['FileSize'])."\">".basename($File[$i]['FileName'])."</a><br />\n"; }
	if($dirstyle=="old") {
	echo "<tr>";
	echo "<td style=\"text-align: left;\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /> <a href=\"?act=list&amp;tar=".$_GET['tar']."&amp;dir=".preg_replace('{/$}', '', $File[$i]['FileName'])."\">".basename($File[$i]['FileName'])."</a></td>";
	echo "<td>&nbsp;</td>";
	echo "<td>".date("n/j/Y", $File[$i]['LastEdit'])."</td>";
	echo "<td>".date("g:i:s A", $File[$i]['LastEdit'])."</td>";
	echo "</tr>\n"; } } 
	if($urltype===1) {
	if($dirstyle=="new") {
	echo "<a href=\"".$urlview.$_GET['tar'].$PathSep.$File[$i]['FileName']."\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /></a> <a href=\"view".$_GET['tar'].$PathSep.$File[$i]['FileName']."\" title=\"".format_size($File[$i]['FileSize'])."\">".basename($File[$i]['FileName'])."</a><br />\n"; } 
	if($dirstyle=="old") {
	echo "<tr>";
	echo "<td style=\"text-align: left;\"><img style=\"text-decoration: none;\" src=\"".$FilePic."\" alt=\"".$FileType."\" /> <a href=\"list".$_GET['tar'].$PathSep.preg_replace('{/$}', '', $File[$i]['FileName'])."\">".basename($File[$i]['FileName'])."</a></td>";
	echo "<td>&nbsp;</td>";
	echo "<td>".date("n/j/Y", $File[$i]['LastEdit'])."</td>";
	echo "<td>".date("g:i:s A", $File[$i]['LastEdit'])."</td>";
	echo "</tr>\n"; } } }
++$i; } 
if($dirstyle=="old") {
echo "</tbody></table><hr />\n"; } }
if($dirstyle=="old") {
echo "<address>".$appversion."</address>\n"; }
?>
 </body>
</html>
<?php } ?>