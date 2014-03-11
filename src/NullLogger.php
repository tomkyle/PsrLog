<?php
/**
 * This file is part of tomkyle/psr/log
 *
 * @author Carsten Witt <tomkyle@posteo.de>
 */
namespace tomkyle\Psr\Log;


use \Psr\Log\LoggerInterface;


/**
 * NullLogger
 *
 * A logger instance for a Null-Logger.
 *
 * @author Carsten Witt <tomkyle@posteo.de>
 */
class NullLogger extends LogAbstract implements LoggerInterface
{

    public $threshold = 0;


    /**
     * Holds the singleton instance
     * @var \tomkyle\Psr\Log\NullLogger
     */
    protected static $instance;


    /**
     * Singleton factory
     * @return \tomkyle\Psr\Log\NullLogger
     * @uses   $instance
     */
    public static function getInstance() {
        if (!(static::$instance instanceof static)) {
            static::$instance = new static();
        }
        return static::$instance;
    }



    /**
     * Ds nthng.
     */
    public function log($level, $message, array $context = array())
    {
    }


    /**
     * Ds nthng.
     */
    public function emergency($message, array $context = array())
    {
    }


    /**
     * Ds nthng.
     */
    public function alert($message, array $context = array())
    {
    }


    /**
     * Ds nthng.
     */
    public function critical($message, array $context = array())
    {
    }

    /**
     * Ds nthng.
     */
    public function error($message, array $context = array())
    {
    }

    /**
     * Ds nthng.
     */
    public function warning($message, array $context = array())
    {
    }

    /**
     * Ds nthng.
     */
    public function notice($message, array $context = array())
    {
    }

    /**
     * Ds nthng.
     */
    public function info($message, array $context = array())
    {
    }

    /**
     * Ds nthng.
     */
    public function debug($message, array $context = array())
    {
    }


}
