<?php
/*
|--------------------------------------------------------------------------
|            This file is part of the Telthemweb package.
|               
|--------------------------------------------------------------------------
|
|     For the full copyright and license information, please view the LICENSE
|       file that was distributed with this source code.
|
*/
namespace Inno\Telthemweb;

use Inno\Telthemweb\Request;
class Validationlib{
   
    function Validatecard(string $cardnumber):bool{
       $result=false;
        $cardtype = array(
            "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
            "mastercard" => "/^5[1-5][0-9]{14}$/",
            "amex"       => "/^3[47][0-9]{13}$/",
            "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
        );
        
        if (preg_match($cardtype['visa'],$cardnumber))
        {
            $result=true;
        
        }
        else if (preg_match($cardtype['mastercard'],$cardnumber))
        {
            $result=true;
        }
        else if (preg_match($cardtype['amex'],$cardnumber))
        {
            $result=true;
        
        }
        else if (preg_match($cardtype['discover'],$cardnumber))
        {
            $result=true;
        }
        return $result;
    }

   
}