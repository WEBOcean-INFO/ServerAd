<?php
require_once __DIR__ . '/includes/database.php';
ob_start();
require_once __DIR__ . '/includes/phpbb.php';
require_once __DIR__. '/includes/pagination_vip.php';
require_once __DIR__ . '/includes/funcs.php';
$pageTitle = "Всички V.I.P сървъри";
require_once __DIR__ . '/includes/views/overall_header.php';
$mysql_all = mysqli_query($conn, "SELECT vip FROM servers WHERE vip=1");
if (mysqli_num_rows($mysql_all) > 0) {
    echo '   <table class="table table-striped table-bordered table-hover text-center">
    <thead class="thead-dark">
    <th>Игра</th>
    <th>Име</th>
    <th>IP Адрес</th>
    <th>Карта</th>
    <th>Играчи</th>
    <th>OS</th>
    <th>Инфо</th>
    </thead>';
    $gameget = trim(htmlspecialchars(mysqli_real_escape_string($conn, $_GET['game'])));
    $results = mysqli_result(mysqli_query($conn, "SELECT COUNT(`id`) FROM `servers` WHERE vip=1"), 0); // общия брой резултати
    $pagination = pagination($results, array('get_vars' => array('cat' => (int)@$_GET['cat'], // $_GET променливите, които да се запазват при сменянето на страницата
    'view' => @$_GET['view']), 'per_page' => 20, // по колко резултата да се показват на страница
    'per_side' => 3, // по колко страници да се показват от всяка страна на страницирането
    'get_name' => 'page' // името на $_GET променливата, от която ще бъде вземана страницата
    ));
    $mysql_sel = mysqli_query($conn, "SELECT * FROM servers WHERE vip=1 order by vip DESC, ABS(rate) DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
    while ($row = mysqli_fetch_assoc($mysql_sel)) {
        $srvid = $row['id'];
        $ip = $row['ip'];
        $port = $row['port'];
        $game = $row['game'];
        if ($game == "csgo") {
            $game = "<img src='assets/img/csgo.png'/>";
        }
        if ($game == "valve") {
            $game = "<img src='assets/img/hl.png'/>";
        }
        if ($game == "cstrike") {
            $game = "<img src='assets/img/css.png'/>";
        }
        if ($game == "cs16") {
            $game = "<img src='assets/img/cs16.png'/>";
        }
        if ($game == "hl2dm") {
            $game = "<img src='assets/img/hl2.png'/>";
        }
        if ($game == "czero") {
            $game = "<img src='assets/img/czero.png'/>";
        }
        $name = truncate_chars($row['name'],10,'...');
        $os = $row['os'];
        if($os == 'l') {
            $os = '<i class="fab fa-linux"></i>';
            }
            if($os == 'w') {
            $os = '<i class="fab fa-windows"></i>';
            }
            if($os == 'unknown') {
            $os = '<i class="fas fa-question"></i>';
            }
        $players = $row['players'];
        $maxplayers = $row['maxplayers'];
        $map = $row['map'];
        if ($map == "OFFLINE") {
            $offline = "<img src='img/offline.png' style='vertical-align:middle'/>";
        } else {
            $offline = "";
        }
        $vip = $row['vip'];
        echo "
<tr>
<td>$game</td>
<td>$name</td>
<td><a href='' onclick='prompt(\"IP адреса на сървъра е:\",\"$ip:$port\"); return false;'>$ip:$port</a></td>
<td>$map $offline</td>
<td>$players/$maxplayers</td>
<td>$os</td>
<td><a href='details.php?id=$srvid' class='btn btn-sm btn-info'>Детайли</a></td>
</tr>

";
    }
    mysqli_free_result($mysql_sel);
    echo '</table><br />';
    echo $pagination['output']; // изкарва страниците
    echo "<br /> ";
} else {
    echo "<div class='alert alert-danger'>Все още няма VIP сървъри!</div>";
}
require_once __DIR__ . '/includes/views/overall_footer.php';
