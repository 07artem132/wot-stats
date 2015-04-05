<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

        <?php
        echo '<form name="test" method="post" action="?page=news&news=edit&id=$id">'
        . '<center>'
        . '<textarea name="text" cols="40" rows="10">'.$row['text'].'</textarea>'
        . '<input type="submit" name="Submit" value="edit News">'
        . '</<center>'
        . '</form>';
        ?>
