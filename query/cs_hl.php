<?php
error_reporting(0);
//CS:S/1.6/CS:GO/HL/HL2/CS:CZ Queries
$ServerinfoCommand = "\xFF\xFF\xFF\xFFTSource Engine Query\x00";
$fp = @fsockopen("udp://" . $ServerIP2, $errno, $errstr);
@fwrite($fp, $ServerinfoCommand);
@stream_set_timeout($fp, 8);
@stream_set_blocking($fp, TRUE);
$JunkHead3 = @fread($fp, 4096);
$packet_array = explode("\x00", substr($JunkHead3, 6), 5);
$server['name'] = $packet_array[0];
$server['map'] = $packet_array[1];
$packet = $packet_array[4];
$server['players'] = ord(substr($packet, 2, 1));
$server['playersmax'] = ord(substr($packet, 3, 1));
$server['server_os'] = substr($packet, 6, 1);
$server['gamedir'] = $packet_array[2];

if ($packet_array[2] == "cstrike" || strpos($JunkHead3, "1.1.2.7") !== false || strpos($JunkHead3, "1.1.2.6") !== false) {
    $server['gamedir'] = "cs16";
}
if ($packet_array[2] == "ricochet") {
    $server['gamedir'] = "valve";
}
if ($packet_array[2] == "jbep3_dev") {
    $server['gamedir'] = "hl2dm";
}
if ($packet_array[2] == "nmrih") {
    $server['gamedir'] = "hl2dm";
}
if ($packet_array[2] == "ageofchivalry") {
    $server['gamedir'] = "hl2dm";
}
if ($packet_array[2] == "chivalrymedievalwarfare") {
    $server['gamedir'] = "hl2dm";
}
if ($packet_array[2] == "hl2mp") {
    $server['gamedir'] = "hl2dm";
}
if ($packet_array[2] == "pvkii") {
    $server['gamedir'] = "hl2dm";
}

if (preg_match("/27.0.0.1/i", $server['name'])) {
    $server['name'] = $packet_array[1];
    $server['map'] = $packet_array[2];
    $tmp = explode("\x00", $JunkHead3);
    $place = strlen($tmp[0] . $tmp[1] . $tmp[2] . $tmp[3] . $tmp[4]) + 5;
    $server['players'] = ord($JunkHead3[$place]);
    $server['playersmax'] = ord($JunkHead3[$place + 1]);
    $server['server_os'] = $JunkHead3[$place + 4];
    $server['gamedir'] = $tmp[3];
    if ($tmp[3] == "cstrike" || strpos($JunkHead3, "1.1.2.7") !== false || strpos($JunkHead3, "1.1.2.6") !== false) {
        $server['gamedir'] = "cs16";
    }
}
