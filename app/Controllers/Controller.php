<?php

namespace App\Controllers;

use Database\DBConnection;

abstract class Controller
{

    protected $db;

    // constructor
    public function __construct(DBConnection $db)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = $db;
    }

    // method view 
    protected function view(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        if ($params) {
            $params = extract($params);
        }
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }
    
    // method connection to the DB
    protected function getDB()
    {
        return $this->db;
    }
    
    // authorized user verification method 
    protected function isAuthorized($enterprise_user_id) 
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $enterprise_user_id){
            return true;
        } else if ($this->isAdmin()) 
        {
            return true;    
        } else {
            return false;
        } 
    }
    
    // verification method administrator     
    protected function isAdmin()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === 3) {
            return true;
        } else {
            return header('Location: /PrevProject/');
        }
    }
}
