<?php
/**
 * Git.php
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

use Composer\Package\Package;
use DavidVerholen\Git\Remote;
use DavidVerholen\Git\Repository;

/**
 * Class Git
 *
 * @category davidverholen_composer-dev-tools
 * @package  DavidVerholen\Composer\DevTools\Manager
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
class Git extends BaseManager
{
    /**
     * initInstance
     *
     * @return mixed
     */
    protected function initInstance()
    {
        // TODO: Implement initInstance() method.
    }

    /**
     * updateRemotes
     *
     * @param Package $package
     *
     * @return void
     */
    public function updateRemotes(Package $package)
    {
        $git = new Repository($package->getTargetDir());
        if (!$git->isGitRepository()) {
            return;
        }

        foreach ($git->getRemotes() as $remote) {
            $remoteUpdate = Config::getInstance()
                ->getRemoteUpdate($remote->getHost());

            if (null !== $remoteUpdate) {
                $git->setRemote(Remote::createFromUrlParts([
                        'scheme' => $this->getIfIsset($remoteUpdate, Config::CONFIG_REMOTE_SCHEME),
                        'user' => $this->getIfIsset($remoteUpdate, Config::CONFIG_REMOTE_USER),
                        'pass' => $this->getIfIsset($remoteUpdate, Config::CONFIG_REMOTE_PASS),
                        'host' => $this->getIfIsset($remoteUpdate, Config::CONFIG_REMOTE_HOST),
                        'port' => $this->getIfIsset($remoteUpdate, Config::CONFIG_REMOTE_PORT),
                        'path' => $this->getIfIsset($remoteUpdate, Config::CONFIG_REMOTE_PATH)
                ], $remote->getName()), $remote->getName());
            }
        }
    }

    /**
     * getIfIsset
     *
     * @param $array
     * @param $key
     *
     * @return string
     */
    protected function getIfIsset($array, $key)
    {
        return isset($array[$key]) ? $array[$key] : null;
    }
}
