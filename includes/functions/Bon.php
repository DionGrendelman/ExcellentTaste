<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

use Medoo\Medoo;

class Bon
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
            $query = $this->db->select('bon', '*', $ext);
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
        $query = $this->db->select('bon', '*');
        $error = $this->db->error();
        if (!$error[2]) {
            return $query;
        }
        return 'Not found';

    }

    public
    function delete($date, $time, $table)
    {
        $this->db->delete('bon', [
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

}

?>