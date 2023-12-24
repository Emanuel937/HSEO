<?php 
/**
 *  Allow php to show error
 *  display one mean True
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function($class) {
   require __DIR__.'/src/logic/' . $class . '.php';
});

// Now you can use your Main class
//$run = new Main();
var_dump($_SERVER['REMOTE_ADDR']);



