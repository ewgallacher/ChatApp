<?php namespace ChatApp;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Database {

    protected $capsule;

    public function __construct()
    {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'chat',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        // Set the event dispatcher used by Eloquent models... (optional)
        $this->capsule->setEventDispatcher(new Dispatcher(new Container));

        // Make this Capsule instance available globally via static methods... (optional)
        $this->capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->capsule->bootEloquent();

    }



    public function addRecord( $table , Array $data )
    {
        $this->capsule->table( $table )->insert( $data );
    }


    public function getAllRecords( $table )
    {
        return $this->capsule->table($table)->select('*')->orderBy('id' , 'DESC')->get();
    }


    public function clearAllRecords($table)
    {
        $this->capsule->table($table)->delete();
    }



}

