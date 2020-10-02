<?php
require_once __DIR__ . '/includes/database.php';
ob_start();
require_once __DIR__ . '/includes/phpbb.php';
require_once __DIR__ . '/includes/funcs.php';
$pageTitle = "SMS V.I.P сървър";
require_once __DIR__ . '/includes/views/overall_header.php';
$id = (int)$_GET['id'];
$servID4 = $servid_mobio;
$get = mysqli_query($conn, "SELECT vip,id FROM servers WHERE id='$id' AND vip=1");
if (mysqli_num_rows($get) > 0) {
    echo "<div class='alert alert-warning'>Избрания сървър е V.I.P!</div>";
} else {
    echo '
    <div class="card">
    <h5 class="card-header bg-dark text-white">SMS V.I.P</h5>
    <div class="card-body">
<div class="alert alert-primary text-center">' . $SMSVip . '</div>
<form action="" method="post">
<div class="form-group">
<input type="text" name="smscode" placeholder="SMS код" class="form-control"/>
</div>
<div class="form-group">
<input type="submit" name="submit" class="btn btn-block btn-info" value="Изпрати"/>
</div>
</form><br/>';
    if (isset($_POST['submit'])) {
        $code = $_REQUEST["smscode"];
        if (mobio_checkcode2($servID4, $code, 0) == 1) {
            $start = time();
            $expire = $start + $vip_expire;
            mysqli_query($conn, "UPDATE servers SET vip='1',startvip='$start',expirevip='$expire' WHERE id='$id'");
            echo "<div class='alert alert-success'>Успешно направихте вашият сървър със статус VIP!</div>";
        } else {
            echo "<div class='alert alert-danger'>SMS кода е грешен, моля свържете се с администратора</div>";
        }
    }
    echo '</div></div>';
}
require_once __DIR__ . '/includes/views/overall_footer.php';
