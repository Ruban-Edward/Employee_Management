<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="App/View/style/home.css">
    <link rel="stylesheet" href="App/View/style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="App/View/js/jquery.min.js"></script>
    <script src="App/View/js/sweetalert.min.js"></script>
    <script src="App/View/js/bootstrap.min.js"></script>
    <script src="App/View/js/home.js"></script>
</head>

<body>
    <header>
        <nav class="navbar fixed-top cls-nav">
            <div class="cls-logo">
                <img src="App/View/img/infiniti-white.png" alt="">
            </div>
            <div class="cls-name">
                <h3>Welcome <?php echo ucfirst($_SESSION['name']); ?> !</h3>
            </div>
            <div class="cls-logout">
                <form action="index.php?controller=Employee&action=logout" id="logout" method="POST">
                    <button name="logout" form="logout">
                        <i class="fas fa-power-off"></i>Logout
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <section class="cls-home">
        <div class="cls-add">
        <?php 
            if(isset($_SESSION['type']) && $_SESSION['type'] == 3): ?>
                <button id="createBtn" onclick="return empButton()" style="visibility:hidden;">
                    <i class="fas fa-user"></i>New Employee
                </button>
        <?php else: ?>
                <button id="createBtn" data-toggle="modal" data-target="#addModal" onclick="openModal('create')">
                    <i class="fas fa-user"></i>New Employee
                </button>
        <?php endif; ?>
            <form method="POST">
                <input type="hidden" name="offset" value="<?php echo $offset; ?>">
                <div class="cls-page">
                    <button type="submit" name="left" <?php if($offset == 0) echo 'disabled'; ?>><i class="fas fa-chevron-left"></i></button>
                    &nbsp;&nbsp;
                    <button type="submit" name="right" <?php if($offset >= $maxOffset) echo 'disabled'; ?>><i class="fas fa-chevron-right"></i></button>
                </div>
            </form>
        </div>


        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Date Of Birth</th>
                        <th scope="col">Age</th>
                        <th scope="col">Date Of Joining</th>
                        <th scope="col">Experience</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Address</th>
                        <th scope="col">City</th>
                        <th scope="col">State</th>
                        <th scope="col">Country</th>
                        <th scope="col" colspan=2>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($display as $value){
                        echo "<tr>";
                        $val = json_encode($value);
                        $sal = json_encode([$value['emp_id'], $value['name'], $value['salary']]);
                        echo "<td>" . ucwords($value['name']) . "</td>";
                        echo "<td>" . date("d-m-Y" ,strtotime($value['dob'])) . "</td>";
                        echo "<td>" . $value['age'] . "</td>";
                        echo "<td>" . date("d-m-Y" ,strtotime($value['doj'])) . "</td>";
                        echo "<td>" . ucwords($value['experience']) . "</td>";
                        echo "<td>" . ucwords($value['designation_name']) . "</td>";
                        if(isset($_SESSION['type']) && ($_SESSION['type'] == 1 || $_SESSION['type'] == 2)){
                            echo "<td>
                                    <form action='index.php?controller=Salary&action=salaryPage' method='POST' id='salary_" . $value['emp_id'] . "'>
                                        <input type='hidden' name='empId' value='" .$sal  . "'>
                                        <button type='submit' class='cls-info' name='salary'>Salary</button>
                                    </form>
                                </td>";
                        }
                        else{
                            if(isset($_SESSION['type']) && $_SESSION['type'] == 3){
                                if(strtolower($_SESSION['name']) === strtolower($value['name'])){
                                    echo "<td>
                                        <form action='index.php?controller=Salary&action=salaryPage' method='POST' id='salary_" . $value['emp_id'] . "'>
                                            <input type='hidden' name='empId' value='" .$sal  . "'>
                                            <button type='submit' class='cls-info' name='salary'>Salary</button>
                                        </form>
                                    </td>";
                                }
                                else{
                                    echo "<td>
                                    <button type='submit' class='cls-info' onclick='return empSal()' name='salary'>Salary</button>
                                    </td>";
                                }
                            }
                            
                        }
                        echo "<td>" . ucwords($value['address']) . "</td>";
                        echo "<td>" . ucwords($value['city_name']) . "</td>";
                        echo "<td>" . ucwords($value['state_name']) . "</td>";
                        echo "<td>" . ucwords($value['country_name']) . "</td>";


                        if(isset($_SESSION['type']) && $_SESSION['type'] == 3){
                            echo "<td><button id='updateBtn' onclick='return empButton()' class='cls-up'>Update</button></td>";
                        }
                        else{
                            echo "<td><button id='updateBtn' data-toggle='modal' data-target='#addModal' onclick='openModal(\"update\", $val)' class='cls-up'>Update</button></td>";
                        }


                        if(isset($_SESSION['type']) && ($_SESSION['type']) == 1){
                            echo "<td><button id='deleteBtn' data-toggle='modal' data-target='#addModal' onclick='openModal(\"delete\", $val)' class='cls-del'>Delete</button></td>";
                        }
                        else if(isset($_SESSION['type']) && ($_SESSION['type']) == 2){
                            echo "<td><button type='submit' onclick='return managerDel()' class='cls-del'>Delete</button></td>";
                        }
                        else{
                            echo "<td><button type='submit' onclick='return empButton()' class='cls-del'>Delete</button></td>";
                        }
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </section>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header cls-modal-header">
                    <h5 class="modal-title" id="addModalTitle"></h5>
                    <button type="button" data-dismiss="modal">Back</button>
                </div>
                <div class="modal-body cls-modal-body">
                    <div id="form">
                        <form action="index.php?controller=Employee&action=addEmployee" id="addEmp" class="row" method="POST">
                            <div class="col-sm-4 cls-label">
                                <label for="name">Name<span class="star">&nbsp*</span></label><br>
                                <label for="dob">DOB<span class="star">&nbsp*</span></label><br>
                                <label for="doj">DOJ<span class="star">&nbsp*</span></label><br>
                                <label for="designation">Designation<span class="star">&nbsp*</span></label><br>
                                <label for="salary">Salary<span class="star">&nbsp*</span></label><br>
                                <label for="address">Address</label><br>
                                <label for="city">City<span class="star">&nbsp*</span></label><br>
                                <label for="state">State<span class="star">&nbsp*</span></label><br>
                                <label for="country">Country<span class="star">&nbsp*</span></label><br>
                            </div>
                            <div class="col-sm-8 cls-input">
                                <input type="text" name="name" id="name"><br>
                                <input type="date" name="dob" id="dob"><br>
                                <input type="date" name="doj" id="doj"><br>
                                <select name="designation" id="designation">
                                    <?php
                                            foreach($designation as $value){
                                                echo "<option value={$value['d_id']}>" . ucwords($value['designation_name']) . "</option>";
                                            }
                                        ?>
                                </select><br>
                                <input type="number" name="salary" id="salary"><br>
                                <input type="text" name="address" id="address"><br>
                                <select name="city" id="city">
                                    <?php
                                            foreach($city as $value){
                                                echo "<option value={$value['c_id']}>" . ucwords($value['city_name']) . "</option>";
                                            }
                                        ?>
                                </select><br>
                                <select name="state" id="state">
                                    <?php
                                            foreach($state as $value){
                                                echo "<option value={$value['s_id']}>" . ucwords($value['state_name']) . "</option>";
                                            }
                                        ?>
                                </select><br>
                                <select name="country" id="country">
                                    <?php
                                            foreach($country as $value){
                                                echo "<option value={$value['country_id']}>" . ucwords($value['country_name']) . "</option>";
                                            }
                                        ?>
                                </select><br>
                                <span class="cls-error" id="addError"></span><br>
                            </div>
                        </form>
                    </div>
                    <div id="warning"> 
                        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                        <dotlottie-player src="https://lottie.host/c4931654-c2cf-4ac0-b419-c6e3237234ed/vISUslPiFR.json" background="transparent" speed="1" style="width: 150px; height: 150px" direction="1" playMode="bounce" loop autoplay></dotlottie-player>                        
                        <h4 id="deleteMess"></h4>
                        <form action="index.php?controller=Employee&action=deleteEmployee" id="deleteEmp" method="POST">
                            <button type="submit" name="deleteBtn">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="addValidation(event)" form="addEmp" id="modalSubmitBtn" name="ModelSub"></button>                
                </div>
            </div>
        </div>
    </div>

</body>

</html>