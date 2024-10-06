<?php

$numob = count(ob_list_handlers());
$iob = 0;
while ($iob < $numob) {
    $old_ob_var[$iob] = ob_get_clean();
    ++$iob;
} @ob_start();
if (!isset($_SERVER["HTTP_USER_AGENT"])) {
    $_SERVER["HTTP_USER_AGENT"] = null;
}
header("Content-Type: text/plain; charset=UTF-8");
header("Content-Language: en");

$CompressPage = "none";
if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], "gzip")) {
    $CompressPage = "gzip";
} elseif (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], "deflate")) {
    $CompressPage = "deflate";
} else {
    $CompressPage = "none";
}

if ($CompressPage == "gzip") {
    header("Content-Encoding: gzip");
}
if ($CompressPage == "deflate") {
    header("Content-Encoding: deflate");
}

function ip2bin($ip)
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false) {
        return base_convert(ip2long($ip), 10, 2);
    }
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
        return false;
    }
    if (($ip_n = inet_pton($ip)) === false) {
        return false;
    }
    $bits = 15; // 16 x 8 bit = 128bit (ipv6)
    while ($bits >= 0) {
        $bin = sprintf("%08b", (ord($ip_n[$bits])));
        $ipbin = $bin.$ipbin;
        $bits--;
    }
    return $ipbin;
}

function bin2ip($bin)
{
    if (strlen($bin) <= 32) { // 32bits (ipv4)
        return long2ip(base_convert($bin, 2, 10));
    }
    if (strlen($bin) != 128) {
        return false;
    }
    $pad = 128 - strlen($bin);
    for ($i = 1; $i <= $pad; $i++) {
        $bin = "0".$bin;
    }
    $bits = 0;
    while ($bits <= 7) {
        $bin_part = substr($bin, ($bits * 16), 16);
        $ipv6 .= dechex(bindec($bin_part)).":";
        $bits++;
    }
    return inet_ntop(inet_pton(substr($ipv6, 0, -1)));
}

echo "-- Hosts information --\n\n";
echo "IP: ".$_GET['query']."\n";
echo "Host: ".gethostbyaddr($_GET['query'])."\n";
echo "Long: ".sprintf("%u", ip2long($_GET['query']))."\n";
echo "Long Alt: ".sprintf("%u", ip2long(long2ip(ip2long($_GET['query']))))."\n";
echo "IP Bin: ".ip2bin($_GET['query'])."\n";

if ($CompressPage == "none") {
    echo ob_get_clean();
}
if ($CompressPage == "gzip") {
    echo gzencode(ob_get_clean());
}
if ($CompressPage == "deflate") {
    echo gzcompress(ob_get_clean());
}
