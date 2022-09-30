<?php

namespace App\Controllers;

use App\Models\User;
use App\Exception\NotFoundException;


class UsersListController extends Controller
{
    // METHOD SELECT
    public function showUsersList()
    {
        $this->isAdmin();

        $users = (new User($this->getDB()))->all();
        
        return $this->view('table.users_list_admin', compact('users'));
    }
    
    public function showFormUser()
    {
        $this->isAdmin();
        
        $user = explode('/', $_GET['route']);
        $user_id = intval($user[2]);
        // user id retrieval
        $user = (new User($this->getDB()))->findById($user_id);
        
        return $this->view('form.update_user_admin', compact('user'));
    }
    
    // METHOD UPDATE
    public function updateUser($user_id)
    {
        $this->isAdmin();
        // user id retrieval
        $user_id = intval($user_id);
        $user = (new User($this->getDB()))->findById($user_id);
        $user_id = intval($user -> id);
        $data = array(
            "email" => $_POST['email'],
            "role_id" => $_POST['role_id']
        );
        // update of an enterprise in the enterprises table
        $output_update_user = (new User($this->getDB()))->update($user_id, $data);
        if ($output_update_user = true)
        {
            $info = "Données utilisateur mises à jour.";
            $user = (new User($this->getDB()))->findById($user_id);
            return $this->view('form.update_user_admin', compact('user', 'info'));
        } else {
            $info = "Données utilisateur non mises à jour.";
            $user = (new User($this->getDB()))->findById($user_id);
            return $this->view('form.update_user_admin', compact('user', 'info'));
        }

        $this -> showFormUser();
    }

    // METHOD DELETE
    public function deleteUser($user_id)
    {
        $this->isAdmin();
        // user_id recovery 
        $user = (new User($this->getDB()))->findById($user_id);
        $user_id = $user -> id;
        $delete_user = (new User($this->getDB()))->destroy($user_id);
        
        $info = "Utilisateur supprimé.";
        
        $this -> showUsersList();
        return $this -> view('table.users_list_admin', compact('info'));
    } 
}
