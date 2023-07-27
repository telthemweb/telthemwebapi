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
use Symfony\Component\Filesystem\Filesystem;

class File
{
    public function getFileSystem()
    {
        return new Filesystem();
    }
   
}