<?php

namespace App\Models;

class DetailedStat extends Model {

    protected $table;
    protected $ref_table;
    protected $ref_key;
    
    // METHODS SELECT
    public function findNameAndNumberByNationalStatId(int $national_stat_id): array
    {
        return $this->query("SELECT 
                                {$this->ref_table}.id, {$this->ref_table}.name, {$this->table}.number, 
                                {$this->table}.national_stat_id
                            FROM 
                                {$this->table},
                                {$this->ref_table} 
                            WHERE 
                                {$this->table}.national_stat_id = ?
                                AND {$this->ref_table}.id = {$this->table}.{$this->ref_key}"
                            , [$national_stat_id],null);
    }
    
    public function findNameAndNumberByEnterpriseStatId(int $enterprise_stat_id): array
    {
        return $this->query("SELECT 
                                {$this->ref_table}.id, {$this->ref_table}.name, {$this->table}.number, 
                                {$this->table}.enterprise_stat_id
                            FROM 
                                {$this->table},
                                {$this->ref_table} 
                            WHERE 
                                {$this->table}.enterprise_stat_id = ?
                                AND {$this->ref_table}.id = {$this->table}.{$this->ref_key}"
                            , [$enterprise_stat_id],null);
    }
    
    public function findDefaultNamesAndDefaultNumbers(): array
    {
        return $this->query("SELECT 
                                {$this->ref_table}.id, {$this->ref_table}.name, 0 as number, 
                                null as enterprise_stat_id
                            FROM 
                                {$this->ref_table}"
                            ,null,null);
    }
    
    // METHOD UPDATE
      public function updateByRefIdAndEnterpriseStatId(int $ref_id,int $enterprise_stat_id, array $data, ?array $relations = null)
    {
        $sqlRequestPart = "";
        $i = 1;
    
        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? "" : ', ';
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
            $i++;
        }
    
        $data['enterprise_stat_id'] = $enterprise_stat_id;
        $data['ref_id'] = $ref_id;
    
        return $this->query("UPDATE {$this->table} SET {$sqlRequestPart} WHERE enterprise_stat_id = :enterprise_stat_id AND {$this->ref_key} = :ref_id ", $data);
    }
}
