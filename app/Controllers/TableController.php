<?php

namespace App\Controllers;


use App\Models\InjuryNatureNational;
use App\Models\InjuryLocationNational;
use App\Models\RiskNational;
use App\Models\NationalStat;
use App\Models\InjuryNatureEnterprise;
use App\Models\InjuryLocationEnterprise;
use App\Models\RiskEnterprise;
use App\Models\EnterpriseStat;
use App\Models\Enterprise;
use App\Models\User;
use App\Exception\NotFoundException;
use App\Models\FormController;

class TableController extends Controller 
{
    // method of completing the comparative table 
    public function showTable(int $user_id)
    {
        $this->isAuthorized($user_id);
        // user_id recovery for enterprise data display 
        $user = (new User($this->getDB()))->findById($user_id);
        $user_id = $user->id;        
        
        // recovery of company data in DB for a user 
        $enterprise = (new Enterprise($this->getDB()))->findEnterpriseByUserId($user_id);
        $enterprise_id = $enterprise -> id;
        $enterprise_stat = (new EnterpriseStat($this->getDB()))->findEnterpriseStatByEnterpriseId($enterprise_id);
        $enterprise_stat_id = $enterprise_stat -> id;
        $enterprise_stat_ape_code = $enterprise_stat -> ape_code;
        $injury_nature_enterprise = (new InjuryNatureEnterprise($this->getDB()))->findNameAndNumberByEnterpriseStatId($enterprise_stat_id);
        $injury_location_enterprise = (new InjuryLocationEnterprise($this->getDB()))->findNameAndNumberByEnterpriseStatId($enterprise_stat_id);
        $risk_enterprise = (new RiskEnterprise($this->getDB()))->findNameAndNumberByEnterpriseStatId($enterprise_stat_id);
        
        // retrieve the ape code from the enterprise file to search for the corresponding national data in DB
        $national_ape_code = $enterprise_stat_ape_code;
        
        $national_stat = (new NationalStat($this->getDB()))->findNationalStatByApeCode($national_ape_code);
        // condition in case of absence of national APE code
        if($national_stat) 
        {
            $national_stat_id = $national_stat -> id;
            $injury_nature_national = (new InjuryNatureNational($this->getDB()))->findNameAndNumberByNationalStatId($national_stat_id);
            $injury_location_national = (new InjuryLocationNational($this->getDB()))->findNameAndNumberByNationalStatId($national_stat_id);
            $risk_national = (new RiskNational($this->getDB()))->findNameAndNumberByNationalStatId($national_stat_id);
            
            $detail_stat_enterprise_types = []; 
            $detail_stat_enterprise_types['Nature de la lésion'] = $injury_nature_enterprise;
            $detail_stat_enterprise_types['Siège de la lésion'] = $injury_location_enterprise;
            $detail_stat_enterprise_types['Nature du risque'] = $risk_enterprise;
            
            $detail_stat_national_types = [];
            $detail_stat_national_types['Nature de la lésion'] = $injury_nature_national;
            $detail_stat_national_types['Siège de la lésion'] = $injury_location_national;
            $detail_stat_national_types['Nature du risque'] = $risk_national;
        } else
        {
            $info = "Données indisponibles, il n'existe pas de code APE référencé.";
            return $this->view('form.enterprise', compact('user', 'enterprise', 'enterprise_stat', 'injury_nature_enterprise', 'injury_location_enterprise', 'risk_enterprise', 'info'));
        }
    
        $detail_stat = [];
        foreach($detail_stat_enterprise_types as $k => $stat_enterprise_types )
        {
            $stat_national_types = $detail_stat_national_types[$k];
            
            $detail_stats_types = [];
            foreach($stat_enterprise_types as $detail_stat_enterprise_type) {
                $detail_stat_national_type = array_filter($stat_national_types, function($v) use($detail_stat_enterprise_type)
                {
                    return $v->id == $detail_stat_enterprise_type->id;
                });        
                $newdata = [];
                $newdata['id'] = $detail_stat_enterprise_type->id;
                $newdata['name'] = $detail_stat_enterprise_type->name;
                $newdata['numberE'] = $detail_stat_enterprise_type->number;
                $newdata['numberN'] = current($detail_stat_national_type)->number;
                array_push($detail_stats_types, $newdata);
            }
            $detail_stat[$k] = $detail_stats_types;
        }
         return $this->view('table.comparison_table', compact('user', 'enterprise', 'enterprise_stat', 'national_stat', 'detail_stat'));
    }    
}