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
namespace Inno\Telthemweb\Database;
use Illuminate\Database\Capsule\Manager as Capsule;
class Database extends Capsule{
    public function __construct()
    {
        parent::__construct();

        $this->connect();
        $this->setAsGlobal();
        $this->bootEloquent();
    }

    public function connect()
    {
        //this should come from app config
        $this->addConnection([
            'driver'    => $this->config('DB_DRIVER', 'mysql'),
            'host'      => $this->config('HOST', 'localhost'),
            'database'  => $this->config('DB_NAME', 'msu_fraud'),
            'username'  => $this->config('DB_USERNAME', 'root'),
            'password'  => $this->config('DB_PASSWORD', ''),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
    }

    function config($key, $default = null)
    {
        return getenv($key) ? getenv($key) : $default;
    }
}