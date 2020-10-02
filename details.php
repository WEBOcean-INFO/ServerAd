<?php
require_once __DIR__ . '/includes/database.php';
ob_start();
require_once __DIR__ . '/includes/phpbb.php';
require_once __DIR__. '/includes/funcs.php';
$pageTitle = "Преглед на сървър";
require_once __DIR__ . '/includes/views/overall_header.php';
echo '<div class="card text-center">
<h5 class="card-header bg-dark text-white">'.$pageTitle.'</h5>
<div class="card-body">';
$id = (int)$_GET['id'];
$mysql_sel = mysqli_query($conn, "SELECT name,id FROM servers WHERE id='$id'");
$row = mysqli_fetch_assoc($mysql_sel);
$title2 = $row['name'];
if (mysqli_num_rows($mysql_sel) < 1) {
    die();
}
mysqli_free_result($mysql_sel);
$id = (int)$_GET['id'];
$mysql_sel = mysqli_query($conn,"SELECT * FROM servers WHERE id='$id'");
$row = mysqli_fetch_assoc($mysql_sel);
$name = $row['name'];
$ip = $row['ip'];
$port = $row['port'];
$karta = $row['map'];
if($karta == "OFFLINE") {
$offline = "<img src='assets/img/offline.png' style='vertical-align:middle'/>";
} else {
$offline = "";
}
$game = $row['game'];
if($game == "csgo") {
$game = "<img src='assets/img/csgo.png' style='vertical-align:middle'/>";
}
if($game == "valve") {
$game = "<img src='assets/img/hl.png' style='vertical-align:middle'/>";
}
if($game == "cstrike") {
$game = "<img src='assets/img/css.png' style='vertical-align:middle'/>";
}
if($game == "cs16") {
$game = "<img src='assets/img/cs16.png' style='vertical-align:middle'/>";
}
if($game == "hl2dm") {
$game = "<img src='assets/img/hl2.png' style='vertical-align:middle'/>";
}
if($game == "czero") {
$game = "<img src='assets/img/czero.png' style='vertical-align:middle'/>";
}
$vip = $row['vip'];
if($vip == 1) {
$crown = '<span class="badge badge-pill badge-primary"><i class="fas fa-crown"></i></span>';
$makevip    =   "<a href='vip.php?id=$id'>Направи този сървър V.I.P<a>";
} else {
$crown = "";
$makevip    =   '';
}
$ip_data = @json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
$cn =  $ip_data->country;
$site = $row['site'];
$players = $row['players'];
$maxplayers = $row['maxplayers']; 
$dobavenot = $row['dobavenot'];
$percent = percent($players, $maxplayers);

mysqli_free_result($mysql_sel);


$mysql_query= mysqli_query($conn,"SELECT username,user_id FROM  phpbb_users WHERE user_id='$dobavenot'");
$row = mysqli_fetch_assoc($mysql_query);
$username = $row['username'];
mysqli_free_result($mysql_query);
//end results 2

echo "
$crown $offline <b>$name</b><br /><br />

<ul class='list-group list-group-flush' style='margin: 0 auto;width: 600px;'>
    <li class='list-group-item d-flex justify-content-between align-items-center'>
    Игра: <span class='badge badge-light badge-pill'>$game</span>
    </li>
  <li class='list-group-item d-flex justify-content-between align-items-center'>
  IP адрес: <span class='badge badge-primary badge-pill'>$ip:$port</span>
  </li>
  <li class='list-group-item d-flex justify-content-between align-items-center'>
  Играчи: <span class='badge badge-info badge-pill'>$players от $maxplayers</span>
  </li>
  <li class='list-group-item d-flex justify-content-between align-items-center'>
  Карта: <span class='badge badge-primary badge-pill'>$karta</span>
  </li>
  <li class='list-group-item d-flex justify-content-between align-items-center'>
  Държава: <span class='badge badge-primary badge-pill'>$cn</span>
  </li>
  <li class='list-group-item d-flex justify-content-between align-items-center'>
  Уеб сайт: <a href='$site' rel='nofollow'><span class='badge badge-primary badge-pill'>$site</span></a>
  </li>
  <li class='list-group-item d-flex justify-content-between align-items-center'>
  Добавен от: <a href='$forum_path/memberlist.php?mode=viewprofile&u=$dobavenot'><span class='badge badge-primary badge-pill'>$username</span></a>
  </li>
</ul><hr />";

$url= $_SERVER['SERVER_NAME'];
$id = (int)$_GET['id'];
$sel = mysqli_query($conn,"SELECT * FROM servers WHERE id=$id");
$row = mysqli_fetch_assoc($sel);
$ip = $row['ip'];
$port = $row['port'];
$game= $row['game'];

echo '<div class="progress" style="height: 20px;">
<div class="progress-bar" role="progressbar" style="width: '.$percent.';" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100">'.$percent.'</div>
</div><br />';
echo "<img src='status/status.php?ip=$ip:$port&game=$game'/><br/>
";
mysqli_free_result($sel);
?>

BBCode код:
<textarea class="form-control onclick="hl_text(this)" readonly="readonly" rows="2" cols="65">
[url=http://<?php echo $url; ?>/details.php?id=<?php echo $id;?>][img]http://<?php echo $url; ?>/status/status.php?ip=<?php echo $ip;?>:<?php echo $port;?>&game=<?php echo $game;?>[/img][/url]
</textarea> 

<br/><br/>
HTML код:

<textarea class="form-control onclick="hl_text(this)" readonly="readonly" rows="2" cols="65">
<a href="http://<?php echo $url; ?>/details.php?id=<?php echo $id;?>" target="_blank"><img src="http://<?php echo $url; ?>/status/status.php?ip=<?php echo $ip;?>:<?php echo $port;?>&game=<?php echo $game;?>" /></a>
</textarea> 
<hr />
<?php
//siteurl
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
$host     = $_SERVER['HTTP_HOST'];
$script   = $_SERVER['SCRIPT_NAME'];
$params   = $_SERVER['QUERY_STRING'];
 
$currentUrl = $protocol . '://' . $host . $script . '?' . $params;

if($bb_is_admin){
echo '<input type="submit" name="submit_del" class="delsrv btn btn-sm btn-danger" value="Изтрий този сървър"/>';
}
?>
</div></div>
<script>
$('.delsrv').click(function() {
 $.ajax({
        async: false,
        type: "GET",
        url: "includes/delete_server.php?id=<?php echo $id;?>",
        dataType: "json",
		
		success:    function(data) {
        alert(data['info']);
        }
		
        });
		
});
</script>

<?php
require_once __DIR__ . '/includes/views/overall_footer.php';
