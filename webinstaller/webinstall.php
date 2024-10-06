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
// FTP Download Info
$FTPURL = "ftp.berlios.de";
$FTPUSER = "anonymous";
$FTPPASS = "";
$FTPPATH = "/pub/idb/nighty-ver/";
// HTTP Download Info
$HTTPURL = "http://download.berlios.de/idb/";
// File Name Info for both FTP and HTTP
$TARGZFILE = "iDB.tar.gz";
$TARFILE = "iDB.tar";
require_once("./untar.php");
$mydir = addslashes(str_replace("\\", "/", dirname(__FILE__)."/"));
$conn_id = ftp_connect($FTPURL, 21, 90);
$login_result = ftp_login($conn_id, $FTPUSER, $FTPPASS);
if ((!$conn_id) || (!$login_result)) {
    $tarhandle = fopen("./".$TARGZFILE, "a+");
    fwrite($tarhandle, file_get_contents($HTTPURL.$TARGZFILE));
    fclose($tarhandle);
    chmod("./".$TARGZFILE, 0777);
} else {
    ftp_pasv($conn_id, true);
    ftp_chdir($conn_id, $FTPPATH);
    ftp_get($conn_id, "./".$TARGZFILE, "./".$TARGZFILE, FTP_BINARY);
    ftp_close($conn_id);
}
gunzip("./".$TARGZFILE, "./".$TARFILE);
unlink("./".$TARGZFILE);
unlink("./LICENSE");
untar("./".$TARFILE, "./");
unlink("./".$TARFILE);
unlink("./untar.php");
unlink("./webinstall.php");
header("Location: ./install.php");
