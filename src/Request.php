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

class Request 
{
    public $status = true;

   

    public function input($inputName)
    {
        if(isset($_POST[$inputName]))
            return $_POST[$inputName];
    }

    public function fileinput($inputName)
    {
        if(isset($_FILES[$inputName]))
            return $_FILES[$inputName]['name'];
    }

    public function filetempinput($inputName)
    {
        if(isset($_FILES[$inputName]))
            return $_FILES[$inputName]['tmp_name'];
    }

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

    public function required($inputName, $param=0)
    {
        if(!isset($_POST[$inputName]) || empty($_POST[$inputName]))
        {
            $this->status = false;
            return 'The Field '.$inputName.' is required.';
        }
    }

    public function max($inputName, $max)
    {
        if($max < strlen($_POST[$inputName]))
        {
            $this->status = false;
            return 'The Field  '.$inputName.' shouldn\'t have more than '.$max.' characters.';
        } else {
            return false;
        }
    }

    public function min($inputName, $min)
    {
        if($min > strlen($_POST[$inputName]))
        {
            $this->status = false;
            return 'The Field  '.$inputName.' shouldn\'t have more than '.$min.' characters.';
        }  else {
            return false;
        }
    }

    public function datatype($inputName, $type)
    {
        if($type != gettype($_POST[$inputName]))
        {
            $this->status = false;
            return 'The Field  '.$inputName.' must be of type '.$type.'.';
        }  else {
            return false;
        }
    }
}