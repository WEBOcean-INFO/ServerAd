<?php
include ("../includes/database.php");
$sql = mysqli_query($conn, "SELECT * FROM `servers` WHERE game !='mc' AND game != 'samp'");
$types = array();
while ($row = mysqli_fetch_assoc($sql)) {
    @$types[] = $row['id'];
}
foreach ($types as $k => $v) {
    $sql2 = mysqli_query($conn, "SELECT * FROM `servers` WHERE id='$v'");
    while ($row2 = mysqli_fetch_assoc($sql2)) {
        $ip = $row2['ip'];
        $port = $row2['port'];
        $ServerIP2 = "$ip:$port";
        include ("../query/cs_hl.php");
        $names = $server['name'];
        $karta = $server['map'];
        $players = $server['players'];
        $maxplayers = $server['playersmax'];
        if (!$names) {
            mysqli_query($conn, "UPDATE servers SET players='0', maxplayers='0', map='OFFLINE' WHERE id='$v'");
        } else {
            mysqli_query($conn, "UPDATE servers SET name = '$names', map = '$karta', players = '$players', maxplayers = '$maxplayers' WHERE id='$v'");
        }
        @fclose($socket);
    }
}
?>