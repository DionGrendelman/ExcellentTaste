<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

use Medoo\Medoo;

class MenuItems
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
            $query = $this->db->select('menu-item', '*', ['Menuitemcode' => $id]);
            $error = $this->db->error();
            if (!$error[2]) {
                if(isset($query[0])) {
                    return $query[0];
                } else {
                    return false;
                }
            }
            return false;
        }

        return false;
    }

    /*Find a item with a custom search query*/
    public function findExt($ext)
    {
        if ($ext) {
            $query = $this->db->select('menu-item', '*', $ext);
            $error = $this->db->error();
            if (!$error[2]) {
                if(isset($query[0])) {
                    return $query[0];
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
            $query = $this->db->count('menu-item', $ext);
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

    /*Find all items*/
    public function findAll()
    {
        $query = $this->db->select('menu-item', '*');
        $error = $this->db->error();
        if (!$error[2]) {
            return $query;
        }
        return 'Not found';

    }


}

?>