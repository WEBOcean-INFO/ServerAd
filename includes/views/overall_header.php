<!doctype html>
<html lang="bg">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $siteTitle; ?> &bull; <?php echo $pageTitle; ?></title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">      
      <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
if (strpos($_SERVER['SCRIPT_NAME'],'cp.php') !== false) { ?>
      <script src="assets/js/jquery.editinplace.packed.js"></script>
      <script src="assets/js/edit.js"></script>
<?php
 }
?>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-chart-bar"></i> <?php echo $siteTitle; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Начало</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?php echo $forum_path; ?>"><i class="fas fa-pencil-alt"></i> Форум</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?php echo $forum_path; ?>memberlist.php?mode=contactadmin"><i class="fas fa-comments"></i> Контакти</a></li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="fas fa-server"></i> Игри
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="index.php?game=cs16" class="dropdown-item"><img src="assets/img/cs16.png"/> CS 1.6</a>
                        <a href="index.php?game=csgo" class="dropdown-item"><img src="assets/img/csgo.png"/> CS:GO</a>
                        <a href="index.php?game=hl2dm" class="dropdown-item"><img src="assets/img/hl2.png"/> HL2</a>
                        <a href="index.php?game=valve" class="dropdown-item"><img src="assets/img/hl.png"/> HL</a>
                        <a href="index.php?game=czero" class="dropdown-item"><img src="assets/img/czero.png"/> CZERO</a>
                        <a href="index.php?game=cstrike" class="dropdown-item"><img src="assets/img/css.png"/> CS:S</a>
                     </div>
                  </li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
               <?php
               if($bb_is_anonymous) {
                  echo '<li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-id-badge"></i> Профил
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a href="'.$forum_path.'ucp.php?mode=login" class="dropdown-item"><i class="fas fa-sign-in-alt"></i> Вход</a>
                     <a href="'.$forum_path.'ucp.php?mode=register" class="dropdown-item"><i class="fas fa-user-plus"></i> Регистрация</a>
                  </div>
               </li>';
               } else {
                  echo '<li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-id-badge"></i> Профил
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a href="#" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Мнения: <b>'.$bb_user_posts.'</b></a>
                     <a href="'.$forum_path.'/ucp.php" class="dropdown-item"><i class="fas fa-user-cog"></i> Настройки</a>
                     <div class="dropdown-divider"></div>
                     <a href="add_server.php" class="dropdown-item"><i class="fas fa-plus"></i> Добави сървър</a>
                     <a href="cp.php" class="dropdown-item"><i class="fas fa-cogs"></i> Контролен панел</a>
                  </div>
               </li>';
               }
               ?>
               </ul>
            </div>
         </div>
      </nav>
      <div class="container">
      <br /><br />