<?php

namespace App\Models;

class InjuryNatureEnterprise extends DetailedStat {

    // linking table and reference table referencing
    protected $table = 'injury_nature_enterprise';
    protected $ref_table = 'injury_nature';
    protected $ref_key = 'injury_nature_id';
    
}
