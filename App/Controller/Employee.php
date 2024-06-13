<?php
    namespace App\Controller;
    use Core\View;
    use Core\Model;
    session_start(); // Start the session to manage user sessions
    
    class Employee{

        public function login(){
            View::render('login'); // Render the login view
        }

        public function homePage() {

            $offset = isset($_POST['offset']) ? $_POST['offset'] : 0; // Get offset from POST data or default to 0
            $limit = 5; // Number of items per page
            
            // Adjust offset based on navigation buttons
            if(isset($_POST['left']) && $offset >= 5){
                $offset -= 5;
            }

            $totalRows = Model::render('Employee', 'count'); // Get total number of rows from the model

            $maxOffset = max(0, $totalRows - $limit); // Calculate maximum offset
            
            if(isset($_POST['right']) && $offset < $maxOffset){
                $offset += 5;
            }
        
            // Fetch various data needed for rendering the home page
            $designation = Model::render('Employee', 'select', 'designation');
            $city = Model::render('Employee', 'select', 'city');
            $state = Model::render('Employee', 'select', 'state');
            $country = Model::render('Employee', 'select', 'country');
            $display = Model::render('Employee', 'userDisplay', [$limit, $offset]);
        
            // Render the home page view with necessary data
            View::render('home', [
                'designation' => $designation, 
                'city' => $city,
                'state' => $state,
                'country' => $country,
                'display' => $display,
                'offset' => $offset,
                'limit' => $limit,
                'maxOffset' => $maxOffset
            ]);
        }
        
        public function userValidate(){

            // Validate user login
            if(isset($_POST['login'])){
                $mail = isset($_POST['email']) ? $_POST['email'] : null;
                $pass = isset($_POST['pass']) ? $_POST['pass'] : null;
                $check = array($mail, $pass);  
                $result = Model::render('Employee', 'userCheck', $check); // Check user credentials
                $login = ($result);
                if($login){
                    $_SESSION['type'] = $login['r_users_id']; // Store user session information
                    $_SESSION['name'] = $login['name'];
                }
                if($result > 0){
                    $this->homePage(); // Redirect to home page if login successful
                } else {
                    $this->swalWrong('Warning !','Incorrect Email or Password','error'); // Display error message if login fails
                    exit();
                }
            } else {
                // Redirect to login page if session not set or empty
                if(!isset($_SESSION['name']) || empty($_SESSION['name'])){
                    View::render('login');
                    exit();
                } else {
                    $this->homePage(); // Redirect to home page if already logged in
                }
            }
        }
        
        // Method to add a new employee
        public function addEmployee(){
            if(isset($_POST['ModelSub'])){ // Check if form submitted
                // Retrieve and sanitize input data
                $name = isset($_POST['name']) ? strtolower($_POST['name']) : null;
                $dob = isset($_POST['dob']) ? $_POST['dob'] : NULL;
                $DOB = date("Y-m-d", strtotime($dob)); // Format date of birth
                
                // Calculate age based on date of birth
                $curDate = date("Y-m-d");
                $DOB_Date = date_create($DOB);
                $curDate_Date = date_create($curDate);
                $age_diff = date_diff($DOB_Date, $curDate_Date);
                $age = $age_diff->format('%y');

                // Retrieve and format date of joining
                $doj = isset($_POST['doj']) ? $_POST['doj'] : null;
                $DOJ = date("Y-m-d", strtotime($doj));

                $DOJ_Date = date_create($DOJ);
                $exp_diff = date_diff($DOJ_Date, $curDate_Date);
                $exp = $exp_diff->format('%y') ." years " .$exp_diff->format('%m') ." months";

                // Retrieve other employee details
                $designation = isset($_POST['designation']) ? $_POST['designation'] : null;
                $salary = $_POST['salary'];
                $address = isset($_POST['address']) ? strtolower($_POST['address']) : null;
                $city = isset($_POST['city']) ? $_POST['city'] : null;
                $state = isset($_POST['state']) ? $_POST['state'] : null;
                $country = isset($_POST['country']) ? $_POST['country'] : null;

                // Prepare array of employee data for insertion
                $addEmp = array($name, $DOB, $age, $DOJ, $exp, $designation, 
                                $address, $city, $state, $country , $salary
                            );

                // Insert employee data into database
                $insert = Model::render('Employee','insert' ,$addEmp);
                if($insert === TRUE){
                    $this->swalAlert('Success !','New Employee ' .ucwords($name).' Added !','success'); // Show success message
                    exit();
                }
                else{
                    $this->swalAlert('Warning !','Error in Inserting !','warning'); // Show error message
                    exit();
                }
            }
        }

        // Method to update employee details
        public function updateEmployee($id){
            if(isset($_POST['ModelSub'])){ // Check if form submitted
                // Retrieve employee ID and other input data
                $emp_id = $id['id'];
                $name = isset($_POST['name']) ? strtolower($_POST['name']) : null;
                
                $dob = isset($_POST['dob']) ? $_POST['dob'] : null;
                $DOB = date("Y-m-d", strtotime($dob));

                $curDate = date("Y-m-d");
                $DOB_Date = date_create($DOB);
                $curDate_Date = date_create($curDate);
                $age_diff = date_diff($DOB_Date, $curDate_Date);
                $age = $age_diff->format('%y');

                $doj = isset($_POST['doj']) ? $_POST['doj'] : null;
                $DOJ = date("Y-m-d", strtotime($doj));

                $DOJ_Date = date_create($DOJ);
                $exp_diff = date_diff($DOJ_Date, $curDate_Date);
                $exp = $exp_diff->format('%y') ." years " .$exp_diff->format('%m') ." months";

                // Retrieve other employee details
                $designation = isset($_POST['designation']) ? $_POST['designation'] : null;
                $salary = $_POST['salary'];
                $address = isset($_POST['address']) ? strtolower($_POST['address']) : null;
                $city = isset($_POST['city']) ? $_POST['city'] : null;
                $state = isset($_POST['state']) ? $_POST['state'] : null;
                $country = isset($_POST['country']) ? $_POST['country'] : null;

                // Prepare array of updated employee data
                $upEmp = array($emp_id, $name, $DOB, $age, $DOJ, $exp, 
                                $designation, $address, $city, $state, $country, $salary
                            );

                // Update employee data in database
                $update = Model::render('Employee','update' ,$upEmp);
                if($update === TRUE){
                    $this->swalAlert('Success !','Employee '.ucwords($name) .' Updated  !','success'); // Show success message
                    exit();
                }
                else{
                    $this->swalAlert('Warning !','Error in Updating !','warning'); // Show error message
                    exit();
                }
            }
        }

        // Method to delete an employee
        public function deleteEmployee($id){
            if(isset($_POST['deleteBtn'])){ // Check if delete button pressed
                $emp_id = $id['id'];
                // Delete employee from database
                $delete = Model::render('Employee','delete' ,$emp_id);
                if($delete === TRUE){
                    $this->swalAlert('Success !','Employee Deleted !','success'); // Show success message
                    exit();
                }
                else{
                    $this->swalAlert('Warning !','Error in Deleting !','warning'); // Show error message
                    exit();
                }
            }
        }

        // Method to handle user logout
        public function logout(){
            if(isset($_POST['logout'])){ // Check if logout button pressed
                // Unset session variables and destroy session
                session_unset();
                session_destroy();
                header("Location: index.php"); // Redirect to index page after logout
                exit();
            }
        }

        // Method to display a success alert message and redirect to user validation page
        public function swalAlert($title,$text,$icon){
            // Include jQuery and SweetAlert JavaScript libraries
            echo "<script src='App/View/js/jquery.min.js'></script>";
            echo "<script src='App/View/js/sweetalert.min.js'></script>";
            
            // Display SweetAlert dialog with provided title, text, and icon
            echo "<script>
                    $(document).ready(function() { 
                        swal({
                            title: '{$title}',
                            text: '{$text}',
                            icon: '{$icon}',
                            buttons: 'Back' // Display a single 'Back' button
                        }).then((value) => {
                            if (value) {
                                // Redirect to user validation page upon button click
                                window.location.href = 'index.php?controller=Employee&action=userValidate';
                            }
                        });
                    });
                </script>";
                
            // After displaying the alert, redirect to the home page
            $this->homePage();
            exit(); // Exit the script execution
        }

        // Method to display an error alert message and redirect to the login page
        public function swalWrong($title,$text,$icon){
            // Include jQuery and SweetAlert JavaScript libraries
            echo "<script src='App/View/js/jquery.min.js'></script>";
            echo "<script src='App/View/js/sweetalert.min.js'></script>";
            
            // Display SweetAlert dialog with provided title, text, and icon
            echo "<script>
                    $(document).ready(function() { 
                        swal({
                            title: '{$title}',
                            text: '{$text}',
                            icon: '{$icon}',
                            buttons: 'Back' // Display a single 'Back' button
                        }).then((value) => {
                            if (value) {
                                // Redirect to the index page upon button click
                                window.location.href = 'index.php';
                            }
                        });
                    });
                </script>";
                
            // After displaying the alert, redirect to the login page
            $this->login();
            exit(); // Exit the script execution
        }
    }
?>
