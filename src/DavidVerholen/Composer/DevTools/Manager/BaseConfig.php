<?php
/**
 * BaseConfig.php
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

/**
 * Class BaseConfig
 *
 * @category davidverholen_composer-dev-tools
 * @package  DavidVerholen\Composer\DevTools\Manager
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
abstract class BaseConfig extends BaseManager
{
    /**
     * @var array
     */
    private $extra;

    /**
     * initInstance
     *
     * @return mixed
     */
    protected function initInstance()
    {
        $this->extra = $this->getComposer()->getPackage()->getExtra();
    }

    /**
     * getExtraConfig
     *
     * @param $key
     *
     * @return array
     */
    private function getExtraConfig($key)
    {
        return $this->getSubConfig($this->getExtra(), $key, []);
    }

    /**
     * getConfig
     *
     * @param $key
     * @param $default
     *
     * @return mixed
     */
    protected function getConfig($key, $default)
    {
        return $this->getSubConfig(
            $this->getExtraConfig($this->getBaseConfigKey()),
            $key,
            $default
        );
    }

    /**
     * getSubConfig
     *
     * @param      $array
     * @param      $key
     * @param null $default
     *
     * @return mixed
     */
    protected function getSubConfig($array, $key, $default = null)
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    /**
     * getBaseConfigKey
     *
     * @return string
     */
    abstract protected function getBaseConfigKey();

    /**
     * getExtra
     *
     * @return array
     */
    private function getExtra()
    {
        return $this->extra;
    }
}
