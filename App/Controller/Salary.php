<?php
    namespace App\Controller;
    use Core\View;
    use Core\Model;

    session_start();
    class Salary{

        private function salarydetails(){
            $details = $_SESSION['details'];
            $offset = isset($_POST['offset']) ? $_POST['offset'] : 0;
            $limit = 6;
        
            if(isset($_POST['left']) && $offset >= 2){
                $offset -= 6;
            }

            $totalRows = Model::render('Salary', 'count' ,$details[0]);

            $maxOffset = max(0, $totalRows - $limit);
            if(isset($_POST['right']) && $offset < $maxOffset){
                $offset += 6;
            }

            $months = Model::render('Salary', 'select', 'months');
            $salaryTable = Model::render('Salary', 'getSalary' ,[$details[0],$limit, $offset]);
            View::render('salary', ['details' => $details,
                                    'months' => $months,
                                    'salaryTable' => $salaryTable,
                                    'offset' => $offset,
                                    'limit' => $limit,
                                    'maxOffset' => $maxOffset
                                ]);
        }
        
        public function salaryPage() {

            if (isset($_POST['salary'])) { 
                $detail = $_POST['empId'];
                $det = json_decode($detail,true);
                $_SESSION['details'] = $det;
                $this->salarydetails();
            } 
            else {
                if (!isset($_SESSION['details']) || empty($_SESSION['details'])) {
                    View::render('login');
                    exit();
                } else {
                    $this->salarydetails();
                }
            }
        }

        public function addSalary($id){
            if(isset($_POST['addSal'])){
                $month = $_POST['month'];
                $year = $_POST['year'];
                $los = $_POST['los'];
                $base = $_POST['basSalary'];
                $salary = (float)$base - (float)$los;
                $array = array($id['id'],$month,$year,$los,$salary);
                $salary = Model::render('Salary' ,'addSalary', $array);
                if($salary === TRUE){
                    $this->swalAlert('Success !','Salary Added !','success');
                    exit();
                }
                else{
                    $this->swalAlert('Warning !','Error in inserting !','warning');
                    exit();
                }
            }
        }

        public function swalAlert($title,$text,$icon){
            echo "<script src='App/View/js/jquery.min.js'></script>";
            echo "<script src='App/View/js/sweetalert.min.js'></script>";
            echo "<script>
                    $(document).ready(function() { 
                        swal({
                            title: '{$title}',
                            text: '{$text}',
                            icon: '{$icon}',
                            buttons: 'Back'
                        }).then((value) => {
                            if (value) {
                                window.location.href = 'index.php?controller=Salary&action=salaryPage';
                            }
                        });
                    });
                </script>";
            $this->salaryPage();
            exit();
        }
        
    }
?>