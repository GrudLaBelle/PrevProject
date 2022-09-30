<?php

namespace App\Models;

class NationalStat extends Model {

    protected $table = 'national_stat';

    // METHOD SELECT
    public function findNationalStatByApeCode(string $ape_code): Model | bool
    {
        return $this->query("SELECT * FROM {$this->table} WHERE ape_code = ?", [$ape_code], true);
    }
    
}
