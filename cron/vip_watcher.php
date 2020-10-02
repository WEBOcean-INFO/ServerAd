<?php
include ("../includes/database.php");
$sql = mysqli_query($conn, "SELECT * FROM `servers` WHERE vip=1 AND expirevip<UNIX_TIMESTAMP()");
$types = array();
while ($row = mysqli_fetch_assoc($sql)) {
    @$types[] = $row['id'];
}
foreach ($types as $k => $v) {
    $sql2 = mysqli_query($conn, "SELECT * FROM `servers` WHERE id='$v'");
    while ($row2 = mysqli_fetch_assoc($sql2)) {
        mysqli_query($conn, "UPDATE servers SET expirevip='0', startvip='0', vip='0' WHERE id='$v'");
    }
}
?>