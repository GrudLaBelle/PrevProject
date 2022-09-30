<?php

namespace App\Models;

class RiskEnterprise extends DetailedStat {

    // linking table and reference table referencing
    protected $table = 'risk_enterprise';
    protected $ref_table = 'risk';
    protected $ref_key = 'risk_id';

}
