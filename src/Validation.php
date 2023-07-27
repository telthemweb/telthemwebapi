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

class Validation 
{
    
    public function validate(array $rules)
    {
        $alerts = [];
        foreach ($rules as $inputName => $rule)
        {
            $rulesArray = explode('|', $rule);
            foreach ($rulesArray as $r)
            {
                $rArray = explode(':', $r);
                $rAction = $rArray[0];
                $rParam = $rArray[1];
                $isValid = $this->$rAction($inputName, $rParam);

                if(isset($isValid) && $isValid != false)
                {
                    array_push($alerts, $isValid);
                }
            }
        }
        if($this->status == false)
        {
            $_SESSION['alert-validation'] = $alerts;
            header('location: '.$_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}