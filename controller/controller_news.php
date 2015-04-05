<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller_news
 *
 * @author Artemka
 */
class controller_news extends core{
    function __construct() { // авто создаваемая функция для создания модели
    $this->model = new model_news(); // содали модель
    echo '<br>model_news : создана<br>';// служебный текст об успехе 
    }
    function action_news () { // действие по умолчанию
        $news = $_GET['news'];
        switch ($news) { /* получаем действие из get*/
          case "list_news": // выводим новости если переден параметр "list_news"
              $this->model->list_news(); // обращение к модели для вывода новостей
              break;
          case "add": /// добавление новости
              $this->model->add(); // обращение к модели для добавления новости
              break;
          case "edit": /// редактирвоание новости
              $this->model->edit(); // обращение к модели для редактирования новости
              break;
          case "full_news":
              $this->model->full_news();
              break;
        }
    }
}