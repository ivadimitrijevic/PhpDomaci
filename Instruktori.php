<?php

require 'dbBroker.php';
require 'model/planina.php';
require 'model/instruktor.php';

session_start();
$rezultat = Instruktor::getAll($conn);

if (!$rezultat) {
    echo 'Nastala je greska prilikom preuzimanja podataka!';
    die();
}
if ($rezultat->num_rows == 0) {
    echo 'Nema instruktora!';
    die();
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta charset="UTF-8">
        <link rel="shortcut icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/instruktori.css">
        <title>Instruktori</title>

        <script>
            $(document).ready(function() {
                $("#search").on("keyup",
                    function() {
                        var value = $(this).val().toLowerCase();
                        $("#myTable tr").filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });

                    });
            });
        </script>

        <script>
            function sortTable() {
                var table, rows, switching, i, x, y, shouldSwitch;
                table = document.getElementById("myTable");
                switching = true;

                while (switching) {
                    switching = false;
                    rows = table.rows;
                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;
                        x = rows[i].getElementsByTagName("td")[3];
                        y = rows[i + 1].getElementsByTagName("td")[3];
                        if (Number(x.innerHTML) < Number(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                    }
                }
            }

            // $(document).ready(function() {
            //     function RefreshTable() {
            //         $("#myTable").load("Instruktori.php #myTable");
            //     }
            //     $("#add-submit").on("click", RefreshTable);
            // });

            // $("#myTable").DataTable().ajax.reload(); stavila u modalu za dodavanje class dugmeta

            $(document).ready(function() {
                $(document).on('click', '.refresh', function() {
                    $.ajax({
                        url: 'Instruktori.php',
                        method: "POST",
                        dataType: 'json',
                        success: function(response) {
                            $('#myTable').html(response);
                        }
                    });
                });
            });
        </script>


    </head>

    <body>
        <div class="jumbotron" style="color: black;">
            <h1>Instruktori Srbije</h1>
        </div>
        <div class="outer">
            <input id="search" type="text" style="margin-right:200px" clas="inner" placeholder="Pretrazi...">
            <button onclick="sortTable()" style="margin-left:200px" clas="inner">Sortiraj po iskustvu</button>
        </div>
        <div class="panel-body">
            <table id="myTable" class="table table-hover table-striped" style="color: lavander; background-color: rgb(128, 112, 185);">
                <thead class="thead">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Ime</th>
                        <th scope="col">Prezime</th>
                        <th scope="col">Godina rada</th>
                        <th scope="col">Planina</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="myBody">
                    <form name="myForm" method="post">
                        <?php while ($red = $rezultat->fetch_array()) { ?>
                            <tr>
                                <td><?php echo  $red['ime']; ?></td>
                                <td><?php echo $red['prezime']; ?></td>
                                <td><?php echo $red['godina_rada']; ?></td>
                                <td><?php echo (Planina::getById($red['planina_id'], $conn))['naziv'] ?></td>
                                <td><a class="btn" href='model/update.php?id="<?php echo $red[0] ?>"' style="border-color:yellow; color:yellow">Izmeni</a>
                                    <a class="btn" href='model/delete.php?id="<?php echo $red[0] ?>"' style="border-color:red; color:red">Izbrisi</a>
                                </td>
                            </tr>
                    <?php }
                    }
                    ?>
                </tbody>
            </table>
            <div class="row justify-content-between">
                <button class="col-4" name="btn-add" id="btn-add" data-toggle="modal" data-target="#addModal">Dodaj</button>
                <!--<button class="col-4" name="btn-change" id="btn-change" data-toggle="modal" data-target="#changeModal">Izmeni</button>-->

            </div>

        </div>


        <div id="addModal" class="modal">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h2>Dodaj instruktora</h2>
                        <span class="close" data-dismiss="modal">&times;</span>
                    </div>
                    <div class="modal-body">
                        Ime: <input type="text" name="ime" class="form-control"><br>
                        Prezime: <input type="text" name="prezime" class="form-control"><br>
                        Godine rada: <input type="text" name="godineRada" class="form-control"><br>
                        Planina: <select id="combo" name="combo">
                            <option value="1">Kopaonik</option>
                            <option value="2">Zlatibor</option>
                            <option value="3">Stara planina</option>
                            <option value="4">Brezovica</option>
                        </select><br>
                    </div>
                    <div class="modal-footer">
                        <input name="add-submit" class="refresh" type="submit" value="Sacuvaj" />
                    </div>
                </form>
            </div>
        </div>


        <?php
        if (isset($_POST['add-submit'])) {
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $godine_rada = intval($_POST['godineRada']);
            $planina = intval($_POST['combo']);
            $instruktor = new Instruktor(111, $ime, $prezime, $godine_rada, $planina);

            Instruktor::add($instruktor, $conn);
        }
        ?>

        <?php if (isset($_POST["iid"])) :
            $nasid = $_POST["iid"]; ?>
            <div id="changeModal" class="modal" style="display: block !important">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header">
                            <h2>Izmeni instruktora</h2>
                            <span class="close" data-dismiss="modal">&times;</span>
                        </div>
                        <div class="modal-body">
                            Ime: <input type="text" name="ime" class="form-control" /><br>
                            Prezime: <input type="text" name="prezime" class="form-control" /><br>
                            Godine rada: <input type="text" name="godineRada" class="form-control" /><br>
                            Planina: <select id="combo" name="combo">
                                <option value="1">Kopaonik</option>
                                <option value="2">Zlatibor</option>
                                <option value="3">Stara planina</option>
                                <option value="4">Brezovica</option>
                            </select><br>
                        </div>
                        <div class="modal-footer">
                            <input name="update-submit" type="submit" value="Azuriraj">
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <?php
        if (isset($_POST['btn-change'])) {
            $instruktor = Instruktor::getById($nasid, $conn);
            if (isset($_POST['update-submit'])) {
                $ime = $_POST['ime'];
                $prezime = $_POST['prezime'];
                $godine_rada = intval($_POST['godineRada']);
                $planina = intval($_POST['combo']);
                $instruktor = new Instruktor($nasid, $ime, $prezime, $godine_rada, $planina);

                Instruktor::update($instruktor, $conn);
            }
        }

        ?>



        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h2>Brisanje</h2>
                        <span class="close" data-dismiss="modal">&times;</span>
                    </div>
                    <div class="modal-body">
                        <select id="comboi" name="comboi">
                            <?php while ($red = $rezultat->fetch_array()) ?>
                            <option value="<?php echo $red[0]; ?>"><?php echo "$red[1] $red[2]"; ?></option>
                        </select>
                        <p>Da li ste sigurni da zelite da obrisete instruktora?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit">Da</button>
                        <button class="close" data-dismiss="modal">Ne</button>
                    </div>
                </form>
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    </body>

    </html>