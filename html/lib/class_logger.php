<?php

/*
 * This is the property of Total Gas & Power Ltd.
 * 
 * Copyright 2017
 */
include_once 'includes/errorCodes.php';

/**
 * Description of class_logger
 *
 * @author ecommerce
 */
class logger 
{
    /* class variables */
    protected $logLevel;    /* used to set the level of logging. */ 
    protected $showSQL;     /* boolean used to display sql being run in DEBUG */
    /*
     * public methods
     */
    
    /**
     * Sets the level of logging used. If a log message with a lower level 
     * called it will be ignored.
     * @param int $level the level of logging from 1 = DEBUG to 5 = CRITICAL
     *                   NOTE: the levels are defined in errorCodes.php for ease
     *                         of use.
     */
    public function setLogLevel(int $level = WARNING) 
    {
        /* initialise variables */
        (int) $this->logLevel = 0;
        
        if ($level < DEBUG or $level > CRITICAL) {
            /* invalid log level set - set a default to INFO and log it */
            $this->logLevel = INFO;
            $mess = sprintf("level of %d is outside allowed range of %d to %d. "
                    . "Setting log level to default %d",
                    $level, DEBUG, CRITICAL, INFO);
            $this->log(INFO, 'setLogLevel', $mess);
        } else {
            $this->logLevel = $level;
        }
        
        /* if in DEBUG mode we show the sql statements being run */
        if ($level == DEBUG) {
            $this->showSQL = TRUE;
        } else {
            $this->showSQL = FALSE;
        }
    }
    
    /*
     * private methods
     */
    
    /**
     * Used to record any error messages. When in production it should write to
     * a log file but in development will display messages on the screen.
     * @param int $severity the type of log message ranging from DEBUG (1) to 
     *                      CRITICAL (5) if the log level is set to a higher 
     *                      value than the severity supplied then no log message
     *                      is printed.
     * @param string $method the name of the method that made the log call. Very
     *                       useful when tracking down errors.
     * @param string $message the message to store in the log file.
     */
    protected function log(int $severity, string $method, string $message)
    {
        (array) $codes = ['', 'DEBUG', 'INFO', 'WARNING', 'ERROR', 'CRITICAL'];
        
        if ($this->logLevel <= $severity) {
            echo '<br>' . $codes[$severity] . ': in ' . $method . ': ' . 
                    $message . "\n";
        }        
    } 
}
