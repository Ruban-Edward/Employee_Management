<?php
    // Define a user defined function to automatically load PHP class files
    function AutoLoad($class) {
        // Get the root directory of the project
        $root = dirname(__DIR__);
        
        // Construct the file path using the class name and root directory
        $file = $root . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . ".php";
        
        // Check if the file exists and is readable
        if (is_readable($file)) {
            // Include the file if it can be read
            require_once($file);
        }
    }
    
    // Register the user defined autoloader function with PHP's autoloading inbuilt function
    spl_autoload_register("AutoLoad");
?>
