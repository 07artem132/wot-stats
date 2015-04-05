<!DOCTYPE html>
<!--
Таблица новости
-->
        <?php
                     echo "<center><table width='100%' border='1' style='width: 500;'>"
                    . "<tbody>"
                     . "<tr>"
                     . "<td style='width: 14%;'>ID $id</td>"
                     . "<td style='text-align: center;'>$title </td>"
                     . "<td style='width: 29%;'>$data</td>"
                     . "<td style='width: 9%;'><a href='?page=news&news=edit&id=$id'>edit</a></td>"
                     . "</tr>"
                     . "<tr>"
                     . "<td style='text-align: center;' colspan='4'>$text_news_full</td>"
                     . "</tr>"
                     . "</tbody>"
                     . "</table></center>";
        ?>