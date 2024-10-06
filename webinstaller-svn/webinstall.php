<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2010 iDB Support - https://idb.osdn.jp/support/category.php?act=view&id=1
    Copyright 2004-2010 Game Maker 2k - https://idb.osdn.jp/support/category.php?act=view&id=2

    $FileInfo: webinstall.php - Last Update: 09/24/2010 Ver 3.0 - Author: cooldude2k $
*/
@ob_start();
// HTTP Download Info
$HTTPURL = "http://intdb.svn.sourceforge.net/viewvc/intdb/trunk/?view=tar";
// File Name Info for both FTP and HTTP
$TARGZFILE = "iDB.tar.gz";
$TARFILE = "iDB.tar";
require_once("./untar.php");
$mydir = addslashes(str_replace("\\", "/", dirname(__FILE__)."/"));
$tarhandle = fopen("./".$TARGZFILE, "a+");
fwrite($tarhandle, file_get_contents($HTTPURL));
fclose($tarhandle);
chmod("./".$TARGZFILE, 0777);
gunzip("./".$TARGZFILE, "./".$TARFILE);
unlink("./".$TARGZFILE);
unlink("./LICENSE");
untar("./".$TARFILE, "./");
unlink("./".$TARFILE);
unlink("./untar.php");
unlink("./webinstall.php");
header("Location: ./install.php");
