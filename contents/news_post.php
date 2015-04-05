<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<center>
<form name='post news' method='post' action='?page=news&news=add'>
  <p align='center'><font size='2' face='Verdana'>Title:<br>
    <input type='text' name='title'>
    <br>
    Text сокращенный:<br>
    <textarea name='news' cols='40' wrap='VIRTUAL'></textarea><br>
    Text полный:<br>
    <textarea name='news_full' cols='40' wrap='VIRTUAL'></textarea>
    </font></p>
  <p align='center'><font size='2' face='Verdana'> 
    <input type='submit' name='Submit' value='Post News'>
    </font> </p>
  </form></center>