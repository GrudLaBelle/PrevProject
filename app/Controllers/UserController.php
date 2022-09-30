<?php

namespace App\Controllers;

use App\Models\User;
use App\Validation\Validator;

class UserController extends Controller {

    public function signUp()
    {
        return $this->view('auth.sign_up_view');
    }
    
    // METHOD CREATE user
    public function signUpUser() 
    {
        $data = $_POST;
        
        // determination of the default role 2 = corresponds to user
        $data['role_id'] = 2;
        
        // validation of the information of the fields and of the email with an email signatur
        $validator = new Validator($data);
        $errors = $validator->validate(
        [
            'email' => ['required', 'validEmail'],
            'password' => ['required']
        ]);
        
        // error management in case of non-validation
        if ($errors) {
            $_SESSION['errors'][] = $errors;
            
            header('Location: /PrevProject/sign_up');
            exit;
        };
        
        
        $email_verified = (new User($this->getDB()))->existsByEmail($data['email'])->exists_user;
        if ($email_verified === 1)
        {
            $info = "Utilisateur déjà existant.";
            return $this->view('auth.sign_up_view', compact('info'));
        } else {
            // password hash
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            
            $user = array_filter($data, function($k)
                {
                    return $k == 'email' || $k == 'password' || $k == 'role_id';
                }, ARRAY_FILTER_USE_KEY);
                
            // create a new user in the user table
            $output_save_user = (new User($this->getDB()))->create($user);
        
            // user id retrieval from email for enterprise data display 
            $user = (new User($this->getDB()))->findByEmail($data['email']);
            $user_id = intval($user->id);
            header('Location: /PrevProject/login');
        }
    }
    
    // METHOD LOGIN user
    public function login()
    {
        return $this->view('auth.login_view');
    }

    public function loginUser()
    {
        $data = $_POST;
        
        // validation of the information of the fields and of the email with an email signature
        $validator = new Validator($data);
        $errors = $validator->validate([
            'email' => ['required', 'validEmail'],
            'password' => ['required']
        ]);
        
        // error management in case of non-validation of fields
        if ($errors) 
        {
            $_SESSION['errors'][] = $errors;
            $info = "Informations incorrectes, l'email et le mot de passe doivent être renseignés.";
            return $this->view('auth.sign_up_view', compact('info'));
        }

         $email_verified = (new User($this->getDB()))->existsByEmail($data['email'])->exists_user;
        if ($email_verified === 0)
        {
            $info = "Informations incorrectes, le couple email et mot de passe n'existe pas.";
            return $this->view('auth.login_view', compact('info'));
        }
        
        $user = (new User($this->getDB()))->findByEmail($data['email']);

        // hash password verification and login
        if ( password_verify($data['password'], $user->password) ) 
        {
            // gestion de la session
            $_SESSION['auth'] = (int) $user->role_id;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['email'] = $user->email;
            if($_SESSION['auth'] == 2) 
            {
                return header('Location: /PrevProject/enterprise/'.$_SESSION['user_id']);
            } elseif($_SESSION['auth'] == 3) 
            {
                return header('Location: /PrevProject/userslist/'.$_SESSION['user_id']);
            }
        } else 
        {
            $info = "Informations incorrectes, le couple email et mot de passe ne correspond pas";
            
            return $this->view('auth.login_view', compact('info'));
        }
    }
    
    // METHOD DISCONNECTION
    public function logout()
    {
        session_destroy();
        return header('Location: /PrevProject/');
    }
    
    // FORM USER
    public function showFormUser($user_id) 
    {
        // user id retrieval
        $user = (new User($this->getDB()))->findById($user_id);
        
        return $this->view('form.user_update', compact('user'));
    }
    
    // METHODEUPDATE USER
    public function updateUser()
    {
        // recuperation of the user id thanks to the email
        $email = $_POST['email'];
        $user = (new User($this->getDB()))->findByEmail($email);
        $user_id = intval($user -> id);
        $data = array(
            "email" => $_POST['email'],
            "password" => $_POST['password']
        );
        // update of an enterprise in the enterprises table
        $output_update_user = (new User($this->getDB()))->update($user_id, $data);
        if ($output_update_user = true)
        {
            $info = "Données utilisateur mises à jour.";
            $user = (new User($this->getDB()))->findById($user_id);
            
            return $this->view('form.user_update', compact('user', 'info'));
        } else 
        {
            $info = "Données utilisateur non mises à jour.";
            $user = (new User($this->getDB()))->findById($user_id);
            
            return $this->view('form.user_update', compact('user', 'info'));
        }

        $this -> showFormUser();
    }
    
    
    // METHOD DELETE user
    public function deleteUser($user_id)
    {
        // user_id recovery 
        $user = (new User($this->getDB()))->findById($user_id);
        $user_id = $user -> id;
        $delete_user = (new User($this->getDB()))->destroy($user_id);
        
        $this -> logout();
    } 
}