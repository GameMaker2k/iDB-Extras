<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2008 Cool Dude 2k - http://idb.berlios.de/
    Copyright 2004-2008 Game Maker 2k - http://intdb.sourceforge.net/

    $FileInfo: index.php - Last Update: 12/15/2011 RC 5 Ver. 3.0.0 - Author: cooldude2k $
*/
//@ob_clean();
@ob_start();
$urltype = 1;
$url = "http://hostname.domain/url/to/path/";
$urlfname = "index.php";
$appname = "Neo Source Viewer";
$appver = array(3,0,0,"RC 3");
function version_info($proname,$subver,$ver,$supver,$reltype,$svnver,$showsvn) {
	$return_var = $proname." ".$reltype." ".$subver.".".$ver.".".$supver;
	if($showsvn==false) { $showsvn = null; }
	if($showsvn==true) { $return_var .= " SVN ".$svnver; }
	if($showsvn!=true&&$showsvn!=null) { $return_var .= " ".$showsvn." ".$svnver; }
	return $return_var; }
$appversion = version_info($appname,$appver[0],$appver[1],$appver[2],$appver[3]." Ver.",null,false);
//List of text type files
$txt_type = "htm,html,php,txt,css,null,";
$txt_type = explode(",",$txt_type);
//List of image type files
$img_type = "gif,png,ico,jpg,jpeg,jpe,bmp";
$img_type = explode(",",$img_type);
//List of mime types
$mine_type = array(
	"gif" => "image/gif",
	"png" => "image/png",
	"ico" => "image/x-icon",
	"jpg" => "image/jpeg",
	"jpeg" => "image/jpeg",
	"jpe" => "image/jpeg",
	"bmp" => "image/bmp");
//List of binary type files
$bin_type = "ttf";
$bin_type = explode(",",$bin_type);
if(!isset($_SERVER['PATH_INFO'])) {
	$_SERVER['PATH_INFO'] = null; }
if(!isset($_GET['act'])) { 
	$_GET['act'] = "list"; }
if(!isset($urltype)) { $urltype = 1; }
if($urltype!=1&&$urltype!=2) { $urltype = 1; }
if(!isset($urlfname)) { $urlfname = "index.php"; }
if(dirname($_SERVER['SCRIPT_NAME'])!=".") {
$basedir = dirname($_SERVER['SCRIPT_NAME'])."/"; }
if(dirname($_SERVER['SCRIPT_NAME'])==".") {
$basedir = dirname($_SERVER['PHP_SELF'])."/"; }
if($basedir=="\/") { $basedir="/"; }
if($_SERVER['PATH_INFO']==null) {
	if(@getenv('PATH_INFO')!=null&&@getenv('PATH_INFO')!="1") {
$_SERVER['PATH_INFO'] = @getenv('PATH_INFO'); } }
if($_SERVER['PATH_INFO']!=null) {
$_GET['dir'] = $_SERVER['PATH_INFO']; }
if($_GET['dir']=="1") { $_GET['dir']="/"; }
if(!isset($_GET['dir'])) { 
	$_GET['dir'] = "/"; }
