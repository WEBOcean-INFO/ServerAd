<?php
error_reporting(0);
include ("database.php");
ob_start();
$forum_path = "../" . $forum_path;
include ("phpbb.php");
$idz = (int)$_GET['id'];
$uid = (int)$_GET['uid'];
$uid2 = $bb_user_id;
if ($uid == $uid2) {
    mysqli_query($conn, "DELETE FROM servers WHERE id='$idz'");
    echo json_encode(array('info2' => "Успешно изтрит сървър!", 'idz' => "$idz"));
} else {
    echo json_encode(array('info2' => "DIE!"));
}
?>