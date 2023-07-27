<?php
namespace Inno\Telthemweb;


class Configuration
{
     
    public static function redirection($path){
       return header("Location: " ."/".$path);
    }
    
}