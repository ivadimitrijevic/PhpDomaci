<?php

class Korisnik
{

    public function __construct(
        $id,
        $korisnicko_ime,
        $sifra
    ) {
        $this->id = $id;
        $this->korisnicko_ime = $korisnicko_ime;
        $this->sifra = $sifra;
    }

    public static function logInUser($username, $password, mysqli $conn)
    {
        $query = "SELECT * FROM korisnik WHERE korisnicko_ime='$username' and sifra='$password'";
        return $conn->query($query);
    }
}
