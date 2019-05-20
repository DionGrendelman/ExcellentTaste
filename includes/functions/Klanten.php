<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

use Medoo\Medoo;

class Klanten
{
    public $db;
    public $data;
    public $limit;


    public function __construct()
    {
        $this->db = new Medoo(DB_INIT);
    }

    public function find($id)
    {
        if ($id) {
            $query = $this->db->select('klant', '*', ['Klantid' => $id]);
            $error = $this->db->error();
            if (!$error[2]) {
                return $query[0];
            }
            return 'Not found';
        }

        return 'Not found';
    }

    public function findExt($ext)
    {
        if ($ext) {
            $query = $this->db->select('klant', '*', [$ext]);
            $error = $this->db->error();
            if (!$error[2]) {
                return $query[0];
            }
            return 'Not found';
        }

        return 'Not found';
    }

    public function findAll()
    {
        $query = $this->db->select('klant', '*');
        $error = $this->db->error();
        if (!$error[2]) {
            return $query;
        }
        return 'Not found';

    }

    public function create(
                           $klantnaam ,
                           $klanttelefoon ,
                           $klantstraat ,
                           $klanthuisnummer ,
                           $klanttoevoeging ,
                           $klantpostcode ,
                           $klantwoonplaats ,
                           $klantland
    )
    {
        $query = $this->db->insert('klant', [
            'Klantnaam' => $klantnaam,
            'Telefoon' => $klanttelefoon,
            'Straat' => $klantstraat,
            'Huisnummer' => $klanthuisnummer,
            'Toevoeging' => $klanttoevoeging,
            'Postcode' => $klantpostcode,
            'Woonplaats' => $klantwoonplaats,
            'Land' => $klantland,
        ]);
        $error = $this->db->error();
        if (!$error[2]) {
            return $query;
        }
        return false;

    }

    public function update(
        $klant,
        $klanttelefoon ,
        $klantstraat ,
        $klanthuisnummer ,
        $klanttoevoeging ,
        $klantpostcode ,
        $klantwoonplaats ,
        $klantland
    )
    {
        $query = $this->db->update('klant', [
            'Telefoon' => $klanttelefoon,
            'Straat' => $klantstraat,
            'Huisnummer' => $klanthuisnummer,
            'Toevoeging' => $klanttoevoeging,
            'Postcode' => $klantpostcode,
            'Woonplaats' => $klantwoonplaats,
            'Land' => $klantland,
        ],['Klantid' => $klant]);
        $error = $this->db->error();
        if (!$error[2]) {
            return true;
        }
        return false;

    }

}

?>