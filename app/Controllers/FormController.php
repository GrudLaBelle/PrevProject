<?php

namespace App\Controllers;


use App\Models\InjuryNatureEnterprise;
use App\Models\InjuryLocationEnterprise;
use App\Models\RiskEnterprise;
use App\Models\EnterpriseStat;
use App\Models\Enterprise;
use App\Models\User;
use App\Exception\NotFoundException;


class FormController extends Controller
{
    // METHOD SELECT
    public function showFormEnterprise(int $user_id)
    {
        // user_id recovery for enterprise data display 
        $this->isAuthorized($user_id);
        $user = (new User($this->getDB()))->findById($user_id);
        $user_id = $user->id;
        
        // management of the existence or absence of company data for a user
        $has_enterprise = (new Enterprise($this->getDB()))->existsEnterpriseByUserId($user_id) -> has_enterprise;
        
        if ($has_enterprise === 0)
        {
            // retrieve default values: ids from the referential table(), names from the referential table(), numbers with the value 0 and enterpirse_stat_id with the value NULL
            $injury_nature_enterprise = (new InjuryNatureEnterprise($this->getDB()))->findDefaultNamesAndDefaultNumbers();
            $injury_location_enterprise = (new InjuryLocationEnterprise($this->getDB()))->findDefaultNamesAndDefaultNumbers();
            $risk_enterprise = (new RiskEnterprise($this->getDB()))->findDefaultNamesAndDefaultNumbers();
            
            return $this->view('form.enterprise',compact('user', 'injury_nature_enterprise', 'injury_location_enterprise', 'risk_enterprise'));
        } else {
            // recovery of enterprise data in DB for a user 
            $enterprise = (new Enterprise($this->getDB()))->findEnterpriseByUserId($user_id);
            $enterprise_id = $enterprise -> id;
            $enterprise_stat = (new EnterpriseStat($this->getDB()))->findEnterpriseStatByEnterpriseId($enterprise_id);
            $enterprise_stat_id = $enterprise_stat -> id;
            $injury_nature_enterprise = (new InjuryNatureEnterprise($this->getDB()))->findNameAndNumberByEnterpriseStatId($enterprise_stat_id);
            $injury_location_enterprise = (new InjuryLocationEnterprise($this->getDB()))->findNameAndNumberByEnterpriseStatId($enterprise_stat_id);
            $risk_enterprise = (new RiskEnterprise($this->getDB()))->findNameAndNumberByEnterpriseStatId($enterprise_stat_id);
       
            return $this->view('form.enterprise', compact('user', 'enterprise', 'enterprise_stat', 'injury_nature_enterprise', 'injury_location_enterprise', 'risk_enterprise'));
        }
    }
    
    // METHOD OF MANAGING FORM BUTTONS
    public function handleForm($id) 
    {
        $this->isAuthorized($id);
        switch ($_REQUEST['btn']) 
        {   
            case 'create':
                $this->createOrUpdateEnterprise($id, true);
                break;
            case 'update':
                $this->createOrUpdateEnterprise($id, false);
                break;
            case 'delete':
                $this->deleteEnterprise($id);
                break;
        };
    }
    
    // CREATE AND UPDATE METHODS factorized
    private function createOrUpdateEnterprise($user_id, bool $create)
    {
            $this->createOrUpdateEnterpriseFromForm($user_id, $create);
            
            $enterprise = (new Enterprise($this->getDB()))->findEnterpriseByUserId($user_id);
            $enterprise_id = $enterprise->id;
        
            $this->createOrUpdateEnterpriseStatFromForm($enterprise_id, $create);
            
            $enterprise_stat = (new EnterpriseStat($this->getDB()))->findEnterpriseStatByEnterpriseId($enterprise_id);
            $enterprise_stat_id = $enterprise_stat->id;
            
            $this->createOrUpdateEnterpriseDetailStatFromForm($enterprise_stat_id, $create);
            
            $this->showFormEnterprise($user_id);
    }
    
    // CREATE or UPDATE COMPANIES (factorized method)
    private function createOrUpdateEnterpriseFromForm($user_id, bool $create) 
    {
        $data = $_POST;

        // addition of user_id and siret keys in $data because absent in the body of the POST request
        
        $data['user_id'] = $user_id;
        // conversion of the 'string' value of the siret key to integer to ensure the correspondence of the typing defined in DB for this field
        $data['siret'] = intval($data['siret']);
        // filtering with the native array_filter function of $data to match the different keys with the different fields of the enterprise table
        $entreprise = array_filter($data, function($k) 
            {
                return $k == 'enterprise_name' || $k == 'siret' || $k == 'user_id';
            }, ARRAY_FILTER_USE_KEY);

        if($create)
        {
            // create a new enterprise in the enterprise table
            $output_save_enterprise = (new Enterprise($this->getDB()))->create($entreprise);
        } else {
            // recovery of the enterprise id
            $enterprise = (new Enterprise($this->getDB()))->findEnterpriseByUserId($user_id);
            $enterprise_id = $enterprise -> id;
            // update of an enterprise in the enterprises table
            $output_update_enterprise = (new Enterprise($this->getDB()))->update($enterprise_id, $entreprise);
        }
    } 
    
