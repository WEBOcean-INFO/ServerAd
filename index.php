<?php
   require_once __DIR__.'/includes/database.php';
   ob_start();
   require_once __DIR__.'/includes/phpbb.php';
   require_once __DIR__.'/includes/pagination.php';
   require_once __DIR__.'/includes/funcs.php';
   $pageTitle  =   "Начало";
   require_once __DIR__.'/includes/views/overall_header.php';
   $getting = mysqli_query($conn, "SELECT * FROM servers");
   if(mysqli_num_rows($getting) > 0) {
   ?>
<div class="row">
   <div class="col-sm-12">
      <div class="row">
         <?php 
            $mysql_get_vip = mysqli_query($conn,"SELECT * FROM servers WHERE vip=1 ORDER BY RAND() LIMIT 4");
            while($row= mysqli_fetch_assoc($mysql_get_vip)) {
            $vip = $row['vip'];
            $map = $row['map'];
            if($map == "OFFLINE") {
            $offline = "<img src='assets/img/offline.png' style='vertical-align:middle'/>";
            } else {
            $offline = "";
            }
            if(!file_exists("assets/img/maps/$map.jpg")) {
            $map = "unknown";
            }
            $hostname=$row['name'];
            $id = $row['id'];
            $players = $row['players'];
            $maxplayers=  $row['maxplayers'];
            $newhostname = truncate_chars($hostname,20,'...');
            echo '
            <div class="col-md-3">
            <div class="card">
            <div class="card-body">
            <center>
            <a href="details.php?id='.$id.'">'.$newhostname.'</a><br/>
            <span class="badge badge-pill badge-primary" style="position:absolute; margin-left: 5px;margin-top: 5px;"><i class="fas fa-crown"></i></span>
            <img width="160" height="120" src="assets/img/maps/'.$map.'.jpg"/><br/>
            Играчи <span class="badge badge-pill badge-success">'. $players.'</span>/<span class="badge badge-pill badge-danger">'.$maxplayers.'</span></center>
            </div>
            </div>
            </div>
            ';
            }
            ?>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<?php 
   $mysql_all = mysqli_query($conn,"SELECT vip FROM servers WHERE vip = 1");
   if(mysqli_num_rows($mysql_all) > 0) {
   echo '<br /><p class="text-center"><a class="btn btn-large btn-success" href="all_vips.php">Виж всички VIP сървъри</a></p>';
   }
   mysqli_free_result($mysql_all);
   ?>
<div class="clearfix"></div>
<br/>
   <table class="table table-striped table-bordered table-hover text-center">
      <thead class="thead-dark">
         <th>Игра</th>
         <th>Име</th>
         <th>IP Адрес</th>
         <th>Играчи</th>
         <th>Карта</th>
         <th>OS</th>
         <th>Инфо</th>
      </thead>
      <?php
         $gameget= trim(htmlspecialchars(mysqli_real_escape_string($conn,$_GET['game'])));
         if(isset($_GET['game'])) {
         $results    =  mysqli_result(mysqli_query($conn,"SELECT COUNT(`id`) FROM `servers` WHERE game='$gameget'"),0); // общия брой резултати
         } else {
         $results    =  mysqli_result(mysqli_query($conn,"SELECT COUNT(`id`) FROM `servers`"),0); // общия брой резултати
         }
         $pagination = pagination($results, array(
         'get_vars'  => array(
         'cat'   => (int)@$_GET['cat'], // $_GET променливите, които да се запазват при сменянето на страницата
         'view'  => @$_GET['view']
         ), 
         'per_page'  => 20, // по колко резултата да се показват на страница
         'per_side'  => 3, // по колко страници да се показват от всяка страна на страницирането
         'get_name'  => 'page' // името на $_GET променливата, от която ще бъде вземана страницата
         ),$gameget);
         if(isset($_GET['game'])) {
         $mysql_sel = mysqli_query($conn,"SELECT * FROM servers WHERE game='$gameget' order by  vip DESC, ABS(rate) DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
         } else {
         $mysql_sel = mysqli_query($conn,"SELECT * FROM servers order by  vip DESC, ABS(rate) DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
         }
         while($row = mysqli_fetch_assoc($mysql_sel)) {
         $srvid = $row['id'];
         $ip = $row['ip'];
         $port = $row['port'];
         $game = $row['game'];
         if($game == "csgo") {
         $game = "<img src='assets/img/csgo.png'/>";
         }
         if($game == "valve") {
         $game = "<img src='assets/img/hl.png'/>";
         }
         if($game == "cstrike") {
         $game = "<img src='assets/img/css.png'/>";
         }
         if($game == "cs16") {
         $game = "<img src='assets/img/cs16.png'/>";
         }
         if($game == "hl2dm") {
         $game = "<img src='assets/img/hl2.png'/>";
         }
         if($game == "czero") {
         $game = "<img src='assets/img/czero.png'/>";
         }
         $name = truncate_chars($row['name'],50,'...');
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
         if($map == "OFFLINE") {
         $offline = "<img src='assets/img/offline.png' style='vertical-align:middle' />";
         } else {
         $offline = "";
         }
         $vip = $row['vip'];
         if($vip == "1") {
         $bgr = "class='table-primary'";
         $icon =  "<span class='badge badge-pill badge-primary'><i class='fas fa-crown'></i></span>";
         } else {
         $bgr= "";
         $icon =  "";
         }

   
       echo "
       <tr>
          <td $bgr>$game</td>
          <td $bgr>$icon $name</td>
          <td $bgr><a href='' onclick='prompt(\"IP адреса на сървъра е:\",\"$ip:$port\"); return false;'>$ip:$port</a></td>
          <td $bgr>$players/$maxplayers</td>
          <td $bgr>$map $offline</td>
          <td $bgr>$os</td>
          <td $bgr><a href='details.php?id=$srvid' class='btn btn-sm btn-info'>Детайли</a></td>
       </tr>
       ";
       }
       mysqli_free_result($mysql_sel);
       echo '</table>';
 echo $pagination['output'];  
 } else {
 echo "
 <div class='alert alert-danger'><i class='fas fa-info-circle'></i> Все още няма добавени сървъри към системата ни!</div>
 ";
 }
 require_once __DIR__.'/includes/views/overall_footer.php';