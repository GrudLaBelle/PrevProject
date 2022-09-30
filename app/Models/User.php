<?php

namespace App\Models;

class User extends Model {

    protected $table = 'user';
    protected $ref_table = 'role';
    
    // METHODS SELECT
    public function findByEmail(string $email): Model
    {
        return $this->query("SELECT * FROM {$this->table} WHERE email = ?", [$email], true);
    }
    
     public function existsByEmail(string $email)
    {
        return $this->query("SELECT EXISTS(SELECT * FROM {$this->table} WHERE email = ?) as exists_user", [$email], true);
    }
}
