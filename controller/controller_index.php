<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index
 *
 * @author Artemka
 */
class controller_index {

function __construct() {
$this->model = new model_index();
}
/**
* Контролер страницы index
* 
* 
 */ 
 function action_index () {
     
     
     echo 'controller_index: ok <br>';

     
 }
}


