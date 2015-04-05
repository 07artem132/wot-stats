<?php

/*
 * Модель обработки wargaming API
 * функции :
 * function error -- обработка ошибок
 * function login -- авторизация
 * function prolongate -- подтверждение токена/пользователя
 * function logout -- выход пользователя/удаление токена
 * 
 */

/**
 * Класс модели wargaming_api
 *
 * @author Artemka
 */
class model_wargaming_api {

    /**
     * Wargaming API error
     * Модель обработки ошибок
     * 
     *  входяшие данные :
     * @param string  $data ответ от API
     * @return string текст ошибки
     */
    function error($code, $message) {

        switch ($code) {
            case "401":
                if ($message === 'AUTH_CANCEL') {
                    return ( exit("Вы отменили авторизацию"));
                }
                break;
            case "402":
                if (preg_match("/_NOT_SPECIFIED/", $message)) {
                    return (preg_replace("/_NOT_SPECIFIED/", ",не было заполненно это обязательное поле", $message));
                }
                break;
            case "403":
                if ($message === 'AUTH_EXPIRED') {
                    return ("Превышено время ожидания авторизации пользователя");
                }
                break;
            case "404":
                if ($message === 'METHOD_NOT_FOUND') {
                    return ( 'Указан неверный метод API.');
                } elseif (preg_match("/_NOT_FOUND/", $message)) {
                    return ( preg_replace("/_NOT_FOUND/", ",информация не найдена.", $message));
                }
                break;
            case "405":
                if ($message === 'METHOD_DISABLED') {
                    return ( "Данный метод отключен");
                }
                break;
            case "407":
                if ($message === 'APPLICATION_IS_BLOCKED') {
                    return ( 'Приложение заблокировано администрацией.');
                } elseif ($message === 'INVALID_APPLICATION_ID') {
                    return ('Неверный идентификатор приложения.');
                } elseif ($message === 'INVALID_IP_ADDRESS') {
                    return ('Недопустимый IP-адрес для серверного приложения.');
                } elseif ($message === 'REQUEST_LIMIT_EXCEEDED') {
                    return ('Превышены лимиты квотирования.');
                } elseif (preg_match("/INVALID_/", $message)) {
                    return ( preg_replace("/INVALID_/", "Не валидное значение для поля :", $message));
                } elseif (preg_match("/_LIST_LIMIT_EXCEEDED/", $message)) {
                    return ( preg_replace("/_LIST_LIMIT_EXCEEDED/", "здесь был привышен лимит передаваемых идетнификаторов :", $message));
                }
                break;
            case "410":
                if ($message === 'AUTH_ERROR') {
                    echo "Ошибка аутентификации";
                }
                break;
            case "504":
                if ($message === 'SOURCE_NOT_AVAILABLE') {
                    return ("Источник данных не доступен.");
                }
                break;
        }
    }

    /**
     * Wargaming API auth/login
     * Модель для получения данных авторизации от wargaming API
     * @return array масив со ссылкой куда перенаправить пользователя
     */
    function login() {
        include ($_SERVER['DOCUMENT_ROOT'] . "/conf/conf_wargamingapi.php");
        $context = stream_context_create(
                ['http' =>
                    ['method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => http_build_query(
                                ['nofollow' => 1,
                                    'expires_at' => 300,
                                    'redirect_uri' => URL,
                                    'application_id' => $appid])]]);
        $data = json_decode(file_get_contents('https://api.worldoftanks.ru/wot/auth/login/', false, $context), true);

        return $data;
    }

    /**
     * Wargaming API auth/prolongate
     * модель работы с wargaming API для продления access_token 
     *  @param string  $access_token access token пользователя
     * @return array  масив с данными 
     */
    function prolongate($access_token) {
        include ($_SERVER['DOCUMENT_ROOT'] . "/conf/conf_wargamingapi.php");
        $context = stream_context_create(
                ['http' =>
                    ['method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => http_build_query(
                                ['expires_at' => 1209500,
                                    'access_token' => $access_token,
                                    'application_id' => $appid])]]);
        $data = json_decode(file_get_contents('https://api.worldoftanks.ru/wot/auth/prolongate/', false, $context), true);
        return $data;
    }

    /**
     * Wargaming API auth/logout
     * модель работы с wargaming API для удаления access_token
     * @param string  $access_token передаем  access token пользователя
     * @return bool вернет true
     */
    function logout($access_token) {
        include ($_SERVER['DOCUMENT_ROOT'] . "/conf/conf_wargamingapi.php");
        $context = stream_context_create(
                ['http' =>
                    ['method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => http_build_query(
                                ['access_token' => $access_token,
                                    'application_id' => $appid])]]);
        $data = json_decode(file_get_contents('https://api.worldoftanks.ru/wot/auth/prolongate/', false, $context), true);
        return true;
    }

}
