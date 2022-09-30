<?php

namespace App\Models;

class EnterpriseStat extends Model {

    protected $table = 'enterprise_stat';

    // METHOD SELECT
    public function findEnterpriseStatByEnterpriseId(int $enterprise_id): Model
    {
        return $this->query("SELECT * FROM {$this->table} WHERE enterprise_id = ?", [$enterprise_id], true);
    }
    
}