$_GET['dir']=preg_replace("/(.*?)\.\/(.*?)/", "iDB", $_GET['dir']);
$dayconv = array('second' => 1, 'minute' => 60, 'hour' => 3600, 'day' => 86400, 'week' => 604800, 'month' => 2630880, 'year' => 31570560, 'decade' => 15705600);
$twohour = $dayconv['hour'] * 0;
function file_get_source($filename,$return = TRUE)
{
$phpsrc = file_get_contents($filename);
$phpsrcs = highlight_string($phpsrc,$return);
$phpsrcs = preg_replace("/\<font color=\"(.*?)\"\>/i", "<span style=\"color: \\1;\">", $phpsrcs);
$phpsrcs = preg_replace("/\<\/font>/i", "</span>", $phpsrcs);
return $phpsrcs;
}
function GMTimeChange($format,$timestamp,$offset,$minoffset=null,$dst=null) {
$TCHour = date("H",$timestamp);
$TCMinute = date("i",$timestamp);
$TCSecond = date("s",$timestamp);
$TCMonth = date("n",$timestamp);
$TCDay = date("d",$timestamp);
$TCYear = date("Y",$timestamp);
unset($dstake); $dstake = null;
if(!is_numeric($minoffset)) { $minoffset = "00"; }
$ts_array = explode(":",$offset);
if(count($ts_array)!=2) {
	if(!isset($ts_array[0])) { $ts_array[0] = "0"; }
	if(!isset($ts_array[1])) { $ts_array[1] = "00"; }
	$offset = $ts_array[0].":".$ts_array[1]; }
if(!is_numeric($ts_array[0])) { $ts_array[0] = "0"; }
if($ts_array[0]>12) { $ts_array[0] = "12"; $offset = $ts_array[0].":".$ts_array[1]; }
if($ts_array[0]<-12) { $ts_array[0] = "-12"; $offset = $ts_array[0].":".$ts_array[1]; }
if(!is_numeric($ts_array[1])) { $ts_array[1] = "00"; }
if($ts_array[1]>59) { $ts_array[1] = "59"; $offset = $ts_array[0].":".$ts_array[1]; }
if($ts_array[1]<0) { $ts_array[1] = "00"; $offset = $ts_array[0].":".$ts_array[1]; }
$tsa = array("offset" => $offset, "hour" => $ts_array[0], "minute" => $ts_array[1]);
//$tsa['minute'] = $tsa['minute'] + $minoffset;
if($dst!="on"&&$dst!="off") { $dst = "off"; }
if($dst=="on") { if($dstake!="done") { 
	$dstake = "done"; $tsa['hour'] = $tsa['hour']+1; } }
$TCHour = $TCHour + $tsa['hour'];
$TCMinute = $TCMinute + $tsa['minute'];
return date($format,mktime($TCHour,$TCMinute,$TCSecond,$TCMonth,$TCDay,$TCYear)); }
function SeverOffSet() {
$TestHour1 = date("H");
$TestHour2 = gmdate("H");
$TestHour3 = $TestHour1-$TestHour2;
return $TestHour3; }
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
function format_size($size, $round = 0) {
    //Size must be bytes!
    $sizes = array(' B', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB');
    for ($i=0; $size > 1024 && $i < count($sizes); $i++) $size /= 1024;
    return round($size,$round).$sizes[$i];
}
function file_list_dir($dirname) {
if (!isset($dirnum)) { $dirnum = null; }
$srcfile = array();
$srcdir = array();
if ($handle = opendir($dirname)) {
while (false !== ($file = readdir($handle))) {
      if ($dirnum==null) { $dirnum = 0; }
	  if ($file != "." && $file != ".." && $file != ".htaccess" && $file != null) {
      if(filetype($dirname.$file)=="link") {
      if(is_file($dirname.$file)===true) { 
	  $srcfile[$dirnum] = $file; }
      if(is_dir($dirname.$file)===true) { 
	  $srcdir[$dirnum] = $file; } }
      if(filetype($dirname.$file)=="file") {
	  $srcfile[$dirnum] = $file; }
      if(filetype($dirname.$file)=="dir") {
	  $srcdir[$dirnum] = $file; }
	  ++$dirnum;
	  } }
if($srcdir!=null) { asort($srcdir); }
if($srcfile!=null) { asort($srcfile); }
if($srcdir!=null&&$srcfile!=null) {
$fulllist = array_merge($srcdir, $srcfile); }
if($srcdir!=null&&$srcfile==null) { $fulllist = $srcdir; }
if($srcdir==null&&$srcfile!=null) { $fulllist = $srcfile; }
closedir($handle); }
 return $fulllist; }
$addurlpart = null;
if(isset($_GET['offset'])) {
$addurlpart = $addurlpart."&amp;offset=".$_GET['offset']; }
if(isset($_GET['minoffset'])) {
$addurlpart = $addurlpart."&amp;minoffset=".$_GET['minoffset']; }
if(isset($_GET['dst'])) {
$addurlpart = $addurlpart."&amp;dst=".$_GET['dst']; }
if($_GET['act']=="list"||$_GET['act']=="dir") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 <head>
  <title> Index of <?php echo $_GET['dir']; ?> </title>
  <meta name="Generator" content="<?php echo $appversion; ?>" />
  <meta name="Author" content="" />
  <meta name="Keywords" content="" />
  <meta name="Description" content="" />
  <meta http-equiv="Content-Language" content="en" />
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
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
<h1>Index of <?php echo $_GET['dir']; ?></h1>
<hr /><table>
<tbody>
<?php
$file = @file_list_dir("source".$_GET['dir']);
$num=count($file);
$i=0;
if($num<=0) {
?>
<tr>
 <td style="text-align: left;">&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
</tr>
<?php } $olddir = null;
if($_GET['dir']!="/"&&$num>0) {
$goback = explode("/",$_GET['dir']);
$numz = count($goback)-2;
$iz=1;
while ($iz < $numz) {
	$olddir=$olddir."/".$goback[$iz];
	++$iz; } 
if($urltype==1) {
$FileURL = $urlfname."?dir=".$olddir."/&amp;act=list".$addurlpart; }
if($urltype==2) {
$FileURL = $urlfname.$olddir."/?act=list".$addurlpart; }
?>
<tr><td style="text-align: left;"><a href="<?php echo $FileURL; ?>"><img src="back.gif" alt="dir" /></a><a href="<?php echo $FileURL; ?>">..</a></td></tr>
<?php }
while ($i < $num) {
$FileName = $file[$i];
$FileType = filetype("source".$_GET['dir'].$file[$i]);
      if(filetype("source".$_GET['dir'].$file[$i])=="link") {
      if(is_file("source".$_GET['dir'].$file[$i])===true) { 
	  $FileType = "file"; }
      if(is_dir("source".$_GET['dir'].$file[$i])===true) { 
	  $FileType = "dir"; } }
$FileSize = filesize("source".$_GET['dir'].$FileName);
$FileTimeStamp = filemtime("source".$_GET['dir'].$FileName);
if($FileType=="file") {
$FileExp = explode(".",$FileName);
$FileBaseName = $FileExp[0];
if(isset($FileExp[1])) {
$FileExt = $FileExp[1]; }
if(!isset($FileExp[1])) {
$FileExt = null; } }
if($FileType=="dir") {
$FileBaseName = $FileName;
$FileExt = null; }
if($FileType=="dir") {
if($urltype==1) {
$FileURL = $urlfname."?dir=".$_GET['dir'].$FileName."/&amp;act=list".$addurlpart; }
if($urltype==2) {
$FileURL = $urlfname.$_GET['dir'].$FileName."/?act=list".$addurlpart; }
$FilePic = "dir.gif"; }
if($FileType=="file") {
if($urltype==1) {
$FileURL = $urlfname."?dir=".$_GET['dir'].$FileName."&amp;act=view".$addurlpart; 
if(in_array($FileExt, $bin_type)) { 
$FileURL = $urlfname."?dir=".$_GET['dir'].$FileName."&amp;act=download".$addurlpart; } }
if($urltype==2) {
$FileURL = $urlfname.$_GET['dir'].$FileName."?act=view".$addurlpart; 
if(in_array($FileExt, $bin_type)) { 
$FileURL = $urlfname.$_GET['dir'].$FileName."?act=download".$addurlpart;  } }
if(in_array($FileExt, $txt_type)) { 
	$FilePic = "icnres/text.gif"; }
if(in_array($FileExt, $bin_type)) { 
	$FilePic = "icnres/binary.gif"; }
if(in_array($FileExt, $img_type)) { 
	$FilePic = "icnres/image.gif"; } }
?>
<tr>
 <td style="text-align: left;"><a href="<?php echo $FileURL; ?>"><img style="text-decoration: none;" src="<?php echo $FilePic; ?>" alt="<?php echo $FileType; ?>" /></a><a href="<?php echo $FileURL; ?>"><?php echo $FileName; ?></a></td>
<?php if($FileType=="file") { ?>
 <td><?php echo format_size($FileSize); ?></td>
<?php } if($FileType=="dir") { ?>
 <td>&nbsp;</td>
<?php } ?>
 <td><?php echo GMTimeChange("n/j/Y",$FileTimeStamp-$twohour,$TimeOffSet,null,$_GET['dst']); ?></td>
 <td><?php echo GMTimeChange("g:i:s A",$FileTimeStamp-$twohour,$TimeOffSet,null,$_GET['dst']); ?></td>
</tr>
<?php
++$i; } 
?>
</tbody></table><hr />
<?php if($urltype==1) { ?>
<form method="get" action="<?php echo $url.$urlfname; ?>">
<?php }  if($urltype==2) { ?>
<form method="get" action="<?php echo $url.$urlfname.$_GET['dir']; ?>">
<?php } ?>
<select id="offset" name="offset" class="TextBox"><?php
$tsa_mem = explode(":",$TimeOffSet);
$TimeZoneArray = array("offset" => $Settings['DefaultTimeZone'], "hour" => $tsa_mem[0], "minute" => $tsa_mem[1]);
$plusi = 1; $minusi = 12;
$plusnum = 13; $minusnum = 0;
while ($minusi > $minusnum) {
if($TimeZoneArray['hour']==-$minusi) {
echo "<option selected=\"selected\" value=\"-".$minusi."\">GMT - ".$minusi." hours</option>\n"; }
if($TimeZoneArray['hour']!=-$minusi) {
echo "<option value=\"-".$minusi."\">GMT - ".$minusi." hours</option>\n"; }
--$minusi; }
if($TimeZoneArray['hour']==0) { ?>
<option selected="selected" value="0">GMT +/- 0 hours</option>
<?php } if($TimeZoneArray['hour']!=0) { ?>
<option value="0">GMT +/- 0 hours</option>
<?php }
while ($plusi < $plusnum) {
if($TimeZoneArray['hour']==$plusi) {
echo "<option selected=\"selected\" value=\"".$plusi."\">GMT + ".$plusi." hours</option>\n"; }
if($TimeZoneArray['hour']!=$plusi) {
echo "<option value=\"".$plusi."\">GMT + ".$plusi." hours</option>\n"; }
++$plusi; }
?></select>
<select id="minoffset" name="minoffset" class="TextBox"><?php
$mini = 0; $minnum = 60;
while ($mini < $minnum) {
if(strlen($mini)==2) { $showmin = $mini; }
if(strlen($mini)==1) { $showmin = "0".$mini; }
if($mini==$TimeZoneArray['minute']) {
echo "\n<option selected=\"selected\" value=\"".$showmin."\">".$showmin." minutes</option>\n"; }
if($mini!=$TimeZoneArray['minute']) {
echo "<option value=\"".$showmin."\">".$showmin." minutes</option>\n"; }
++$mini; }
?></select>
<select id="dst" name="dst" class="TextBox"><?php echo "\n" ?>
<?php if($_GET['dst']=="off"&&$_GET['dst']!="on") { ?>
<option selected="selected" value="off">DST/ST off</option><?php echo "\n" ?><option value="on">DST/ST on</option>
<?php } if($_GET['dst']=="on") { ?>
<option selected="selected" value="on">DST/ST on</option><?php echo "\n" ?><option value="off">DST/ST off</option>
<?php } echo "\n" ?></select>
<input type="hidden" name="act" value="<?php echo $_GET['act']; ?>" style="display: none;" />
<?php if($urltype==1) { ?>
<input type="hidden" name="dir" value="<?php echo $_GET['dir']; ?>" style="display: none;" />
<?php } ?>
<input type="submit" value="set" />
</form>
 </body>
</html>
<?php } 
if($_GET['act']=="view"||$_GET['act']=="show") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 <head>
  <title> Viewing File <?php echo $_GET['dir']; ?> </title>
  <meta name="Generator" content="<?php echo $appversion; ?>" />
  <meta name="Author" content="" />
  <meta name="Keywords" content="" />
  <meta name="Description" content="" />
  <base href="<?php echo $url; ?>" />
  <meta http-equiv="Content-Language" content="en" />
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
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
<h1>Viewing File <?php echo $_GET['dir']; ?></h1>
<hr /><table>
<tbody>
<?php $olddir = null;
if($_GET['dir']!="/") {
$goback = explode("/",$_GET['dir']);
$numz = count($goback)-1;
$iz=1;
while ($iz < $numz) {
	$olddir=$olddir."/".$goback[$iz];
	++$iz; } 
if($urltype==1) {
$FileURL = $urlfname."?dir=".$olddir."/&amp;act=list".$addurlpart; }
if($urltype==2) {
$FileURL = $urlfname.$olddir."/?act=list".$addurlpart; }
$FileExp = explode(".",$_GET['dir']);
if(isset($FileExp[1])) {
$FileExt = $FileExp[1]; }
if($urltype==1) {
$DownloadURL = $urlfname."?dir=".$_GET['dir']."&amp;act=download&amp;output=text"; 
$GZipURL = $urlfname."?dir=".$_GET['dir']."&amp;act=download&amp;output=gzip"; 
$BZipURL = $urlfname."?dir=".$_GET['dir']."&amp;act=download&amp;output=bzip"; 
$LineURL = $urlfname."?dir=".$_GET['dir']."&amp;act=line";
$LowURL = $urlfname."?dir=".$_GET['dir']."&amp;act=lowview";
$SourceURL = $urlfname."?dir=".$_GET['dir']."&amp;act=highlight"; }
if($urltype==2) {
$DownloadURL = $urlfname.$_GET['dir']."?act=download&amp;output=text"; 
$GZipURL = $urlfname.$_GET['dir']."?act=download&amp;output=gzip"; 
$BZipURL = $urlfname.$_GET['dir']."?act=download&amp;output=bzip"; 
$LineURL = $urlfname.$_GET['dir']."?act=line"; 
$LowURL = $urlfname.$_GET['dir']."?act=text";
$SourceURL = $urlfname.$_GET['dir']."?act=highlight"; }
?>
<tr><td style="text-align: left;"><a href="<?php echo $FileURL; ?>"><img src="icnres/back.gif" alt="dir" /></a><a href="<?php echo $FileURL; ?>">..</a></td></tr>
<?php } 
if(in_array($FileExt, $txt_type)) { ?>
<tr>
 <td style="text-align: left;"><a href="<?php echo $DownloadURL; ?>"><img src="icnres/text.gif" alt="download" /></a><a href="<?php echo $DownloadURL; ?>">Download</a> &nbsp; <a href="<?php echo $GZipURL; ?>"><img src="icnres/zip.gif" alt="gzip" /></a><a href="<?php echo $GZipURL; ?>">Download GZip</a> &nbsp; <a href="<?php echo $BZipURL; ?>"><img src="icnres/zip.gif" alt="bzip2" /></a><a href="<?php echo $BZipURL; ?>">Download BZip2</a> &nbsp; <a href="<?php echo $LowURL; ?>"><img src="icnres/text.gif" alt="lowview" /></a><a href="<?php echo $LowURL; ?>">Low View</a> &nbsp; <a href="<?php echo $LineURL; ?>"><img src="icnres/text.gif" alt="lineview" /></a><a href="<?php echo $LineURL; ?>">Line View</a> &nbsp; <a href="<?php echo $SourceURL; ?>"><img src="icnres/text.gif" alt="lowviewtwo" /></a><a href="<?php echo $SourceURL; ?>">Alt Highlight View</a></td>
</tr>
<tr><td style="text-align: left;"><?php echo file_get_source("source".$_GET['dir']); ?></td></tr>
<?php }
if(in_array($FileExt, $img_type)) { ?>
<tr>
 <td style="text-align: left;"><a href="<?php echo $DownloadURL; ?>"><img src="icnres/text.gif" alt="download" /></a><a href="<?php echo $DownloadURL; ?>">Download</a> &nbsp; <a href="<?php echo $GZipURL; ?>"><img src="icnres/zip.gif" alt="gzip" /></a><a href="<?php echo $GZipURL; ?>">Download GZip</a> &nbsp; <a href="<?php echo $BZipURL; ?>"><img src="icnres/zip.gif" alt="bzip2" /></a><a href="<?php echo $BZipURL; ?>">Download BZip2</a> &nbsp; <a href="<?php echo $LowURL; ?>"><img src="icnres/text.gif" alt="lowview" /></a><a href="<?php echo $LowURL; ?>">Low View</a> &nbsp; <a href="<?php echo $LineURL; ?>"><img src="icnres/text.gif" alt="lineview" /></a><a href="<?php echo $LineURL; ?>">Line View</a> &nbsp; <a href="<?php echo $SourceURL; ?>"><img src="icnres/text.gif" alt="lowviewtwo" /></a><a href="<?php echo $SourceURL; ?>">Alt Highlight View</a></td>
</tr>
<?php if($urltype==1) { ?>
<tr><td style="text-align: left;"><img src="<?php echo $urlfname."?dir=".$_GET['dir']."&amp;act=text".$addurlpart; ?>" alt="<?php echo $_GET['dir']; ?>" /></td></tr>
<?php } if($urltype==2) { ?>
<tr><td style="text-align: left;"><img src="<?php echo $urlfname.$_GET['dir']."?act=text".$addurlpart; ?>" alt="<?php echo $_GET['dir']; ?>" /></td></tr>
<?php } } ?>
</tbody></table><hr />
<?php if($urltype==1) { ?>
<form method="get" action="<?php echo $url.$urlfname; ?>">
<?php }  if($urltype==2) { ?>
<form method="get" action="<?php echo $url.$urlfname.$_GET['dir']; ?>">
<?php } ?>
<select id="offset" name="offset" class="TextBox"><?php
$tsa_mem = explode(":",$TimeOffSet);
$TimeZoneArray = array("offset" => $Settings['DefaultTimeZone'], "hour" => $tsa_mem[0], "minute" => $tsa_mem[1]);
$plusi = 1; $minusi = 12;
$plusnum = 13; $minusnum = 0;
while ($minusi > $minusnum) {
if($TimeZoneArray['hour']==-$minusi) {
echo "<option selected=\"selected\" value=\"-".$minusi."\">GMT - ".$minusi." hours</option>\n"; }
if($TimeZoneArray['hour']!=-$minusi) {
echo "<option value=\"-".$minusi."\">GMT - ".$minusi." hours</option>\n"; }
--$minusi; }
if($TimeZoneArray['hour']==0) { ?>
<option selected="selected" value="0">GMT +/- 0 hours</option>
<?php } if($TimeZoneArray['hour']!=0) { ?>
<option value="0">GMT +/- 0 hours</option>
<?php }
while ($plusi < $plusnum) {
if($TimeZoneArray['hour']==$plusi) {
echo "<option selected=\"selected\" value=\"".$plusi."\">GMT + ".$plusi." hours</option>\n"; }
if($TimeZoneArray['hour']!=$plusi) {
echo "<option value=\"".$plusi."\">GMT + ".$plusi." hours</option>\n"; }
++$plusi; }
?></select>
<select id="minoffset" name="minoffset" class="TextBox"><?php
$mini = 0; $minnum = 60;
while ($mini < $minnum) {
if(strlen($mini)==2) { $showmin = $mini; }
if(strlen($mini)==1) { $showmin = "0".$mini; }
if($mini==$TimeZoneArray['minute']) {
echo "\n<option selected=\"selected\" value=\"".$showmin."\">".$showmin." minutes</option>\n"; }
if($mini!=$TimeZoneArray['minute']) {
echo "<option value=\"".$showmin."\">".$showmin." minutes</option>\n"; }
++$mini; }
?></select>
<select id="dst" name="dst" class="TextBox"><?php echo "\n" ?>
<?php if($_GET['dst']=="off"&&$_GET['dst']!="on") { ?>
<option selected="selected" value="off">DST/ST off</option><?php echo "\n" ?><option value="on">DST/ST on</option>
<?php } if($_GET['dst']=="on") { ?>
<option selected="selected" value="on">DST/ST on</option><?php echo "\n" ?><option value="off">DST/ST off</option>
<?php } echo "\n" ?></select>
<input type="hidden" name="act" value="<?php echo $_GET['act']; ?>" style="display: none;" />
<?php if($urltype==1) { ?>
<input type="hidden" name="dir" value="<?php echo $_GET['dir']; ?>" style="display: none;" />
<?php } ?>
<input type="submit" value="set" />
</form>
 </body>
