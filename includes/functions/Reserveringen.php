<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

use Medoo\Medoo;

class Reserveringen
{
    public $db;
    public $data;
    public $limit;


    public function __construct()
    {
        $this->db = new Medoo(DB_INIT);
    }

    public function findExt($ext)
    {
        if ($ext) {
            $query = $this->db->select('reservering', '*', $ext);
            $error = $this->db->error();
            if (!$error[2]) {
                if (isset($query[0])) {
                    return $query[0];
                } else {
                    return false;
                }
            }
            return false;
        }

        return false;
    }

    public
    function findAll()
    {
        $query = $this->db->select('reservering', '*');
        $error = $this->db->error();
        if (!$error[2]) {
            return $query;
        }
        return 'Not found';

    }

    public
    function delete($date, $time, $table)
    {
        $this->db->delete('reservering', [
            'Datum' => $date,
            'Tijd' => $time,
            'Tafel' => $table
        ]);
        $error = $this->db->error();
        if (!$error[2]) {
            return true;
        }
        return false;
    }

    public
    function create($date, $time, $table, $klant, $aantal, $opmerkingen)
    {
        $data = $this->db->insert('reservering', [
            'Datum' => $date,
            'Tijd' => $time,
            'Tafel' => $table,
            'Klant-id' => $klant,
            'Aantal' => $aantal,
            'Opmerkingen' => $opmerkingen
        ]);
        $error = $this->db->error();
        if (!$error[2]) {
            return $data;
        }
        return false;
    }

    public
    function update($date, $time, $table, $klant = null, $aantal = null, $opmerkingen = null)
    {
        if ($klant) {
            if ($aantal) {
                if ($opmerkingen) {
                    $data = [
                        'Klant-id' => $klant,
                        'Aantal' => $aantal,
                        'Opmerkingen' => $opmerkingen
                    ];
                } else {
                    $data = [
                        'Klant-id' => $klant,
                        'Aantal' => $aantal
                    ];
                }
            } else {
                if ($opmerkingen) {
                    $data = [
                        'Klant-id' => $klant,
                        'Opmerkingen' => $opmerkingen
                    ];
                } else {
                    $data = [
                        'Klant-id' => $klant,
                    ];
                }
            }
        } else {
            if ($aantal) {
                if ($opmerkingen) {
                    $data = [
                        'Aantal' => $aantal,
                        'Opmerkingen' => $opmerkingen
                    ];
                } else {
                    $data = [
                        'Aantal' => $aantal
                    ];
                }
            } else {
                if ($opmerkingen) {
                    $data = [
                        'Opmerkingen' => $opmerkingen
                    ];
                } else {
                    $data = '';
                }

            }
        }

        $this->db->update('reservering', $data, [
            'Datum' => $date,
            'Tijd' => $time,
            'Tafel' => $table,
        ]);
        $error = $this->db->error();
        if (!$error[2]) {
            return true;
        }
        return false;
    }

}

?>