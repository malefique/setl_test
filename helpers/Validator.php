<?php

namespace helpers;

class Validator
{
    protected $supportedTypes = ['string', 'int', 'email'];

    protected $errors = [];

    protected $checkedFields = [];

    public function __construct(array $validationMap, array $data)
    {
        $this->validationMap = $validationMap;
        $this->data = $data;
        return $this;
    }

    public function validate()
    {
        foreach($this->validationMap as $key => $params)
        {
            switch ($params[0])
            {
                case 'int':
                    $this->validateInteger($key, $this->data[$key],$params[1], $params[2]);
                    break;
                case 'email':
                    $this->validateEmail($key, $this->data[$key],$params[1], $params[2]);
                    break;
                default:
                    $this->validateString($key, $this->data[$key],$params[1], $params[2]);
                    break;
            }
        }

        return (empty($this->errors)? [true, $this->checkedFields ]: [false, $this->errors]);
    }

    protected function validateString(string $key, string $string, array $length, bool $required)
    {
        $len = mb_strlen($string);
        if($length[0] <= $len && $length[1] >= $len)
        {
            $this->checkedFields[$key] = htmlspecialchars($string);
        }
        elseif($required)
        {
            $this->errors[$key] = "Error with key {$key}, required, length from {$length[0]} to {$length[1]}";
        }
    }

    protected function validateInteger(string $key, int $int, array $length, bool $required)
    {
        $int = intval($int);
        if($length[0] <= $int && $length[1] >= $int)
        {
            $this->checkedFields[$key] = $int;
        }
        elseif($required)
        {
            $this->errors[$key] = "Error with key {$key}, required, number interval from {$length[0]} to {$length[1]}";
        }
    }

    protected function validateEmail(string $key, string $email, array $length, bool $required)
    {
        $len = mb_strlen($email);
        if($length[0] <= $len && $length[1] >= $len && preg_match('	
/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD',$email) === 1)
        {
            $this->checkedFields[$key] = $email;
        }
        elseif($required)
        {
            $this->errors[$key] = "Error with key {$key}, required, length from {$length[0]} to {$length[1]}";
        }
    }
}