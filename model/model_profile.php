<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model__profile
 *
 * @author Artemka
 */
class model__profile extends core{
    function info(){
        echo 'Здраствуйте,'.$this->Name().'.';
    }
    function Name (){
        $sql ="SELECT `familiya`,`imya`,`otchestvo` FROM `users` where `account_id` = $_SESSION[account_id]";
        $row = implode(" ", $this->connectdb()->query($sql)->fetch_array(MYSQLI_ASSOC));
        return $row;
    }
}
