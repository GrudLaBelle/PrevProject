<?php

namespace App\Models;

class InjuryLocationNational extends DetailedStat {

    // linking table and reference table referencing
    protected $table = 'injury_location_national';
    protected $ref_table = 'injury_location';
    protected $ref_key = 'injury_location_id';
    
}