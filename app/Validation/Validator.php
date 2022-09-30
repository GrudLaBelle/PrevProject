<?php

namespace App\Validation;

class Validator {

    private $data;
    private $errors;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // field validation method
    public function validate(array $rules): ?array
    {
        foreach ($rules as $name => $rulesArray) {
            if (array_key_exists($name, $this->data)) {
                foreach ($rulesArray as $rule) {
                    switch ($rule) {
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        case 'validEmail':
                            $this->validEmail($name, $this->data[$name]);
                            break;
                    }
                }
            }
        }

        return $this->getErrors();
    }

    // verification method completion of the required field
    private function required(string $name, string $value)
    {
        $value = trim($value);

        if(!isset($value) || is_null($value) || empty($value)) 
        {
            $this->errors[$name][] = "Un {$name} est requis.";
        }
    }
    
    // method of checking the validity of the email 
    public function validEmail($name, string $value)
    {
        $validEmail = filter_var($value, FILTER_VALIDATE_EMAIL);
        
        if($validEmail === false)
        {
            $this->errors[$name][] = "L'adresse {$name} n'est pas valide.";
        }
    }
    
    // error accessor method
    private function getErrors(): ?array
    {
        return $this->errors;
    }
}
