<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="App/View/style/login.css">
    <link rel="stylesheet" href="App/View/style/bootstrap.min.css">
    <script src="App/View/js/jquery.min.js"></script>
    <script src="App/View/js/bootstrap.min.js"></script>
    <script src="App/View/js/login.js"></script>
</head>

<body>
    <div class="cls-login">
        <h2 class="cls-head">Login</h2>
        <div class="cls-form">
            <form id="loginForm" action="index.php?controller=Employee&action=userValidate" method="POST">
                <input type="email" name="email" id="email" placeholder="Email"><br>
                <span id="emailError" class="cls-error"></span><br><br>
                <input type="password" name="pass" id="pass" placeholder="Password"><br>
                <span id="passError" class="cls-error"></span><br>
                <div class="cls-button">
                    <button type="submit" name="login" form="loginForm" onclick="userValidate(event)">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>