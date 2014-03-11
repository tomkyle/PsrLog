<?php
/**
 * This file is part of tomkyle/psr/log
 *
 * @author Carsten Witt <tomkyle@posteo.de>
 */
namespace tomkyle\Psr\Log;



/**
 * LoggerCommonMethodsTrait
 *
 * Common logger methods for objects implementing `\Psr\Log\LoggerAwareInterface`
 * and use `LoggerAwareTrait`
 *
 * @author Carsten Witt <tomkyle@posteo.de>
 */
trait LoggerCommonMethodsTrait
{

    /**
     * @uses $logger
     * @uses \Psr\Log\LoggerInterface::emergency()
     */
    public function emergency($message, $context = array())
    {
        if ($this->logger and $this->logger->emergency($message, $context));
        return $this;
    }

    /**
     * @uses $logger
     * @uses \Psr\Log\LoggerInterface::alert()
     */
    public function alert($message, $context = array())
    {
        if ($this->logger and $this->logger->alert($message, $context));
        return $this;
    }

    /**
     * @uses $logger
     * @uses \Psr\Log\LoggerInterface::critical()
     */
    public function critical($message, $context = array())
    {
        if ($this->logger and $this->logger->critical($message, $context));
        return $this;
    }


    /**
     * @uses $logger
     * @uses \Psr\Log\LoggerInterface::error()
     */
    public function error($message, $context = array())
    {
        if ($this->logger and $this->logger->error($message, $context));
        return $this;
    }

    /**
     * @uses $logger
     * @uses \Psr\Log\LoggerInterface::warning()
     */
    public function warning($message, $context = array())
    {
        if ($this->logger and $this->logger->warning($message, $context));
        return $this;
    }

    /**
     * @uses $logger
     * @uses \Psr\Log\LoggerInterface::notice()
     */
    public function notice($message, $context = array())
    {
        if ($this->logger and $this->logger->notice($message, $context));
        return $this;
    }



    /**
     * @uses $logger
     * @uses \Psr\Log\LoggerInterface::info()
     */
    public function info($message, $context = array())
    {
        if ($this->logger and $this->logger->info($message, $context));
        return $this;
    }

    /**
     * @uses $logger
     * @uses \Psr\Log\LoggerInterface::debug()
     */
    public function debug($message, $context = array())
    {
        if ($this->logger and $this->logger->debug($message, $context));
        return $this;
    }

    /**
     * @uses $logger
     * @uses \Psr\Log\LoggerInterface::debug()
     */
    public function log($key, $message, $context = array())
    {
        if ($this->logger and $this->logger->log($key, $message, $context));
        return $this;
    }



}
