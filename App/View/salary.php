<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=1.0">
    <title>Salary</title>
    <link rel="stylesheet" href="App/View/style/salary.css">
    <link rel="stylesheet" href="App/View/style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="App/View/js/jquery.min.js"></script>
    <script src="App/View/js/bootstrap.min.js"></script>
    <script src="App/View/js/salary.js"></script>
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

    <section>
        <div class="cls-head">
            <h2>Employee Salary Details of 
                <?php 
                    echo ucwords($details[1]); 
                ?>
            </h2>
            <form action="index.php?controller=Employee&action=userValidate" style="display:inline;" method="POST">
                <button class="cls-back"><i class="fas fa-backward"></i>Back</button>
            </form>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="offset" value="<?php echo $offset; ?>">
                <div class="cls-page">
                    <button type="submit" name="left" class="left"><i class="fas fa-chevron-left"></i></button>
                    &nbsp;&nbsp;
                    <button type="submit" name="right" <?php if($offset >= $maxOffset) echo 'disabled'; ?>><i class="fas fa-chevron-right"></i></button>
                </div>
            </form>
        </div>

        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <th>Month</th>
                    <th>Year</th>
                    <th>Loss Of Pay</th>
                    <th>Total Salary</th>
                </thead>
                <tbody>
                    <?php
                        foreach($salaryTable as $value){
                            echo "<tr>";
                            echo "<td>" .ucfirst($value['m_name']) ."</td>";
                            echo "<td>" .$value['year'] ."</td>";
                            echo "<td>" .$value['loss_of_pay'] ."</td>";
                            echo "<td>" .$value['total_salary'] ."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>


        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 3): ?>
            <div class="cls-addSalary" stlye="display:none;">
            </div>
        <?php else: ?>
            <div class="cls-addSalary">
                <button type="button" data-toggle="modal" data-target="#addSalary">Add Salary</button>
            </div>
        <?php endif; ?>


    </section>

    <div class="modal fade" id="addSalary" tabindex="-1" role="dialog" aria-labelledby="addSalaryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header cls-Mhead">
                <h5 class="modal-title" id="addSalaryLabel">Salary Details</h5>
                <button type="button" data-dismiss="modal" aria-label="Close">Back</button>
            </div>
            <div class="modal-body">
                <div id="form">
                    <form action="index.php?controller=Salary&action=addSalary&id=<?php echo $details[0];?>" id="addSal" class="row" method="POST">
                        <div class="col-sm-4 cls-label">
                            <label for="month">Month<span class="star">&nbsp*</span></label><br>
                            <label for="year">Year<span class="star">&nbsp*</span></label><br>
                            <label for="los">Loss of Pay<span class="star">&nbsp*</span></label><br>
                        </div>
                        <div class="col-sm-8 cls-input">
                            <select name="month" id="month">
                                <?php
                                    foreach($months as $value){
                                        echo "<option value={$value['m_id']}>" . ucwords($value['m_name']) . "</option>";
                                    }
                                ?>
                            </select><br>
                            <input type="hidden" value="<?php echo $details[2]; ?>" name="basSalary">
                            <input type="number" name="year" id="year" value="<?php echo date('Y')?>"><br>
                            <input type="number" name="los" id="los"><br>
                            <span class="cls-error" id="addError"></span><br>
                        </div>
                    </form>
                </div>
                <!-- <div class="cls-success">
                    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/a6dd4cbe-acc3-406e-ab6b-875ae7ce984b/BbrTPkSudD.json" background="transparent" speed="1" style="width: 150px; height: 150px" direction="1" playMode="bounce" loop autoplay></dotlottie-player>
                    <h3>Salary Added successfully</h3>
                    <form action="index.php?controller=Salary&action=salaryPage" method="POST">
                        <button>Back</button>
                    </form>
                </div>  -->
            </div>
            <div class="modal-footer">
                <button type="submit" onclick="addValidation(event)" form="addSal" id="modalSubmitBtn" name="addSal">Add</button>
            </div>
            </div>
        </div>
    </div>

</body>