<?php
/**
 * BaseTest.php
 *
 * PHP Version 5
 *
 * @category davidverholen_composer-dev-tools
 * @package  davidverholen_composer-dev-tools
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */

namespace DavidVerholen\Test\Composer\DevTools;

use Composer\Composer;
use Composer\Package\Package;
use Composer\Package\RootPackage;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class BaseTest
 *
 * @category davidverholen_composer-dev-tools
 * @package  DavidVerholen\Test\Composer\DevTools
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
abstract class BaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    protected function getDummyComposer($extra = [])
    {
        $composer = new Composer();
        $composer->setPackage($this->getDummyRootPackage(
            'root-package',
            '1.0.0',
            $extra
        ));

        return $composer;
    }

    protected function getDummyPackage(
        $name = 'test',
        $version = '1.0.0',
        $extra = []
    ) {
        $rootPackage = new Package($name, $version, $version);
        $rootPackage->setExtra($extra);
        return $rootPackage;
    }

    protected function getDummyRootPackage(
        $name = 'test',
        $version = '1.0.0',
        $extra = []
    ) {
        $rootPackage = new RootPackage($name, $version, $version);
        $rootPackage->setExtra($extra);
        return $rootPackage;
    }

    protected function getDummyIO()
    {
        return new DummyIO();
    }

    public function extraConfigDataProvider()
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
                            ],
                            'github.de'       => [
                                'host' => 'github.com'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * fsUrl
     *
     * @param array $urlParts
     *
     * @return string
     */
    protected function fsUrl(array $urlParts)
    {
        array_map([$this, 'trimUrlPart'], $urlParts);
        array_unshift($urlParts, TEST_BUILD_DIR);
        return implode(
            DIRECTORY_SEPARATOR,
            $urlParts
        );
    }
    /**
     * getFilesystem
     *
     * @return Filesystem
     */
    protected function getFilesystem()
    {
        if (null === $this->filesystem) {
            $this->filesystem = new Filesystem();
        }
        return $this->filesystem;
    }
    /**
     * trimUrlPart
     *
     * @param $url
     *
     * @return string
     */
    public function trimUrlPart($url)
    {
        return trim(trim($url), '/\\');
    }

    protected function setUp()
    {
        parent::setUp();
        $this->getFilesystem()->remove(TEST_BUILD_DIR);
        $this->getFilesystem()->mkdir(TEST_BUILD_DIR);
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->getFilesystem()->remove(TEST_BUILD_DIR);
    }
}
