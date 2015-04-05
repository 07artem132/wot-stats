<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . "/controller/controller_mysql.php"); // подключаем файл с классом для работы с mysql
include_once ($_SERVER['DOCUMENT_ROOT'] . "/controller/controller_wargaming_api.php"); // подключаем файл с классом для работы с wargaming api
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_authorization
 *
 * @author Artemka
 */
class model_authorization {

    function error_data($status, $message, $code) {
        if (!empty($status) AND ! empty($message) AND ! empty($code)) {
            $data = ['status' => $status,
                'error' => [
                    'message' => $message,
                    'code' => $code]];
            $warg_api = new wargaming_api();
            $data = $warg_api->wargaming_api_error($data);
            return $data;
        }
    }

    function autn_login($status, $access_token, $expires_at) {
        $_SESSION['status'] = $status; // записываем данные в сесию
        $_SESSION['access_token'] = $access_token; // записываем данные в сесию
        $_SESSION['expires_at'] = $expires_at; // записываем данные в сесию
        setcookie("autn", '1'); // устанавливаем куки ч1 авторизации переход с сайта варгейминг к нам
    }

    public function autn_chek_register($data) {
        $_SESSION['access_token'] = $data['data']['access_token']; // обновили данные в сесии
        $_SESSION['expires_at'] = $data['data']['expires_at']; // обновили данные в сесии
        $_SESSION['account_id'] = $data['data']['account_id']; // записываем данные в сесию
        $db = new controller_mysql;
        $res = $db->connectdb()->query("SELECT `register` FROM `users` where `account_id` = $_SESSION[account_id]");
        $res = $res->fetch_assoc();
        if ($res == '') {
            echo 'пусто<br>'; // добавить запись в БД с идентификатором аккаунта,
            $res = $db->connectdb()->query("INSERT INTO `wot-stats`.`users` (`account_id`) VALUES ($_SESSION[account_id])");
            if ($res) {
                echo 'запрос к БД успешен';
                $db->connectdb()->close;
            } else {
                echo'Запрос к БД обернулся ошибкой : ' . $db->connectdb()->error;
                $db->connectdb()->close;
            }
        } elseif ($res['register'] == '1') {
            return FALSE;
        } elseif ($res['register'] == '2') {
            setcookie("autn", '2');
            $_SESSION['autn'] = 'ok';
            return TRUE;
        }
    }

    public function autn_register() {
        if (isset($_POST['familiya'], $_POST['imya'], $_POST['mail'], $_POST['otchestvo'], $_POST['data_rosd'], $_POST['tel'])) {
            $db = new controller_mysql;
            $mail = $_POST['mail'];
            $imya= $_POST['imya'];
            $familiya = $_POST['familiya'];
            $otchestvo = $_POST['otchestvo'];
            $tel = $_POST['tel'];
            $data_rosd = $_POST['data_rosd'];
            $sql = "UPDATE `wot-stats`.`users` SET `mail` = '$mail', `imya` = '$imya',`familiya` = '$familiya', `otchestvo` = '$otchestvo',`register` = '2',`tel` = '$tel',`data_rosd`='$data_rosd' WHERE `users`.`account_id` = $_SESSION[account_id]";
            $res = $db->connectdb()->query($sql);
            if ($res) {
                $_SESSION['fio'] = $_POST['familiya'] . ' ' . $_POST['imya'] . ' ' . $_POST['otchestvo'];
                $_SESSION['mail'] = $_POST['mail'];
                return TRUE;
            } else {
                echo'Запрос к БД обернулся ошибкой : ' . $db->error;
                $db->connectdb()->close;
                exit();
            }
        } else {
            include_once ($_SERVER['DOCUMENT_ROOT'] . '/contents/register_form.php');
        }
    }
}