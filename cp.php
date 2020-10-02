<?php
require_once __DIR__ . '/includes/database.php';
ob_start();
require_once __DIR__ . '/includes/phpbb.php';
require_once __DIR__ . '/includes/funcs.php';
$pageTitle = "Управление на сървъри";
require_once __DIR__ . '/includes/views/overall_header.php';
echo '<div class="card">
<h5 class="card-header bg-dark text-white">'.$pageTitle.'</h5>
<div class="card-body">';
if ($bb_is_anonymous) {
    echo "<div class='alert alert-danger'>Трябва да влезнеш в акаунта си за да виждаш тази страница!</div>";
} else {
    $uid = $bb_user_id;
    $getmain = mysqli_query($conn, "SELECT * FROM servers WHERE dobavenot='$uid'");
    if (mysqli_num_rows($getmain) > 0) {
        echo '<div class="alert alert-primary" role="alert">От тази страница може да редактиране IP адреса или порта на вашите сървъри, също така може да ги изтриете</div>
        <hr /><table class="table table-striped table-bordered table-hover text-center">
        <thead class="thead-dark">
                <th>Име</th>
                <th>IP Адрес</th>
                <th>Изтрий</th>
                </thead>';
        while ($row = mysqli_fetch_assoc($getmain)) {
            $ip = $row['ip'];
            $id = $row['id'];
            $name = $row['name'];
            $port = $row['port'];
            echo '
            <tr class="srvd' . $id . '">
            <td><a href="details.php?id=' . $id . '">' . $name . '</a></td>
            <td><span class="editme1" id="ip-ip-' . $id . '">' . $ip . '</span>:<span class="editme2" id="port-port-' . $id . '">' . $port . '</span></td>
            <td><a href="includes/delete_srvusr.php?id=' . $id . '&uid=' . $uid . '" class="del_srv"><span class="badge badge-pill badge-danger"><i class="fas fa-trash"></i></span></a></td>
            </tr>';
        }
        echo '</table>';
    } else {
        echo "<div class='alert alert-info'>Вие все още нямате добавени сървъри към нашата система, може да добавите сървър <a href='add_server.php'>оттук</a>.</div>";
    }
    mysqli_free_result($getmain);
}
echo '</div</div></div></div>';
?>
<script>
$(document).ready(function() {
    $('.del_srv').click(function() {
        $.ajax({
            url: $(this).attr('href'),
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                alert(data['info2']);
                $('.srvd' + data['idz']).remove();
            }
        });
        return false;
    })
})
</script>
<?php
require_once __DIR__ . '/includes/views/overall_footer.php';
