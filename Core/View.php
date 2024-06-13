<?php
    namespace Core;

    class View {
        
        //$view is parameter that the file name of view file and $args is optional to send array 
        public static function render($view, $arg = []) {
            // Check if $view is set and not empty
            if (isset($view) && !empty($view)) {
                // Extract variables from $arg array into the Strings
                extract($arg, EXTR_SKIP);
                
                // file path of the view
                $file = VIEW_PATH . DIRECTORY_SEPARATOR . $view . ".php";
                
                // Check if the view file exists
                if (file_exists($file)) { 
                    // Require the view file
                    require($file);
                } else {
                    // Display an error message if the view file is not found
                    echo "{$view} is not found in " . VIEW_PATH;
                }
            }
        }
    }
?>
