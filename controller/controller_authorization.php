<?php
// session_start(); 
include_once ($_SERVER['DOCUMENT_ROOT'] . "/controller/controller_mail.php"); // подключаем файл с классом для работы с api отправки почты 
include_once ($_SERVER['DOCUMENT_ROOT'] . "/controller/controller_wargaming_api.php"); // подключаем файл с классом для работы с wargaming api

ini_set('display_errors', 1); // отображать все ошибки

class controller_authorization extends model_authorization { // класс наследует класс core 

    public function action_authorization() { // функция авторизации
        echo 'controller_authorization: ok <br>'; // служебный текст об успешной загрузке функции

        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'ok') {
                $this->autn_login($_GET['status'], $_GET['access_token'], $_GET['expires_at']);
                header('Location:http://' . $_SERVER['HTTP_HOST'] . '?page=authorization'); // очищаем информацию о статусе аутентификации из URL
            } elseif ($_GET['status'] == 'error') {
                if (isset($_GET['status'], $_GET['message'], $_GET['code'])) {// проверяем не пусты ли переменные
                    $this->error_data($_GET['status'], $_GET['message'], $_GET['code']);
                }
            }
        } elseif (empty($_SESSION['status'])) {
            $this->login_rerouting_wargaming_api();
        }  elseif ($_COOKIE['autn'] == '1') {
            $this->login_prolongate_wargaming_api();
        }
    }

    public function login_rerouting_wargaming_api() {
        $warg_api = new wargaming_api;
        $data = $warg_api->wargaming_api_login();
        header('Location: ' . $data['data']['location']);
        exit();
    }

    public function login_prolongate_wargaming_api() {
        if (empty($_SESSION['data'])) {
            $warg_api = new wargaming_api;
            $_SESSION['data'] = $warg_api->wargaming_api_prolongate($_SESSION['access_token']);
        }
        if ($_SESSION['data']['status'] == 'ok') {
            $res = $this->autn_chek_register($_SESSION['data']);
            if ($res === FALSE) {
                $res = $this->autn_register();
                if ($res === TRUE) {
                    $sendmail = new controller_mail;
                    $sendmail->sendmail('Регистрация', $_SESSION['mail'], $_SESSION['fio']);
                    
                }
            } elseif ($res === TRUE) {
              
                echo 'вы зарегистрированны и авторизированны';
            }
        }

        // var_dump($data);
        // var_dump($_COOKIE);
        // var_dump($_SESSION);
    }

}

/* 
        if (isset($_COOKIE['autn']) AND !empty($_COOKIE['autn'])) { // инициализированны данные в куки autn
            if($_GET['status'] == 'ok'){ // пользователь пришел к нам с сайта wargaming api с данными ?
                
                $this->autn1($_GET['status'], $_GET['access_token'], $_GET['expires_at']); // записываем данные в сесию и установим куки
            header('Location:http://'. $_SERVER['HTTP_HOST'].'?page=authorization'); // очищаем информацию о статусе аутентификации из URL
            
        } elseif ($_GET['status'] == 'error') {
            
            echo $this->error_data($_GET['status'],$_GET['message'],$_GET['code']);
            
                    }
                } else  {
                    $warg_api=new wargaming_api;
                    $data = $warg_api->login();
                    //header ('Location: '.$data['data']['location']);
                    exit();
                }         */
        
        
        
       /* if ($_COOKIE['autn'] == '1') { // проверяем куки если переменная 'autn' == 1 то передаем данные на проверку 
            $warg_api=new wargaming_api; // создаем класс работы с wargaming api
            if(empty($_SESSION['data'])){ // исключаем вторичное подтверждение access_token
            $_SESSION['data'] = $warg_api->wargaming_api_prolongate($_SESSION['access_token']); // подтверждаем access_token и записываем ответ в переменную
            goto modeldata; /// редикт на "modeldata" в будующем исправить
            }else { // если access_token подтвержден то передаем данные в модель
                modeldata: // сюда редиктится ссылка goto "modeldata"
                echo '<br>масив от api успешно получен'; //  служебный текст об успехе 
                $this->model->model_autn($_SESSION['data']); //передача масива данных в модель
            }
        } elseif (empty ($_COOKIE['autn'])) { // если у пользователя не было куки "autn" с любым значением
                          if($_GET['status']=='ok'){ // пользователь пришел к нам с сайта wargaming api с данными ?
                          setcookie("autn", '1'); // устанавливаем куки
                          echo 'куки установленны нужно перезагрузить страницу (баг)';// служебный текст об успехе 
                            $_SESSION['status'] = $_GET['status']; // записываем данные в сесию
                            $_SESSION['access_token'] = $_GET['access_token'];// записываем данные в сесию
                            $_SESSION['expires_at'] = $_GET['expires_at'];// записываем данные в сесию
                            header('Location:http://'. $_SERVER['HTTP_HOST'].'?page=authorization'); // очищаем информацию о статусе аутентификации из URL
                            }else { //если пользователь ещё не был на сайте wargaming api
                                
                                $warg_api=new wargaming_api; // создаем класс работы с wargaming api
                                $warg_api->wargaming_api_login(); // перенаправляем пользователя на страничку входа по OPENID
                            }
                        } elseif ($_COOKIE['autn']== '2' and $_SESSION['autn'] =='ok') {
                        echo 'вы уже авторизированы';
                    } 
      
*/
        
    


