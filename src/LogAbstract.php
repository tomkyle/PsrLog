<?php
/**
 * This file is part of tomkyle/psr/log
 *
 * @author Carsten Witt <tomkyle@posteo.de>
 */
namespace tomkyle\Psr\Log;


use \Psr\Log\LogLevel;
use \Psr\Log\LoggerInterface;


/**
 * LogAbstract
 *
 * Abstract logger instance, imlements the PSR-3 Log interface.
 *
 * This logger filters log entries by the error level threshold
 * that is defined in `$threshold`.
 *
 * The message MUST be a string or object implementing __toString().
 *
 * The message MAY contain placeholders in the form: {foo} where foo
 * will be replaced by the context data in key "foo".
 *
 * The context array can contain arbitrary data, the only assumption that
 * can be made by implementors is that if an Exception instance is given
 * to produce a stack trace, it MUST be in a key named "exception".
 *
 * See https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
 * for the full interface specification.
 *
 * @author Carsten Witt <tomkyle@posteo.de>
 */
abstract class LogAbstract implements LoggerInterface
{

/**
 *  Threshold value for logging, bitmask of
 *
 *  - INT_EMERGENCY = 1;
 *  - INT_ALERT     = 2;
 *  - INT_CRITICAL  = 4;
 *  - INT_ERROR     = 8;
 *  - INT_WARNING   = 16;
 *  - INT_NOTICE    = 32;
 *  - INT_INFO      = 64;
 *  - INT_DEBUG     = 128;
 *
 * @var integer
 */
    public $threshold = 255;


    const INT_EMERGENCY     = 1;
    const INT_ALERT         = 2;
    const INT_CRITICAL      = 4;
    const INT_ERROR         = 8;
    const INT_WARNING       = 16;
    const INT_NOTICE        = 32;
    const INT_INFO          = 64;
    const INT_DEBUG         = 128;


//  =======  Configuration API  ==================================


/**
 * @param  int $thr Threshold value
 * @return $this
 * @uses   $threshold;
 */
    public function setThreshold($thr)
    {
        $this->threshold = $thr;
        return $this;
    }


/**
 * @return int
 * @uses   $threshold;
 */
    public function getThreshold()
    {
        return $this->threshold;
    }





//  ==========  Implement Interface LoggerInterface  ==========================


    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    abstract public function log($level, $message, array $context = array());



   /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return null
     *
     * @uses INT_EMERGENCY
     * @uses LogLevel::EMERGENCY
     */
    public function emergency($message, array $context = array())
    {
        if (self::INT_EMERGENCY & $this->threshold)
            $this->log(LogLevel::EMERGENCY, $message, $context);
        return null;
    }


    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return null
     *
     * @uses INT_ALERT
     * @uses LogLevel::ALERT
     */
    public function alert($message, array $context = array())
    {
        if (self::INT_ALERT & $this->threshold)
            $this->log(LogLevel::ALERT, $message, $context);
        return null;
    }


    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return null
     *
     * @uses INT_CRITICAL
     * @uses LogLevel::CRITICAL
     */
    public function critical($message, array $context = array())
    {
        if (self::INT_CRITICAL & $this->threshold)
            $this->log(LogLevel::CRITICAL, $message, $context);
        return null;
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return null
     *
     * @uses INT_ERROR
     * @uses LogLevel::ERROR
     */
    public function error($message, array $context = array())
    {
        if (self::INT_ERROR & $this->threshold)
            $this->log(LogLevel::ERROR, $message, $context);
        return null;
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return null
     *
     * @uses INT_WARNING
     * @uses LogLevel::WARNING
     */
    public function warning($message, array $context = array())
    {
        if (self::INT_WARNING & $this->threshold)
            $this->log(LogLevel::WARNING, $message, $context);
        return null;
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return null
     *
     * @uses INT_NOTICE
     * @uses LogLevel::NOTICE
     */
    public function notice($message, array $context = array())
    {
        if (self::INT_NOTICE & $this->threshold)
            $this->log(LogLevel::NOTICE, $message, $context);
        return null;
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return null
     *
     * @uses INT_INFO
     * @uses LogLevel::INFO
     */
    public function info($message, array $context = array())
    {
        if (self::INT_INFO & $this->threshold)
            $this->log(LogLevel::INFO, $message, $context);
        return null;
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return null
     *
     * @uses INT_DEBUG
     * @uses LogLevel::DEBUG
     */
    public function debug($message, array $context = array())
    {
        if (self::INT_DEBUG & $this->threshold)
            $this->log(LogLevel::DEBUG, $message, $context);
        return null;
    }


//  ========  Helpers  ========================


/**
 * Interpolates context values into the message placeholders.
 *
 * @param  string $message
 * @param  array $context
 * @return string
 *
 * @uses   interpolateException()
 * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
 */
	public function interpolate($message, array $context = array())
	{
      if (is_string($message) and empty($message)) {
        return '[empty string]';
      }


      if ($message instanceOf \Exception) {
        return $this->interpolateException( $message );
      }

	  // build a replacement array with braces around the context keys
	  $replace = array();
	  foreach ($context as $key => $val) {
	      $replace['{' . $key . '}'] = is_string($val)
                                       ? $val
                                       : (  is_null($val)
                                            ? 'NULL'
                                            : ( is_bool($val)
                                                ? ($val ? 'TRUE' : 'FALSE')
                                                : ( is_object($val)
                                                    ? $this->interpolateObject($val)
                                                    : print_r($val, "noecho") // Any other
                                                  )
                                              )
                                          );
	  }

	  // interpolate replacement values into the message and return
	  return strtr($message, $replace);
	}


//  ==========  Helpers  ==============

    /**
     * @param  object $object
     * @return string
     */
    protected function interpolateObject( $object ) {
        return method_exists($object, '__toString')
        ? $object->__toString()
        : get_class( $object );
    }



    /**
     * @param  \Exception $exception
     * @return string
     */
    protected function interpolateException( \Exception $exception ) {
        $rueck = "Exception of class " . get_class($exception) . "\n"
               . "thrown at line " . $exception->getLine() . "\n"
               . "in file " .     $exception->getFile() . "\n\n"

               . "Message: "   . $exception->getMessage()       . "\n\n"
               . "Trace: "    . $exception->getTraceAsString();

        return $rueck;
    }



}
