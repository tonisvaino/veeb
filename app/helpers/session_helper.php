<?php
//flash message set up
function flashSet($name, $message, $class = 'alert alert-success'){
  $_SESSION[$name] = $message;
  $_SESSION[$name.'_class'] = $class;
}

//flash mssage show
function flashShow($name){
  if(!empty($_SESSION[$name])){
    $message = $_SESSION[$name];
    $class = (!empty($_SESSION[$name.'_class'])) ? $_SESSION[$name.'_class'] : '';

  }
}