<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

use Medoo\Medoo;

class Bestellingen
{
    public $db;
    public $data;
    public $limit;


    public function __construct()
    {
        $this->db = new Medoo(DB_INIT);
    }


    /*Find a item with a custom search query*/

    public function findExt($ext)
    {
        if ($ext) {
            $query = $this->db->select('bestelling', '*', $ext);
            $error = $this->db->error();
            if (!$error[2]) {
                if (isset($query)) {
                    return $query;
                } else {
                    return false;
                }
            }
            return false;
        }

        return false;
    }

    /*Find a item with a custom search query with a boolean return*/
    public function findExtBoolean($ext)
    {
        if ($ext) {
            $query = $this->db->count('bestelling', $ext);
            $error = $this->db->error();
            if (!$error[2]) {
                if ($query > 0) {
                    return true;
                }
                return false;
            }
            return false;
        }

        return false;
    }

    /*Find itme with custom search query and return array*/
    public function findExtQuery($ext)
    {
        if ($ext) {
            $query = $this->db->count('bestelling', $ext);
            $error = $this->db->error();
            if (!$error[2]) {
                if ($query > 0) {
                    $query = $this->db->select('bestelling','*', $ext);
                    return $query;
                }
                return '';
            }
            return '';
        }

        return '';
    }

    /*Find all items*/
    public function findAll()
    {
        $query = $this->db->select('bestelling', '*');
        $error = $this->db->error();
        if (!$error[2]) {
            return $query;
        }
        return 'Not found';

    }

    /*Check if there excist a bestelling with table, time and date.*/
    public function bestellingUsed($tafel, $tijd, $datum)
    {
        if ($this->findExtBoolean(
            [
                'Datum' => $datum,
                'Tijd' => $tijd,
                'Tafel' => $tafel,
            ]
        )) {
            return 'Ja';
        } else {
            return 'Nee';
        }

    }


    public function calculateBestelling($tafel, $tijd, $datum)
    {
        if ($this->findExtBoolean(
            [
                'Datum' => $datum,
                'Tijd' => $tijd,
                'Tafel' => $tafel,
            ]
        )) {
            $data = $this->findExtQuery(
                [
                    'Datum' => $datum,
                    'Tijd' => $tijd,
                    'Tafel' => $tafel,
                ]
            );
            $price = 0;
            if(isset($data) && $data && is_array($data)) {
                foreach ($data as $dat) {
                    $totalthisprice = $dat['Prijs'] * $dat['Aantal'];
                    $price = $price + $totalthisprice;
                }
                if ($price == 0) {
                    return 0;
                }
                return $price;
            } else{
                return 0;

            }
        } else {
            return 0;
        }
    }

}

?>