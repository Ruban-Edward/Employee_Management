<?php
    namespace App\Model;

    class Salary extends Database{

        public function select($table){
            $query = "SELECT
                        *
                        FROM
                        $table";

            $statement = $this->conn->prepare($query);
            $statement->execute();
            $table_details = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $table_details;
        }

        public function addSalary($value){
            $query = "INSERT
                        INTO
                        salary_details
                        (
                        r_employee_id,
                        r_months_id,
                        year,
                        loss_of_pay,
                        total_salary
                        )
                        values
                        (?, ?, ?, ?, ?)";

            $statement = $this->conn->prepare($query);

            for($i = 0; $i < count($value); $i++){
                $statement->bindParam($i + 1, $value[$i]);
            }

            $salary = $statement->execute();
            return $salary;
        }

        public function getSalary($arg){
            $query = "SELECT
                        m.m_name,
                        s.year,
                        s.loss_of_pay,
                        s.total_salary
                        FROM
                        salary_details as s
                        JOIN 
                        months AS m ON s.r_months_id=m.m_id
                        WHERE 
                        s.r_employee_id= :id
                        LIMIT :limit
                        OFFSET :offset";
            
            $statement = $this->conn->prepare($query);

            $statement->bindParam(':id' , $arg[0], \PDO::PARAM_INT);
            $statement->bindParam(':limit' , $arg[1], \PDO::PARAM_INT);
            $statement->bindParam(':offset' , $arg[2], \PDO::PARAM_INT);

            $statement->execute();
            $salaryTable = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $salaryTable;
        }

        public function count($id){
            $query = "SELECT 
                        COUNT(salary_id) 
                        AS 
                        count 
                        FROM salary_details 
                        WHERE 
                        r_employee_id = :id";

            $statement = $this->conn->prepare($query);

            $statement->bindParam(':id' , $id, \PDO::PARAM_INT);

            $statement->execute();

            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result['count'];
        }
    }