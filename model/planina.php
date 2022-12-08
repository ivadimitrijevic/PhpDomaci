<?php

class Planina
{
    public $id;
    public $naziv;
    public $broj_staza;
    public $pocetak_sezone;

    public function __construct(
        $id,
        $naziv,
        $broj_staza,
        $pocetak_sezone
    ) {
        $this->id = $id;
        $this->naziv = $naziv;
        $this->broj_staza = $broj_staza;
        $this->pocetak_sezone = $pocetak_sezone;
    }

    public static function getAll($conn)
    {
        $query = 'SELECT * FROM planina';
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM planina WHERE id=$id";
        $msqlObj = $conn->query($query);
        $row = $msqlObj->fetch_array();
        return $row;
    }

    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM planina WHERE id=$this->id";
        return $conn->query($query);
    }

    public function update(mysqli $conn)
    {
        $query = "UPDATE planina SET naziv=$this->naziv, broj_staza=$this->broj_staza, pocetak_sezone=$this->pocetak_sezone WHERE id=$this->id";
        return $conn->query($query);
    }

    public static function add(Planina $planina, mysqli $conn)
    {
        // $datedb = date("Y-m-d", strtotime($planina->pocetak_sezone));
        $query = "INSERT INTO planina (naziv, broj_staza, pocetak_sezone) VALUES ('$planina->naziv', '$planina->broj_staza', '$planina->pocetak_sezone')";
        return $conn->query($query);
    }
}
