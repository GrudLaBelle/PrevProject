<?php

namespace App\Models;

class InjuryLocationEnterprise extends DetailedStat {
    // linking table and reference table referencing
    protected $table = 'injury_location_enterprise';
    protected $ref_table = 'injury_location';
    protected $ref_key = 'injury_location_id';
    

}
