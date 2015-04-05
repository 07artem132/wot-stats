<?php

/* подключим модель */
include_once ($_SERVER['DOCUMENT_ROOT'] . '/model/model_wargaming_api.php');
ini_set('display_errors', 1); // отображать все ошибки
/*
 * Контролер wargaming API
 * функции :
 * function wargaming_api_error -- обработка ошибок
 * function wargaming_api_login -- авторизация
 * function wargaming_api_prolongate -- подтверждение токена/пользователя
 * function wargaming_api_logout -- выход пользователя/удаление токена
 * 
 */

/**
 * Контроллер : wargaming_api
 *
 * @author Artemka
 */
class wargaming_api extends model_wargaming_api {

    /**
     * Wargaming API error
     * Обработка ошибок wargaming API (вы водится значение ошибки)
     * 
     *  входяшие данные :
     * @param string  $data ответ от API
     * 
     */
    function wargaming_api_error($data) {
        $code = $data['error']['code'];
        $message = $data['error']['message'];
        //$field = $data['error']['field'];
        echo $this->error($code, $message);
    }

    /**
     * Wargaming API auth/login
     * Класс работы с wargaming API для авторизации пользователя
     * перенаправит пользователя 
     */
    function wargaming_api_login() {
        $data = $this->login();

        if ($data['status'] == 'ok') {
            return $data;
        } else {
            $this->wargaming_api_error($data);
        }
    }

    /**
     * Wargaming API auth/prolongate
     * Класс работы с wargaming API для продления access_token 
     *  @param string  $access_token access token пользователя
     * @return arrau  масив с данными 
     */
    function wargaming_api_prolongate($access_token) {
        $data = $this->prolongate($access_token);
        if ($data['status'] === 'ok') {
            return $data;
        } else {
            $this->wargaming_api_error($data);
        }
    }

    /**
     * Wargaming API auth/logout
     * Класс работы с wargaming API для удаления access_token
     * @param string  $access_token передаем  access token пользователя
     * @return bool вернет true
     */
    function wargaming_api_logout($access_token) {
        return $this->wargaming_api_logout($access_token);
    }

}

//////////TESTS////////////
/////////// тестируемый участок кода ////////
//$warg_api=new wargaming_api;
//if(isset($_GET['status'])){
//    if(($_GET['status']==='ok')){
//        print_r($warg_api->wargaming_api_prolongate($_GET['status'],$_GET['access_token']));} 
//    else {
//        $data=['status'=>$_GET['status'],
//                'error'=>[
//                'message'=>$_GET['message'],
//                'code'=>$_GET['code']]];
//       $warg_api->wargaming_api_error($data);
//
//    }
//        } else {}