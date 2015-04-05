<?php

/* Модуль новостей
 * 
 * 
 * 
 */

/**
 * Description of model_news
 *
 * @author Artemka
 */
class model_news extends core{
    /**
    *  Модуль : news - добавление новости
    *  id пользователя берется из сесии
    */
    function add(){ 
        if(!isset($_POST['title'],$_POST['news'],$_POST['Submit'],$_POST['news_full'])){ // если пользователь не заполнил форму выводим форму
        include_once ($_SERVER['DOCUMENT_ROOT'].'/contents/news_post.php');} // подключаем форму
        else{ // если пользователь заполнил все поля
             $title = $_POST['title']; // заголовок
             $text_news =$_POST['news']; // сокращенный текст новости
             $text_news_full = $_POST['news_full']; // полный текст новости
             $autor_id = $_SESSION['account_id']; // id автора
             $sql = "INSERT INTO `wot-stats`.`news` (`text`, `title`, `autor_id`,`news_full`) VALUES ('$text_news', '$title', '$autor_id','$text_news_full')";
             $this->connectdb()->query($sql);
             // добавить закрытие соединения с БД
             echo 'новость успешно добавлена';
        }
    }
    /**
    *  Модуль : news - Список новостей
    *  
    */
    function list_news(){
        $sql = "SELECT `id`,`autor_id`,`title`,`text`,`data` FROM `news`";
         $result = $this->connectdb()->query($sql);
         while($row = $result->fetch_array(MYSQLI_ASSOC))
         {
         $id = $row['id']; // идентификатор новости
         $autor_id = $row['autor_id']; // идентификатор автора 
         $title = $row['title']; // заголовок
         $text_news = $row['text']; // сокращенный текст новости
         $data = $row['data']; // дата публикации
         
         include ($_SERVER['DOCUMENT_ROOT'].'/contents/news_list-news.php'); // подключаем "шаблон"
        }
    }
    /**
    *  Модуль : news - полная новость
    *  
    */
    function full_news(){
         $id = $_GET['id']; // идентификатор новости
         $sql = "SELECT `autor_id`,`title`,`news_full`,`data` FROM `news` where id=$id";
         $result = $this->connectdb()->query($sql);
         $row = $result->fetch_array(MYSQLI_ASSOC);
         $autor_id = $row['autor_id']; // идентификатор автора 
         $title = $row['title']; // заголовок
         $data = $row['data']; // дата публикации
         $text_news_full = $row['news_full']; // полный текст новости
         include_once ($_SERVER['DOCUMENT_ROOT'].'/contents/news_news_full.php'); // подключаем "шаблон"
         
    }
    
    /**
    *  Модуль : news - редактирование новостей
    *  
    */
    function edit () {
        if(isset($_GET['text'])) { // обновляем данные в БД если определена переменная 
           $id=$_GET['id'];// получаем id новости
           echo $id ; // для тестирования
           $sql =" UPDATE `wot-stats`.`news` SET `text` = $_GET[text];  WHERE `users`.`id` = $id";
           $res = $this->connectdb()->query($sql);
        } else {
        $id = $_GET['id'];// получаем id новости
        $sql = "SELECT `title`,`text` FROM `news` where id = $id";
        $result = $this->connectdb()->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC); // преобразуем ответ от БД в ассоциированный масив
        include_once ($_SERVER['DOCUMENT_ROOT'].'/contents/news_edit.php'); // подключили "шаблон"
        }
    }
    /**
    *  Модуль : news - удаление новости
    *  
    */
    function delete(){
                // удалеиие новости
            }
}
