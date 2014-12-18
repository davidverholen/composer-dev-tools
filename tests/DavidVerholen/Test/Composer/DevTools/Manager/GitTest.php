<?php
 /**
 * GitTest.php
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
use DavidVerholen\Composer\DevTools\Manager\Git;
use DavidVerholen\Git\Remote;
use DavidVerholen\Git\Repository;
use DavidVerholen\Test\Composer\DevTools\BaseTest;

/**
 * Class GitTest
 *
 * @category davidverholen_composer-dev-tools
 * @package  DavidVerholen\Test\Composer\DevTools\Manager
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
class GitTest extends BaseTest
{
    /**
     * testUpdateRemotes
     *
     * @param $extra
     *
     * @return void
     *
     * @dataProvider updateRemotesTestDataProvider
     */
    public function testUpdateRemotes($extra)
    {
        $packageDir = $this->fsUrl(['vendor', 'package']);
        Config::init($this->getDummyComposer($extra), $this->getDummyIO());
        Git::init($this->getDummyComposer($extra), $this->getDummyIO());

        $package = $this->getDummyPackage();
        $package->setTargetDir($packageDir);

        $repo = new Repository($packageDir);
        $repo->init();

        $repo->addRemote(Remote::createFromUrlParts([
            'scheme' => 'http',
            'host' => 'git.brandung.de',
            'path' => '/test/repo'
        ]));

        Git::getInstance()->updateRemotes($package);

        $this->assertEquals(
            'scm.brandung.de',
            $repo->getRemote()->getHost()
        );
    }

    public function updateRemotesTestDataProvider()
    {
        return [
            [
                [
                    'dev-tools' => [
                        'update-remotes' => [
                            'git.brandung.de' => [
                                'host' => 'scm.brandung.de',
                                'user' => 'testuser',
                                'pw'   => 'testpw'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
