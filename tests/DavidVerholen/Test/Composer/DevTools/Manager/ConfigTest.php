<?php
/**
 * ConfigTest.php
 *
 * PHP Version 5
 *
 * @category davidverholen_composer-dev-tools
 * @package  davidverholen_composer-dev-tools
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */

namespace DavidVerholen\Test\Composer\DevTools\Manager;

use DavidVerholen\Composer\DevTools\Manager\Config;
use DavidVerholen\Test\Composer\DevTools\BaseTest;

/**
 * Class ConfigTest
 *
 * @category davidverholen_composer-dev-tools
 * @package  ${NAMESPACE}
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
class ConfigTest extends BaseTest
{
    /**
     * testGetRemoteUpdates
     *
     * @param $extra
     *
     * @return void
     *
     * @dataProvider extraConfigDataProvider
     */
    public function testGetRemoteUpdates($extra)
    {
        Config::init($this->getDummyComposer($extra), $this->getDummyIO());
        $this->assertEquals(
            $extra[Config::CONFIG_BASE][Config::CONFIG_UPDATE_REMOTES],
            Config::getInstance()->getRemoteUpdates()
        );
    }

    /**
     * testGetRemoteUpdate
     *
     * @param $extra
     *
     * @return void
     *
     * @dataProvider extraConfigDataProvider
     */
    public function testGetRemoteUpdate($extra)
    {
        Config::init($this->getDummyComposer($extra), $this->getDummyIO());
        $updateRemotes
            = $extra[Config::CONFIG_BASE][Config::CONFIG_UPDATE_REMOTES];
        foreach ($updateRemotes as $host => $remote) {
            $this->assertEquals(
                $remote,
                Config::getInstance()->getRemoteUpdate($host)
            );
        }
    }

    /**
     * testRemoteNotFound
     *
     * @param $extra
     *
     * @return void
     *
     * @dataProvider extraConfigDataProvider
     */
    public function testRemoteNotFound($extra)
    {
        Config::init($this->getDummyComposer($extra), $this->getDummyIO());
        $this->assertNull(
            Config::getInstance()->getRemoteUpdate('this.does.not.exist')
        );
    }
}
