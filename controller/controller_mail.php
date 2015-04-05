<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller_mail
 *
 * @author Artemka
 */
class controller_mail {
     /**
     * Отправка почты пользователю 
     *
     * @param string  $subject Тема письма
     * @param string  $email Кому отправляем письмо
     * @param string  $name имя,фамилия получателя
     */
    function sendmail($subject, $email, $name) {
        include ($_SERVER['DOCUMENT_ROOT'] . "/conf/conf_mandrill.php");
        $args = ['key' => $key,
            'message' => ["html" => "тестовый код html",
                "text" => null,
                "from_email" => "ivankoartem@gmail.com",
                "from_name" => "Artem",
                "subject" => $subject,
                "to" => [["email" => $email, "type" => "cc", "name" => $name]],
                "track_opens" => false,
                "track_clicks" => false
            ]
        ];  

        $curl = curl_init('https://mandrillapp.com/api/1.0/messages/send.json');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));
        $response = curl_exec($curl);        
    }
}
