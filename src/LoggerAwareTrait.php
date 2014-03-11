<?php
/**
 * This file is part of tomkyle/psr/log
 *
 * @author Carsten Witt <tomkyle@posteo.de>
 */
namespace tomkyle\Psr\Log;

use \Psr\Log\LoggerAwareTrait as BaseLoggerTrait;
use \Psr\Log\LoggerInterface;


/**
 * LoggerAwareTrait
 *
 * Basic Implementation of LoggerAwareInterface, providing fluent interface.
 *
 * This trait provides both setter and getter methods,
 * since the original PSR trait only provides a setter.
 *
 * If No logger is set, a `NullLogger` will be set automagically.
 *
 * @author Carsten Witt <tomkyle@posteo.de>
 */
trait LoggerAwareTrait
{

    use BaseLoggerTrait;


    /**
     * Sets a logger, and provides fluid interface
     *
     * @param LoggerInterface $logger
     * @uses  $logger
     */
    public function setLogger( LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }


    /**
     * Returns the Logger instance.
     * If no logger is set, a NullLogger will be set and returned.
     *
     * @return LoggerInterface
     * @uses   $logger
     * @uses   NullLogger::getInstance()
     */
    public function getLogger()
    {
        if ($this->logger) {
            return $this->logger;
        }
        $this->setLogger( NullLogger::getInstance() );
        return $this->logger;
    }


}
