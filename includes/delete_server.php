<?php
include ("database.php");
ob_start();
$forum_path = "../" . $forum_path;
include ("phpbb.php");
$id = (int)$_GET['id'];
if ($bb_is_admin) {
    mysqli_query($conn, "DELETE FROM servers WHERE id='$id'");
}
echo json_encode(array('info' => "Успешно изтрит сървър!"));
?>