<?php

/*
 * Контроллер профиля пользователя
 * 
 * 
 */

/**
 * Description of controller_profile
 *
 * @author Artemka
 */
class controller_profile extends core{
    function __construct() { // авто создаваемая функция для создания модели
    $this->model = new model__profile(); // содали модель
    echo '<br>model__profile: создана<br>';// служебный текст об успехе 
    }
    function action_profile () {
        if(empty($_GET['do'])){$do='info';}
        switch ($do){
            case "info":
                $this->model->info();
                break;
        }
        } 
}
