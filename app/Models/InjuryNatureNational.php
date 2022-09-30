<?php

namespace App\Models;

class InjuryNatureNational extends DetailedStat {

    // linking table and reference table referencing
    protected $table = 'injury_nature_national';
    protected $ref_table = 'injury_nature';
    protected $ref_key = 'injury_nature_id';
    
}