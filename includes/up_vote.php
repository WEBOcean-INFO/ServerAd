<?php
error_reporting(0);
include ("database.php");
$ip = $_SERVER['REMOTE_ADDR'];
if ($_POST['id']) {
    $id = $_POST['id'];
    $id = str_replace('sup', '', $id);
    $id = mysqli_real_escape_string($conn, $id);
    //Verify IP address in Voting_IP table
    $ip_sql = mysqli_query($conn, "select ip_add from voting_ip where mes_id_fk='$id' and ip_add='$ip'");
    $count = mysqli_num_rows($ip_sql);
    mysqli_free_result($ip_sql);
    if ($count == 0) {
        // Update Vote.
        $sql = "update servers set rate=rate+1 where id='$id'";
        mysqli_query($conn, $sql);
        // Insert IP address and Message Id in Voting_IP table.
        $sql_in = "insert into voting_ip (mes_id_fk,ip_add) values ('$id','$ip')";
        mysqli_query($conn, $sql_in);
        echo "<script>alert('Благодаря, че гласува!');</script>";
    } else {
        echo "<script>alert('Ти вече си гласувал за този сървър!');</script>";
    }
    $result = mysqli_query($conn, "select rate from servers where id='$id'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $up_value = $row['up'];
    echo $up_value;
    mysqli_free_result($result);
}
?>
