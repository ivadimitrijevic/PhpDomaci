<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Skijaška sezona</title>

</head>

<body>
    <h1>Registracija</h1>
    <div class="login-form">
        <div class="container">
            <input type="hidden" id="action" value="register">
            <label>Korisnik</label>
            <input type="text" id="username" name="username" class="form-control" required>
            <br><br><br>
            <label>Lozinka</label>
            <input type="text" id="password" name="password" class="form-control" required>
            <br><br><br>
            <button class="btn btn-primary" name="submit" onclick="submitData();">Registruj se</button>
        </div>
    </div>
    <p>
        <a href="index.php">Vrati se na logovanje</a>
    </p>
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
                    url: "./model/login.php",
                    type: 'post',
                    data: data,
                    success: function(response) {
                        alert(response);
                        if (response == "Registracija uspesna!") {
                            window.location.reload();
                        }
                    }
                });
            });
        }
    </script>
</body>

</html>