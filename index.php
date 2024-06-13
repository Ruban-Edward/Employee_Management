<?php
    // Define constant for view path and model path
    define('VIEW_PATH', dirname(__DIR__).'/employee/App/View');
    define('MODEL_PATH', dirname(__DIR__).'/employee/App/Model');
    
    // Require the autoload file to load necessary classes
    require './Core/autoload.php';
    
    // Require the main controller file
    require 'App/Controller/Controller.php';
    
    // Create an object of Controller class
    $Controller = new Controller();
    
    // Call the render method
    $Controller->render();
?>
