<?php
    namespace App\Model;

    class Employee extends Database{

        public function userCheck($check) {
            // Checks user credentials in the login table
            $query = "SELECT 
                        * 
                        FROM 
                        login 
                        WHERE 
                        email = :email 
                        AND 
                        password = :password";
            $login = $this->conn->prepare($query);
            $login->bindParam(':email', $check[0]);
            $login->bindParam(':password', $check[1]);
            $login->execute();
            return $login->fetch(\PDO::FETCH_ASSOC);
        }
        
        public function select($table){
            // Selects all records from a specified table
            $query = "SELECT 
                        * 
                        FROM 
                        $table
                        ORDER BY {$table}_name";
            $result = $this->conn->prepare($query);
            $result->execute();
            $table_details = $result->fetchAll(\PDO::FETCH_ASSOC);
            return $table_details;
        }

        public function insert($addEmp){
            // Inserts a new employee record into the database
            $query = "INSERT 
                        INTO 
                        employee 
                        (
                        name, 
                        dob, 
                        age, 
                        doj, 
                        experience, 
                        r_designation_id, 
                        address, 
                        r_city_id, 
                        r_state_id, 
                        r_country_id, 
                        salary
                        ) 
                        VALUES 
                        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $statement = $this->conn->prepare($query);

            for ($i = 0; $i < count($addEmp); $i++) {
                $statement->bindParam($i + 1, $addEmp[$i]);
            }

            $insert = $statement->execute();
            return $insert;
        }

        public function userDisplay($arg){
            // Displays employee details with related data
            $query = "SELECT 
                        e.emp_id, 
                        e.name, 
                        e.dob,
                        e.age, 
                        e.doj, 
                        e.experience,
                        d.designation_name, 
                        e.address, 
                        c.city_name, 
                        s.state_name, 
                        co.country_name,
                        d.d_id,
                        c.c_id,
                        s.s_id,
                        co.country_id,
                        e.salary
                        FROM 
                        employee e
                        JOIN designation d ON e.r_designation_id = d.d_id
                        JOIN city c ON e.r_city_id = c.c_id
                        JOIN state s ON e.r_state_id = s.s_id
                        JOIN country co ON e.r_country_id = co.country_id
                        WHERE 
                        e.is_deleted = 'N'
                        ORDER BY e.emp_id DESC
                        LIMIT :limit 
                        OFFSET :offset";
                
            $statement = $this->conn->prepare($query);

            $statement->bindParam(':limit' , $arg[0], \PDO::PARAM_INT);
            $statement->bindParam(':offset' , $arg[1], \PDO::PARAM_INT);

            $statement->execute();
            $display = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $display;
        }

        public function update($upEmp) {
            // Updates employee information based on emp_id
            $query = "UPDATE employee 
                        SET 
                        name = ?, 
                        dob = ?, 
                        age = ?, 
                        doj = ?, 
                        experience = ?, 
                        r_designation_id = ?, 
                        address = ?, 
                        r_city_id = ?, 
                        r_state_id = ?, 
                        r_country_id = ?, 
                        salary = ? 
                        WHERE 
                        emp_id = ?";
        
            $statement = $this->conn->prepare($query);
        
            // Assuming $upEmp is an array with values in the same order as the placeholders
            // for ($i = 0; $i < count($upEmp); $i++) {
            //     $statement->bindValue($i + 1, $upEmp[$i]);
            // }


            $statement->bindValue(1, $upEmp[1]);
            $statement->bindValue(2, $upEmp[2]);
            $statement->bindValue(3, $upEmp[3]);
            $statement->bindValue(4, $upEmp[4]);
            $statement->bindValue(5, $upEmp[5]);
            $statement->bindValue(6, $upEmp[6]);
            $statement->bindValue(7, $upEmp[7]);
            $statement->bindValue(8, $upEmp[8]);
            $statement->bindValue(9, $upEmp[9]);
            $statement->bindValue(10, $upEmp[10]);
            $statement->bindValue(11, $upEmp[11]);
            $statement->bindValue(12, $upEmp[0]);
        
            $update = $statement->execute();
            return $update;
        }
        

        public function delete($del){
            // Marks an employee as deleted in the database
            $query = "UPDATE
                        employee
                        SET 
                        is_deleted = 'Y'
                        WHERE
                        emp_id = :id";

            $statement = $this->conn->prepare($query);

            $statement->bindParam(':id',$del);

            $delete = $statement->execute();
            return $delete;
        }

        public function count(){
            // Counts the number of active employees
            $query = "SELECT 
                    COUNT(emp_id) 
                    AS
                    count 
                    FROM 
                    employee 
                    WHERE 
                    is_deleted = 'N'";

            $statement = $this->conn->prepare($query);
            $statement->execute();

            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result['count'];
        }
    }
?>
