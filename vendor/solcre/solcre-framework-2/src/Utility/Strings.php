<?php

namespace Solcre\SolcreFramework2\Utility;

class Strings
{

    public static function bcryptPassword($password, $cost = 10)
    {
        $salt = substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22);
        $hash = crypt($password, '$2a$' . $cost . '$' . $salt);
        return $hash;
    }

    public static function verifyBcryptPassword($password, $existingBscrypt)
    {
        $hash = crypt($password, $existingBscrypt);
        return ($hash === $existingBscrypt);
    }

    public static function isBcryptPassword($bscryptPassword)
    {
        return (strlen($bscryptPassword) === 60);
    }

    public static function generateRandomPassword($lenght)
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!#$%&/()?~[]";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $lenght; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public static function generateAlphaNumericString($length = 8)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }
        return strtoupper($string);
    }

    /**
     * Returns a default value if $variable is empty
     *
     * @param string $variable The variable to check if empty.
     * @param string $default  The default value if empty.
     *
     * @return String
     */
    public static function default_text($variable, $default)
    {
        return empty($variable) ? $default : $variable;
    }
}
