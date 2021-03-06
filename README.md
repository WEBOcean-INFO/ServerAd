ServerAd
============
Реклама на игрови сървъри (CS, CSCZ, CSS, CSGO, HL, HL2)

![Version](https://img.shields.io/badge/Version-1.0.0А-red?style=flat-square)
![phpBB 3.2.X](https://img.shields.io/badge/phpBB%20Compatible-3.2.X-blue?style=flat-square)
![phpBB 3.3.X](https://img.shields.io/badge/phpBB%20Compatible-3.3.X-green?style=flat-square)

### Описание:
Много функционална система работеща със собствени query-та, имаща за цел да играе ролята на рекламен сайт за най-известните сървъри: CS, CSCZ, CSS, CSGO, HL, HL2.
Ползваща собсветни query-та, независещи от уеб сървъри и трети страни, системата работи с cronjobs (2 на брой), отговарящи за всичките игри по-горе.

### Снимки на системата
![Лист със сървъри](https://i.imgur.com/1Uq1Si2.png)
![Добавяне на сървър/и](https://i.imgur.com/isWH9XG.png)
![Преглед на сървър](https://i.imgur.com/eEtSipG.png)
![Управляване на сървъри](https://i.imgur.com/uFv2xKU.png)

### Функции на системата
- Детайлна информация
- Настройки на добавени сървъри (може в реално време да променяте IP адреса и порта на сървъра, също може и да го изтриете)
- Банер статистика
- VIP сървъри, показващи се най-отгоре
- Интегрирана с phpBB
- При добавянето на сървъри има функция за проверка дали даден сървър е онлайн или вече го има в датабазата.
- Системата има и функция за VIP сървъри срещу SMS (Mobio).

### Изисквания
- Качествен хостинг (най-добре да не е споделен)
- Cronjobs поддръжка
- PHP 7.0
- Sockets поддръжка (PHP)

### Инсталация
- Инсертвате таблицата от sql.sql
- Настройвате database.php (Намира се в includes папката)
- Зареждате cron файловете в Cpanel (2 на брой) от cron папката, така:
- cs.php <> през 1-5 минути
- vip_watcher <> през 60 минути
