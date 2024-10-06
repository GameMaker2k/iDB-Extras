<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2008 Cool Dude 2k - https://idb.osdn.jp/support/category.php?act=view&id=2
    Copyright 2004-2008 Game Maker 2k - https://idb.osdn.jp/support/category.php?act=view&id=2

    $FileInfo: image.php - Last Update: 12/15/2011 RC 5 Ver. 3.0.0 - Author: cooldude2k $
*/
//@ob_clean();
@ob_start();
$urltype = 1;
$url = "http://hostname.domain/url/to/path/";
$urlfname = "index.php";
$appname = "Neo Source Viewer";
$appver = array(3,0,0,"RC 3");
function version_info($proname, $subver, $ver, $supver, $reltype, $svnver, $showsvn)
{
    $return_var = $proname." ".$reltype." ".$subver.".".$ver.".".$supver;
    if ($showsvn == false) {
        $showsvn = null;
    }
    if ($showsvn == true) {
        $return_var .= " SVN ".$svnver;
    }
    if ($showsvn != true && $showsvn != null) {
        $return_var .= " ".$showsvn." ".$svnver;
    }
    return $return_var;
}
$appversion = version_info($appname, $appver[0], $appver[1], $appver[2], $appver[3]." Ver.", null, false);
function redirect($type, $file, $time = 0, $url = null, $dbsr = true)
{
    if ($type != "location" && $type != "refresh") {
        $type == "location";
    }
    if ($url != null) {
        $file = $url.$file;
    }
    if ($dbsr == true) {
        $file = str_replace("//", "/", $file);
    }
    if ($type == "refresh") {
        header("Refresh: ".$time."; URL=".$file);
    }
    if ($type == "location") {
        @session_write_close();
        header("Location: ".$file);
    } return true;
}
if (dirname($_SERVER['SCRIPT_NAME']) != ".") {
    $basedir = dirname($_SERVER['SCRIPT_NAME'])."/";
}
if (dirname($_SERVER['SCRIPT_NAME']) == ".") {
    $basedir = dirname($_SERVER['PHP_SELF'])."/";
}
if ($basedir == "\/") {
    $basedir = "/";
}
if ($_SERVER['PATH_INFO'] == null) {
    if (@getenv('PATH_INFO') != null && @getenv('PATH_INFO') != "1") {
        $_SERVER['PATH_INFO'] = @getenv('PATH_INFO');
    }
}
if ($_SERVER['PATH_INFO'] != null) {
    $_GET['dir'] = $_SERVER['PATH_INFO'];
}
if ($_GET['dir'] == "1") {
    $_GET['dir'] = "/";
}
if (!isset($_GET['dir'])) {
    $_GET['dir'] = "/";
}
$_GET['dir'] = preg_replace("/(.*?)\.\/(.*?)/", "iDB", $_GET['dir']);
if ($urltype == 1) {
    redirect("location", $urlfname."?dir=".$_GET['dir']."&act=lowview", 0, $url, false);
}
if ($urltype == 2) {
    redirect("location", $urlfname.$_GET['dir']."?act=lowview", 0, $url, false);
}