</html>
<?php } 
if ($_GET['act']=="get"||$_GET['act']=="download") {
	if (!isset($_GET['output'])&&isset($_GET['foutput'])!=null) { 
		$_GET['output'] = $_GET['foutput']; }
	if (!isset($_GET['output'])&&!isset($_GET['foutput'])!=null) { 
		$_GET['output'] = "text"; }
	if ($_GET['output']=="gz") { $_GET['output'] = "gzip"; }
	if ($_GET['output']=="bz") { $_GET['output'] = "bzip2"; }
	if ($_GET['output']=="bz2") { $_GET['output'] = "bzip2"; }
	if ($_GET['output']=="bzip") { $_GET['output'] = "bzip2"; }
	if ($_GET['output']!="gzip"&&
		$_GET['output']!="bzip2") {
		$_GET['output'] = "text"; }
	@header("Content-type: text/plain");
	$dirtest = explode("/",$_GET['dir']);
	$inum = count($dirtest)-1; $file = $dirtest[$inum];
	$fcontent = file_get_contents("source".$_GET['dir']);
	if ($_GET['output']=="gzip") { echo gzencode($fcontent);
	header("Content-Disposition: attachment; filename=\"".$file.".gz\""); }
	if ($_GET['output']=="bzip2") { echo bzcompress($fcontent);
	header("Content-Disposition: attachment; filename=\"".$file.".bz2\""); }
	if ($_GET['output']=="text") { echo $fcontent;
	header("Content-Disposition: attachment; filename=\"".$file."\""); } }
