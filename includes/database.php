<?php
// Свързване с базата данни
$mysql_hostname = "localhost"; // Хост
$mysql_user = "testing"; // Потребител
$mysql_password = "testing"; // Парола
$mysql_database = "testing"; // Базаданни
$conn = mysqli_connect($mysql_hostname,$mysql_user,$mysql_password,$mysql_database) or die("Error " . mysqli_error($conn));
mysqli_set_charset($conn, "UTF8"); // За всеки случай

// Настройки
$siteTitle = "ServerAd"; // Име на сайта
$forum_path = "forums/"; // В коя папка се намира phpBB

$SMSVip = "За да направите този сървър VIP, изпратете SMS с текст smsvip на номер 1092 (2,40 лв. с ддс). Услугата важи 7 дни, след това трябва да подновите сървъра си.";
$servid_mobio = 24796; // Servid za Mobio
$vip_expire = "604800"; // Колко дни да е активен VIP-a ? По-начало 7 дни
