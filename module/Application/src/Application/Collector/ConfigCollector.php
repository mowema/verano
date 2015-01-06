<?php
namespace Application\Collector;

// use ZendDeveloperTools\Collector\AbstractCollector;


use Zend\Mvc\MvcEvent;
/**
 * Collector to be used in ZendDeveloperTools to record and display personal information
 *
 */
class ConfigCollector extends \ZendDeveloperTools\Collector\AbstractCollector
{
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'application_configs';
    }

    /**
     * {@inheritDoc}
     */
    public function getPriority()
    {
        return 10;
    }

    /**
     * {@inheritDoc}
     */
    public function collect(MvcEvent $mvcEvent)
    {
        $date = new \DateTime();

        $this->data = array(
            'environment' => ucfirst(getenv('APPLICATION_ENV') ?: 'production'),
            'timezone' => $date->getTimezone()->getName(),
            'defaultlocale' => '1',//\Locale::getDefault(),
            'request' => $mvcEvent->getRequest()
        );
    }

    /**
     * Returns the environment
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->data['environment'];
    }

    /**
     * Returns the timezone
     *
     * @return string
     */
    public function getTimeZone()
    {
        return $this->data['timezone'];
    }

    /**
     * Returns the default locale
     *
     * @return string
     */
    public function getDefaultLocale()
    {
        return $this->data['defaultlocale'];
    }
    
     /**
     * Returns Zend\Http\PhpEnvironment\Request
     *
     * @return object
     */
    public function getRequest()
    {
        return $this->data['request'];
    }
}