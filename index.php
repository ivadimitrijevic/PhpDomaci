<?php

session_start();
if (isset($_SESSION['id'])) {
    header('Location: home.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Skijaška sezona</title>
</head>

<body>
    <h1>Uloguj se</h1>
    <div class="login-form">
        <div class="container">
            <input type="hidden" id="action" value="login">
            <label>Korisnik</label>
            <input type="text" id="username" name="username" class="form-control" required>
            <br><br><br>
            <label>Lozinka</label>
            <input type="text" id="password" name="password" class="form-control" required>
            <br><br><br>
            <button class="btn btn-primary" name="submit" onclick="submitData();">Prijavi se</button>
        </div>

    </div>
    <p><a href="register.php">Registruj se</a></p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function submitData() {
            $(document).ready(function() {
                var data = {
                    username: $("#username").val(),
                    password: $("#password").val(),
                    action: $("#action").val()
                };

                $.ajax({
                    url: "model/login.php",
                    type: 'post',
                    data: data,
                    success: function(response) {
                        alert(response);

                        if (response == "Prijava uspesna!") {
                            window.location.reload();
                        }
                    }
                });
            });
        }
    </script>
</body>

</html>