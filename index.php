<?php         
session_start();
/////////////////////////////////////время выполнения скрипта////////////////////////////////////////
$start = microtime(true);
/////////////////////////////////////время выполнения скрипта////////////////////////////////////////

ini_set('display_errors', 1); // отображать все ошибки
echo "<a href='?page=index'>главная</a>"
. "<br><a href='?page=news&news=list_news'>список новостей</a><br>"
            . "<a href='?page=news&news=add'>добавление новостей</a><br>"
            . "<a href='?page=authorization'>Регистрация</a><br>"
        . "<a href='?page=profile'>профиль</a><br>";

include_once ($_SERVER['DOCUMENT_ROOT']."/controller/controller_core.php"); // подключили ядро

include ($_SERVER['DOCUMENT_ROOT'] . "/controller/controller_page.php");

$page = new page;
/////////////////////////////////////время выполнения скрипта////////////////////////////////////////
$time = microtime(true) - $start;
printf('<div style="color: red;" >Скрипт выполнялся за  %.7F сек.', $time,'</div>');
/////////////////////////////////////время выполнения скрипта/////////////////////////////////////////