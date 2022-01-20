<?php

namespace ishop;


class ErrorHandler {

    public function __construct(){
        if(DEBUG){
            error_reporting(-1);
        } else{
            error_reporting(0);
        }

        set_exception_handler([$this, 'exeptionHandler']);
    }

    public function exeptionHandler($exeption){
        $this->logErrors($exeption->getMessage(), $exeption->getFile(), $exeption->getLine());
        $this->displayError('Exseption', $exeption->getMessage(), $exeption->getFile(),
            $exeption->getLine(), $exeption->getCode());
    }

    protected function logErrors($message = '', $file ='', $line = ''){
        error_log("[" . date('Y-m-d H:i:s') . "] 
        Error Message: {$message} | File: {$file} | Line: {$line} \n===============\n",
            3, ROOT . '/tmp/errors.log');
    }

    protected function displayError($errorNo, $errorStr, $errorFile, $errorLine, $responce = 404){
        http_response_code($responce);
        if($responce == 404 && !DEBUG){
            require WWW . '/errors/404.php';
            die;
        }
        if(DEBUG){
            require WWW . '/errors/dev.php';
        } else {
            require WWW . '/errors/prod.php';
        }
        die;
    }
}