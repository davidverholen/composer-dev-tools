<?php
/**
 * Config.php
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
 * Class Config
 *
 * @category davidverholen_composer-dev-tools
 * @package  DavidVerholen\Composer\DevTools
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
class Config extends BaseConfig
{
    const CONFIG_BASE = 'dev-tools';
    const CONFIG_UPDATE_REMOTES = 'update-remotes';
    const CONFIG_REMOTE_USER = 'user';
    const CONFIG_REMOTE_PASS = 'pw';
    const CONFIG_REMOTE_HOST = 'host';
    const CONFIG_REMOTE_PORT = 'port';
    const CONFIG_REMOTE_SCHEME = 'scheme';
    const CONFIG_REMOTE_PATH = 'path';

    /**
     * getRemotes
     *
     * @return mixed
     */
    public function getRemoteUpdates()
    {
        return $this->getConfig(self::CONFIG_UPDATE_REMOTES, []);
    }

    /**
     * getRemoteUpdate
     *
     * @param $host
     *
     * @return array|null
     */
    public function getRemoteUpdate($host)
    {
        return $this->getSubConfig(
            $this->getRemoteUpdates(),
            $host,
            null
        );
    }

    /**
     * getBaseConfigKey
     *
     * @return string
     */
    protected function getBaseConfigKey()
    {
        return self::CONFIG_BASE;
    }
}
