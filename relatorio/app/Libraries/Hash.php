<?php

namespace App\Libraries;

class Hash 
{
    // Encrypt user password 
    public static function encrypt($password)
    {
        return md5($password);
    }

    // Check user password with db password

    public static function check($userPassword, $dbUserPassword)
    {
        if(md5($userPassword) == $dbUserPassword)
        {
            return true;
        }

        return false;
    }
}