    // CREATE or UPDATE ENTERPRISES STATS (factorized method)
    private function createOrUpdateEnterpriseStatFromForm($enterprise_id, bool $create)
    {
        $data = $_POST;

        // addition of enterprise_id key in $data because absent in the body of the POST request
        $data['enterprise_id'] = $enterprise_id;
        // conversion of the 'string' value of the workers_number, accidents_number and year keys to integer to ensure the correspondence of the typing defined in DB for these fields
        $data['workers_number'] = intval($data['workers_number']);
        $data['accidents_number'] = intval($data['accidents_number']);
        $data['index_of_frequency'] = floatval($data['index_of_frequency']);
        $data['year'] = intval($data['year']);
        // filtering with the native array_filter function of $data to match the different keys with the different fields of the tables
        $enterprise_stat = array_filter($data, function($k)
        {
            return $k == 'enterprise_id' || $k == 'ape_code' || $k == 'ape_name' || $k == 'workers_number' || $k == 'accidents_number' || $k == 'index_of_frequency' || $k == 'year';
        }, ARRAY_FILTER_USE_KEY);
        
        if($create)
        {
            // creation of new enterprise_stat in the enterprise_stat table
            $output_save_enterprise_stat = (new EnterpriseStat($this->getDB()))->create($enterprise_stat);
        } else {
            // recovery of the enterprise stat id
            $enterprise_stat_ = (new EnterpriseStat($this->getDB()))->findEnterpriseStatByEnterpriseId($enterprise_id);
            $enterprise_stat_id = $enterprise_stat_ -> id;
            // update of enterprise_stat in the table enterprise_stat
            $output_update_enterprise_stat = (new EnterpriseStat($this->getDB()))->update($enterprise_stat_id, $enterprise_stat);
        }
    }
    
            
    // CREATE or UPDATE THE 3 TYPES OF DETAILED STATS (factorized method)
    private function createOrUpdateEnterpriseDetailStatFromForm($enterprise_stat_id, bool $create)
    {
        $data = $_POST;

        // addition of the key enterprise_stat_id in $data because absent in the body of the POST request
        $data['enterprise_stat_id'] = $enterprise_stat_id;
        
        // data filtering to get enterprise_stat_id
        $detail_stat_enterprise = array_filter($data, function($k)
        {
            return $k == 'enterprise_stat_id';
        }, ARRAY_FILTER_USE_KEY);
        
        // data filtering to get the 18 detail stat
        // $k beginning with injuryNatureEnterprise_
        $detail_stat_types = array_filter($data, function($k)
        {
         return 
            str_starts_with($k, 'injuryNatureEnterprise_') || 
            str_starts_with($k, 'injuryLocationEnterprise_') || 
            str_starts_with($k, 'riskEnterprise_');
        }, ARRAY_FILTER_USE_KEY);
        
        // foreach of the associative array of the 6 filtered "injuryNatureEnterprise_" where the key alias is associated to the number entered in the form
        foreach($detail_stat_types as $detail_stat_type => $number) 
        {
            $split = explode('_', $detail_stat_type);
            
            // definition of the key (corresponding to the field "injury_nature_id", "injury_location_id" and "risk_id" in the tables "injury_nature_enterprise", "injury_nature_enterprise", "risk_enterprise") corresponding to the name in the tables "injury_nature", "injury_location" and "risk"
            // add number values in the "save_injury_nature_enterprise" table
            $detail_stat_enterprise['number'] = intval($number);

            switch($split[0])
            {
                case 'injuryNatureEnterprise':
                    $detail_stat_enterprise['injury_nature_id'] = $split[1];
                    if($create)
                    {
                        // insertion of the detailed stat in the DB
                        $output_save_detail_stat_enterprise = (new InjuryNatureEnterprise($this->getDB()))->create($detail_stat_enterprise);
                        unset($detail_stat_enterprise['injury_nature_id']);
                    } else {
                            
                            $update_detail_stat_enterprise['number'] = intval($number);
                            // update of the detailed stat in the DB
                            $output_update_detail_stat_enterprise = (new InjuryNatureEnterprise($this->getDB()))->updateByRefIdAndEnterpriseStatId( $split[1], $enterprise_stat_id, $update_detail_stat_enterprise);
                    }
                    break;
                case 'injuryLocationEnterprise':
                    $detail_stat_enterprise['injury_location_id'] = $split[1];
                    if($create)
                    {
                        // insertion of the detailed stat in the DB
                        $output_save_detail_stat_enterprise = (new InjuryLocationEnterprise($this->getDB()))->create($detail_stat_enterprise);
                        unset($detail_stat_enterprise['injury_location_id']);
                    } else {
                            // update of the detailed stat in the DB
                            $update_detail_stat_enterprise['number'] = intval($number);
                            $output_update_detail_stat_enterprise = (new InjuryLocationEnterprise($this->getDB()))->updateByRefIdAndEnterpriseStatId( $split[1], $enterprise_stat_id, $update_detail_stat_enterprise);
                    }
                    break;
                case 'riskEnterprise':
                    $detail_stat_enterprise['risk_id'] = $split[1];
                    if($create) 
                    {
                        // insertion of the detailed stat in the DB
                        $output_save_detail_stat_enterprise = (new RiskEnterprise($this->getDB()))->create($detail_stat_enterprise);
                        unset($detail_stat_enterprise['risk_id']);
                    } else {
                        // update of the detailed stat in the DB
                            $update_detail_stat_enterprise['number'] = intval($number);
                            $output_update_detail_stat_enterprise = (new RiskEnterprise($this->getDB()))->updateByRefIdAndEnterpriseStatId( $split[1], $enterprise_stat_id, $update_detail_stat_enterprise);
                    }
                    break;
            }
        }
    }
    
    // METHOD DELETE
    private function deleteEnterprise($user_id)
    {
        // retrieve the user_id for the newly created enterprise
        $enterprise = (new Enterprise($this->getDB()))->findEnterpriseByUserId($user_id);
        $enterprise_id = $enterprise->id;
        $delete_enterprise = (new Enterprise($this->getDB()))->destroy($enterprise_id);
        $this->showFormEnterprise($user_id);
        
        
    }
}