if ($_GET['act']=="lowview"||$_GET['act']=="text") {
	$FileExt = explode(".",$_GET['dir']); 
	if($FileExt[1]=="gif") {
	@header("Content-type: image/gif"); }
	if($FileExt[1]=="png") {
	@header("Content-type: image/png"); }
	if($FileExt[1]=="ico") {
	@header("Content-type: image/x-icon"); }
	if($FileExt[1]!="gif"&&$FileExt[1]!="png"&&$FileExt[1]!="ico") {
	@header("Content-type: text/plain"); }
	echo file_get_contents("source".$_GET['dir']); }
if ($_GET['act']=="highlight"||$_GET['act']=="sourcecode") {
	$FileExt = explode(".",$_GET['dir']); 
	if(in_array($FileExt[1], $img_type)) {
	@header("Content-type: ".$mine_type[$FileExt[1]]);
	echo file_get_contents("source".$_GET['dir']);}
	if(in_array($FileExt[1], $txt_type)) {
	@header("Content-type: text/html"); 
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 <head>
  <title> Viewing file <?php echo $_GET['dir']; ?> </title>
  <meta name="Generator" content="<?php echo $appversion; ?>" />
  <meta name="Author" content="" />
  <meta name="Keywords" content="" />
  <meta name="Description" content="" />
  <meta http-equiv="Content-Language" content="en" />
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
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
  echo file_get_source("source".$_GET['dir']); 
 ?> 
 </body>
</html><?php } }
if ($_GET['act']=="lineview"||$_GET['act']=="line") {
	$FileExt = explode(".",$_GET['dir']); 
	if(in_array($FileExt[1], $img_type)) {
	@header("Content-type: ".$mine_type[$FileExt[1]]);
	echo file_get_contents("source".$_GET['dir']); }
	if(in_array($FileExt[1], $txt_type)) {
	@header("Content-type: text/plain");
	$Code = explode("\n",file_get_contents("source".$_GET['dir']));
	$Last = count($Code)-1;
	$i=0;
	while ($i <= $Last) {
	$Line = $i+1;
	//$Code[$i] = htmlentities($Code[$i]);
	echo $Line.": ".$Code[$i]."\n";
	++$i; } } }
?>
