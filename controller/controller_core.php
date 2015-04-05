<?php
ini_set('display_errors', 1);

class core {



    ////////////////ниже тестовое все
    function privileges ($clacc_obect,$actions) { // ТЕСТИРОВАТЬ ФУНКЦИЮ
        $db = $this->connectdb();
        $result = $db->query("SELECT `role_site` FROM `users` where account_id` = $_SESSION[account_id]");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        echo $result['role_site'];
        $result = $db->query("SELECT * FROM `privileges` where clacc_obect = $clacc_obect"); // корректировать запрос
        $result = $result->fetch_array(MYSQLI_ASSOC);
        var_dump($result);
        if ($result[$priveleges]== 1 ){
            echo 'вам разрешено выполнять данное действие ';
            $privileges =TRUE;
            return $priveleges;
        } else {
            echo 'вам запрещено выполнять данное действие';
            $privileges = FALSE;
            return $priveleges;}
    }
    function privileges_add_users ($clacc_obect,$actions) {
        
    }
    function privileges_remove ($clacc_obect,$actions) {
        
    }
    //таблица для sql
   //   clacc_obect	role	edit	add	delete
   //        news       admin	 1	 1	  1

}

