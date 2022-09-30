<?php

namespace App\Models;

class RiskNational extends DetailedStat {

    // linking table and reference table referencing
    protected $table = 'risk_national';
    protected $ref_table = 'risk';
    protected $ref_key = 'risk_id';

}
