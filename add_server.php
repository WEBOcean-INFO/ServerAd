<?php
require_once __DIR__ . '/includes/database.php';
ob_start();
require_once __DIR__ . '/includes/phpbb.php';
$pageTitle = "Добавяне на сървър";
require_once __DIR__ . '/includes/views/overall_header.php';
if (!$bb_is_anonymous) {
    echo '
    <div class="card">
    <div class="card-header bg-dark text-white">
       ' . $pageTitle . '
    </div>
    <div class="card-body">
    <div class="alert alert-warning text-center">От тук вие можете да добавяте сървъри в нашата система.<br/>
       Сайта не поддържа домейн имена, така, че моля - не въвеждайте домейни, а само IP адреси!
    </div>
    <form action="" method="post">
       <div class="form-group">
          Избери тип: 
          <select name="servertype" class="form-control">
             <option value="cs16">CS 1.6</option>
             <option value="csgo">CS:GO</option>
             <option value="cstrike">CS:S</option>
             <option value="czero">CS:CZ</option>
             <option value="valve">HL1</option>
             <option value="hl2dm">HL2</option>
             <option value="mc">Minecraft</option>
             <option value="samp">SAMP</option>
          </select>
       </div>
       <div class="form-group">
          IP адрес:
          <input type="text" name="server"  placeholder="127.0.0.1" class="form-control" required/>
       </div>
       <div class="form-group">
          Port:
          <input type="text" name="port" placeholder="27015" class="form-control" required/>
       </div>
       <div class="form-group">
          Уеб сайт на сървъра:
          <input type="text" name="serversite" placeholder="Не е задължителен!" class="form-control" />
       </div>
       <div class="form-group">
          <input type="submit" name="submit" class="btn btn-md btn-success" value="Изпрати" />
       </div>
    </form>
    <br />
   ';
    if (isset($_POST['submit'])) {
        error_reporting(0);
        $select = $_POST['servertype'];
        $ip = trim(htmlspecialchars(mysqli_real_escape_string($conn, $_POST['server'])));
        $port = trim(htmlspecialchars(mysqli_real_escape_string($conn, $_POST['port'])));
        $site = trim(htmlspecialchars(mysqli_real_escape_string($conn, $_POST['serversite'])));
        if (empty($site)) {
            $site = "Няма добавен";
        }
        $ServerIP2 = "$ip:$port";
        include ("query/cs_hl.php");
        $names = $server['name'];
        $karta = $server['map'];
        $players = $server['players'];
        $maxplayers = $server['playersmax'];
        $os = $server['server_os'];
        $game = $_POST['servertype'];
        if (!empty($names)) {
            $get = mysqli_query($conn, "SELECT * FROM servers WHERE ip='$ip' AND port='$port'");
            if (mysqli_num_rows($get) > 0) {
                echo "<div class='alert alert-warning'>Вече има такъв сървър в нашата база данни!</div>";
            } else {
                mysqli_query($conn, "INSERT INTO servers (ip,port,players,maxplayers,os,map,game,vip,rate,name,comments,dobavenot,site) VALUES('$ip', '$port', '$players','$maxplayers','$os','$karta','$game','0','0','$names','0','$bb_user_id', '$site')");
                echo "<div class='alert alert-success'>Успешно добавен сървър!</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Сървъра, който се опитвате да добавите в системата не е онлайн!</div>";
        }
    }
    echo '</div></div>';
} else {
    echo "<div class='alert alert-danger'>Трябва да си регистриран, за да можеш да добавяш сървъри!</div>";
}
require_once __DIR__ . '/includes/views/overall_footer.php';
