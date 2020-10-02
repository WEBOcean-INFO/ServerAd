<?php
include("database.php");

$update_value = $_POST['update_value'];
$element_id = $_POST['element_id'];
$original = $_POST['original_html'];

$element = explode("-", $element_id);

$col = $element['1'];
$row_id = $element['2'];

mysqli_query($conn,"UPDATE `servers` SET $col='$update_value' WHERE id='$row_id'");

echo $update_value; 
