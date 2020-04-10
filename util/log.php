<?php


namespace util;


class log
{
    protected $fichLog;

    /**
     * log constructor.
     */
    public function __construct()
    {
        $this->fichLog = $_SERVER['DOCUMENT_ROOT']."/logs/prod.log";
    }

    protected function enteteMessage(){
      return "[" . date('d.m.Y h:i:s') . "] " ;
    }
    public function insertErrTexte($mess){
        $message = $this->enteteMessage() . $mess . "\n";
        error_log($message,3,$this->fichLog);
    }

    public function insertErrException(\Exception $e){
        $message = $this->enteteMessage() . $e->getMessage() .  "\n" . $e->getTraceAsString() . "\n";
        error_log($message,3,$this->fichLog);
    }
}