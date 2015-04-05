<!DOCTYPE html>
<!--
Здесь находится html код формы регистрации которую пользователь должен заполнить
если был не зарегистрирован.
-->
﻿<?php  // GET переменные формы : familiya,tel,imya,mail,otchestvo,data_rosd
print(
'
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Регистрация</title>
</head>
<body>
<div id="form_div">
  <div id="div_form_title">Регистрация</div>
  <form method="POST" action="?page=authorization">
    <div id="div_line_conteiner">
      <div id="div_line_pole_left">
        <div id="text_div">Фамилия:</div>
        <br/>
        <input class="div" type="text" name="familiya">
      </div>
      <div id="div_line_pole_right">
        <div id="text_div">Телефон:</div>
        <br/>
        <input class="div" type="tel" name="tel" />
      </div>
    </div>
    <div id="div_line_conteiner">
      <div id="div_line_pole_left">
        <div id="text_div">Имя:</div>
        <br/>
        <input class="div" type="text" name="imya">
      </div>
      <div id="div_line_pole_right">
        <div id="text_div">почта:</div>
        <br/>
        <input class="div" type="email" name="mail"/>
      </div>
    </div>
    <div id="div_line_conteiner">
      <div id="div_line_pole_left">
        <div id="text_div">Отчество:</div>
        <br/>
        <input class="div" type="text" name="otchestvo">
      </div>
      <div id="div_line_pole_right">
        <div id="text_div">Дата  рождения:</div>
        <br/>
        <input class="div" type="date" name="data_rosd" />
      </div>
    </div>
    <input class="submit" type="submit"/>
  </form>
</div>
</body>
</html>
<link href="/css/register_form.css" rel="stylesheet" type="text/css">
');


