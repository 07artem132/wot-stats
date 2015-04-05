<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller_mysql
 *
 * @author Artemka
 */
class controller_mysql {

    /**
     * Подключение к базе данных,в случае удачи получаем соединение 
     * в случае ошибки сообщение об ошибке
     * @return connect_mysql
     */function connectdb() {
        include ($_SERVER['DOCUMENT_ROOT'] . "/conf/conf_sql.php");
        //если произошла ошибка то выводим сообщение

        if (!$result = new mysqli($sql_server, $user_sql, $pass_sql, $db_sql)) {
            echo 'ошибка соединения';
            $result->connect_errno;
            $result->error;
        }
        //если соединение прошло удачно, то возвращаем результат - соединение
        else {
            return $result;
        }
    }

}
