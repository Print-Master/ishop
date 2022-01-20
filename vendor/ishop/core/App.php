<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02.11.2019
 * Time: 19:38
 */

namespace ishop;


class App
{
    public static $app;
    public function __construct()
    {
    session_start();
    $query = trim($_SERVER['QUERY_STRING'], '/');
//    var_dump($query);

    self::$app = Registry::instance();
    $this -> getParams();
    new ErrorHandler();
    Router::dispatch($query);
    }

    protected function getParams(){
        $params = require_once CONF . '/params.php';
        if (!empty($params)){
            foreach ($params as $key => $value){
                self::$app ->setProperty($key, $value);
            }
        }
    }
}