<?php
header("Content-type: image/png");
$ServerIP2 = $_GET['ip'];
@$game = $_GET['game'];

$ico = imagecreatefrompng('images/Cstrike.png');
$im = imagecreatefrompng("images/small.png");

$black = ImageColorAllocate($im, 0, 0, 0);
$red = ImageColorAllocate($im, 248, 248, 255);
$orange = ImageColorAllocate($im, 176, 137, 10);

include ("../query/cs_hl.php");
$names = $server['name'];
$karta = $server['map'];
$players = $server['players'];
$maxplayers = $server['playersmax'];
$os = $server['server_os'];
if ($os == "l") {
    $os = imagecreatefrompng('images/Linux.png');
} else if ($os == "w") {
    $os = imagecreatefrompng('images/Windows.png');
} else {
    $os = "";
}

if (!$names) {
    $stats2 = imagecreatefromgif('images/offline.gif');
    $white = ImageColorAllocate($im, 255, 255, 255);
    imagestring($im, 4, 100, 14, "Server: $ServerIP2 is offline!", $white);
    imagecopy($im, $stats2, 80, 12, 0, 0, 16, 16);
} else {
    $stats1 = imagecreatefromgif('images/online.gif');
    $blue = ImageColorAllocate($im, 0, 245, 255);
    $green = ImageColorAllocate($im, 0, 255, 0);
    imagestring($im, 3, 30, 15, "" . truncate_string($names, 33, '..') . "", $red);
    imagestring($im, 3, 30, 35, "$ServerIP2", $red);
    imagestring($im, 3, 300, 15, "" . $players . "/" . $maxplayers . "", $green);
    imagestring($im, 4, 300, 34, "" . truncate_string($karta, 12, '..') . "", $red);
    imagecopy($im, $stats1, 5, 32, 0, 0, 16, 16);
    imagecopy($im, $ico, 5, 15, 0, 0, 16, 16);
    imagecopy($im, $os, 417, 20, 0, 0, 16, 16);
}
@fclose($fp);
// TEXT TRUNCATE
function truncate_string($string, $max_chars, $end_chars) {
    $text_len = strlen($string);
    $temp_text = '';
    if ($text_len > $max_chars) {
        for ($i = 0;$i < $max_chars;$i++) {
            $temp_text.= $string[$i];
        }
        $temp_text.= $end_chars;
        return $temp_text;
    } else {
        return $string;
    }
}
//end truncate
@imagepng($im, null, 9);
@imagedestroy($im);
exit;
?>
