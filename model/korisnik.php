<?php

class Korisnik
{
    public $id;
    public $korisnicko_ime;
    public $sifra;

    public function __construct(
        $id = null,
        $korisnicko_ime = null,
        $sifra = null
    ) {
        $this->id = $id;
        $this->korisnicko_ime = $korisnicko_ime;
        $this->sifra = $sifra;
    }

    public static function logInUser($korisnik, mysqli $conn)
    {
        $query = "SELECT * FROM korisnik WHERE korisnicko_ime='$korisnik->korisnicko_ime' and sifra='$korisnik->sifra'";
        return $conn->query($query);
    }
}

