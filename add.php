<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="css/dodaj.css">
</head>

<body>
    <h1>Dodaj instruktora</h1>

    <div class="mbody">
        <input type="hidden" id="action" value="add">
        Ime: <input type="text" id="ime" name="ime" class="form-control"><br>
        Prezime: <input type="text" id="prezime" name="prezime" class="form-control"><br>
        Godine rada: <input type="text" id="godine_rada" name="godine_rada" class="form-control"><br>
        Planina: <select id="combo" name="combo">
            <option value="1">Kopaonik</option>
            <option value="2">Zlatibor</option>
            <option value="3">Stara planina</option>
            <option value="4">Brezovica</option>
        </select><br>
        <button class="btn" name="add-submit" id="add-submit" type="submit"> Sacuvaj</button>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $("#add-submit").click(function() {
            var data = {
                action: $("#action").val(),
                ime: $("#ime").val(),
                prezime: $("#prezime").val(),
                godine_rada: $("#godine_rada").val(),
                planina: $("#combo").val()
            };

            $.ajax({
                url: "./model/adding.php",
                type: 'post',
                data: data,
                success: function(response) {
                    alert(response);
                    if (response == "Dodavanje usesno!") {
                        window.location.reload();
                    }
                }
            });
        });
    </script>
</body>


</html>