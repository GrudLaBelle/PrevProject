<?php

namespace App\Models;

class Enterprise extends Model {

    protected $table = 'enterprise';
    
    // METHODS SELECT
    public function findEnterpriseByUserId(int $user_id): Model
    {
        return $this->query("SELECT * FROM {$this->table} WHERE user_id = ?", [$user_id], true);
    }
    
     public function existsEnterpriseByUserId(int $user_id): Model
    {
        return $this->query("SELECT EXISTS(SELECT * FROM {$this->table} WHERE user_id = ?) as has_enterprise", [$user_id], true);
    }
    
}
