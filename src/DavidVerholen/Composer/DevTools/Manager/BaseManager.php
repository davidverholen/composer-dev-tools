<?php
/**
 * BaseManager.php
 *
 * PHP Version 5
 *
 * @category davidverholen_composer-dev-tools
 * @package  davidverholen_composer-dev-tools
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */

namespace DavidVerholen\Composer\DevTools\Manager;

use Composer\Composer;
use Composer\IO\IOInterface;

/**
 * Class BaseManager
 *
 * @category davidverholen_composer-dev-tools
 * @package  DavidVerholen\Composer\DevTools\Manager
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
abstract class BaseManager
{
    /**
     * @var self[]
     */
    private static $instances;

    /**
     * @var Composer
     */
    private $composer;

    /**
     * @var IOInterface
     */
    private $io;

    /**
     * @param Composer    $composer
     * @param IOInterface $io
     */
    final private function __construct(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
        $this->initInstance();
    }

    /**
     * initInstance
     *
     * @return mixed
     */
    abstract protected function initInstance();

    /**
     * init
     *
     * @param Composer    $composer
     * @param IOInterface $io
     *
     * @return $this
     */
    final public static function init(Composer $composer, IOInterface $io)
    {
        $class = get_called_class();
        self::$instances[$class] = new $class($composer, $io);
        return self::getInstance();
    }

    /**
     * getInstance
     *
     * @return $this
     */
    final public static function getInstance()
    {
        return self::$instances[get_called_class()];
    }

    /**
     * getComposer
     *
     * @return Composer
     */
    final protected function getComposer()
    {
        return $this->composer;
    }

    /**
     * getIo
     *
     * @return IOInterface
     */
    final protected function getIo()
    {
        return $this->io;
    }
}
