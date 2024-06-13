<?php
    namespace Core;
    
    // Import the Controller class from App namespace
    use App\Controller;

    class Model {
        
        public static function render($class, $method, $arg = []) {
            $db = []; // Initialize an empty array
            
            //full file path of the model class
            $file = MODEL_PATH . DIRECTORY_SEPARATOR . $class . ".php";
            
            // Check if the model file exists
            if (file_exists($file)) {
                // Require the model file if it exists
                require_once($file);
                
                // Construct the fully qualified class name
                $class = "App\Model\\" . $class;
                
                // Create an object of the model class
                $model = new $class();
                
                // Call the specified method on the model object
                $db = call_user_func([$model, $method], $arg);
            }
    
            // Return the result obtained from the method call
            return $db;
        }
    }
?>
