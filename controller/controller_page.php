<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Модуль управления страницами.
 * значения получаем из параметра get page 
 * в случае если значения нет то переадресуем пользователя на страницу по умолчанию
 * @author Artemka
 */
class page {
    function page () {
              ///Инициализируем значения по умолчанию// 
		$controller_name = 'controller_index';
		$action_name = 'action_index';
                $model_name      = 'model_index';
             //Если переданы значения то выполняем присвоение//
                if (!empty($_GET['page'])) {
                    $controller_name = 'controller_'.$_GET['page'];
                    $action_name     = 'action_'.$_GET['page'];
                    $model_name      = 'model_'.$_GET['page'];
                }
                ////////////Добавляем префиксы////////////////
                echo 'controller: '.$controller_name.'<br>';
                echo 'action: '.$action_name.'<br><br>';
                 ///Проверяем наличие файла модели////////////
                $model_file = strtolower($model_name).'.php';
                $model_path = $_SERVER['DOCUMENT_ROOT'].'/model/'.$model_file;
                if(file_exists($model_path)){
                    echo 'model_path: ok <br><br>';
                include_once ($model_path);
                } else {
                    echo 'model_path: error<br>'
                    .$model_path.'<br>';}
                 ///Проверяем наличие файла контролера//////////
                $controller_file = strtolower($controller_name).'.php';
                $controller_path = $_SERVER['DOCUMENT_ROOT'].'/controller/'.$controller_file;
                if(file_exists($controller_path)){
                    echo 'controller_path: ok <br>';
                include_once ($controller_path);
                } else {
                    echo 'controller_path: error'
                    .$controller_path.'<br>';}
                //создаем обьект контролера////////
                $controller = new $controller_name;
                //присвоение имени действия///////
		$action = $action_name;
          //Выполняем проверку на наличие метода/контролера//
                if(method_exists($controller, $action)){
                    // вызываем действие контроллера
                     echo 'метод контролера : ok<br>';
                    $controller->$action();
                } else {
                    echo 'метод контролера : error<br>';}
    }

}

