<?php
    class Controller{
        // Default values for controller, action, and parameters
        private $controller = "Employee";
        private $action = "login";
        private $parameter = [];

        // Constructor method to initialize the controller
        public function __construct(){
            $this->init();
        }

        // Initialize the controller, action, and parameters based on the URL
        public function init(){
            // Get the current query string from the server
            $url = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
            
            // Check if the URL contains '&' and has length greater than 3
            if(str_contains($url,'&') && strlen($url)>3){
                // Split the URL into an array using '&'
                $url_arr = explode('&', $url);
                
                // Check if controller and action parameters exist
                if(!$url_arr[0]){
                    throw new Exception ("Controller url is not Found");
                }
                if(!$url_arr[1]){
                    throw new Exception ("Action url is not Found");
                }
                
                // Set the controller and action based on URL parts
                $this->controller = ucfirst(str_replace("controller=", "" , $url_arr[0]));
                $this->action = str_replace("action=", "" , $url_arr[1]);

                // Extract and set parameters from the remaining URL parts
                $parameters = array_slice($url_arr,2);
                $this->parameter = isset($parameters) && !empty($parameters)
                    ? $this->para_func($parameters) 
                    : [] ;
            }
        }

        // Parse parameters from the URL and return them as an associative array
        public function para_func($parameters){
            $paramsArr = [];
        
            // Check if parameters array is empty or not set
            if(empty($parameters) || ! isset($parameters))
                throw new Exception("invalid params");
    
            // Iterate through each parameter and parse its key-value pairs
            foreach ($parameters as $param){
                // Split each parameter into key and value parts
                $parameter = explode("=", $param);
                $arguments = explode(",", $parameter[1]);
                
                // If there is only one argument, assign it to the parameter key
                if(count($arguments) == 1) {
                    $paramsArr[$parameter[0]] = $arguments[0];
                }
            }
                    
            return $paramsArr;
        }

        // Render the appropriate controller action with optional parameters
        public function render(){
            // Formulate the full namespace for the controller
            $this->controller = "App\Controller\\".$this->controller; 
            
            // Instantiate the controller object dynamically
            $con = new $this->controller;
            
            // Check if parameters are set, then call the controller action with parameters
            if(isset($this->parameter)){
                call_user_func([$con, $this->action], $this->parameter);
            }
            // If no parameters are set, call the controller action without parameters
            else if(isset($this->action)){
                call_user_func([$con, $this->action]);
            }
        }
    }
?>
