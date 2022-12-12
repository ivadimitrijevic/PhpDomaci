<?php

class Instruktor
{


    public function __construct(
        public $id,
        public $ime,
        public $prezime,
        public $godina_rada,
        public $planina_id
    ) {
        $this->id = $id;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->godina_rada = $godina_rada;
        $this->planina_id = $planina_id;
    }

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM instruktor INNER JOIN planina ON instruktor.planina_id=planina.id";
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM instruktor WHERE id=$id";
        $myObj = [];
        return $conn->query($query);
    }

    public static function deleteById($id, mysqli $conn)
    {
        $query = "DELETE FROM instruktor WHERE id=$id";
        if ($conn->query($query) === TRUE) {
            echo "Instruktor izbrisan";
        } else {
            echo "Nije moguce izbrisati insturktora";
        }
    }

    public static function update(Instruktor $instruktor, mysqli $conn)
    {
        $query = "UPDATE instruktor SET ime=$instruktor->ime, prezime=$instruktor->prezime, godina_rada=$instruktor->godina_rada, planina_id= $instruktor->planina_id WHERE id=$instruktor->id";
        return $conn->query($query);
    }

    public static function add(Instruktor $instruktor, mysqli $conn)
    {
        $query = "INSERT INTO instruktor(ime,prezime,godina_rada,planina_id) VALUES ('$instruktor->ime', '$instruktor->prezime', '$instruktor->godina_rada', '$instruktor->planina_id')";
        return $conn->query($query);
    }
}
