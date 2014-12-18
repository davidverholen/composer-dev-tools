<?php
/**
 * Plugin.php
 *
 * PHP Version 5
 *
 * @category davidverholen_composer-dev-tools
 * @package  davidverholen_composer-dev-tools
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */

namespace DavidVerholen\Composer\DevTools;

use Composer\Composer;
use Composer\DependencyResolver\Operation\InstallOperation;
use Composer\DependencyResolver\Operation\UpdateOperation;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\PackageEvent;
use Composer\Script\ScriptEvents;
use DavidVerholen\Composer\DevTools\Manager\Config;
use DavidVerholen\Composer\DevTools\Manager\Git;

/**
 * Class Plugin
 *
 * @category davidverholen_composer-dev-tools
 * @package  DavidVerholen\Composer\DevTools
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
class Plugin implements PluginInterface, EventSubscriberInterface
{

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     * * The method name to call (priority defaults to 0)
     * * An array composed of the method name to call and the priority
     * * An array of arrays composed of the method names to call and respective
     *   priorities, or 0 if unset
     *
     * For instance:
     *
     * * array('eventName' => 'methodName')
     * * array('eventName' => array('methodName', $priority))
     * * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            ScriptEvents::POST_PACKAGE_INSTALL => 'onPostPackageInstall',
            ScriptEvents::POST_PACKAGE_UPDATE => 'onPostPackageUpdate'
        ];
    }

    /**
     * Apply plugin modifications to composer
     *
     * @param Composer    $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        Config::init($composer, $io);
        Git::init($composer, $io);
    }

    /**
     * onPostPackageInstall
     *
     * @param PackageEvent $event
     *
     * @return void
     */
    public function onPostPackageInstall(PackageEvent $event)
    {
        /** @var InstallOperation $operation */
        $operation = $event->getOperation();
        $package = $operation->getPackage();

        Git::getInstance()->updateRemotes($package);
    }

    /**
     * onPostPackageInstall
     *
     * @param PackageEvent $event
     *
     * @return void
     */
    public function onPostPackageUpdate(PackageEvent $event)
    {
        /** @var UpdateOperation $operation */
        $operation = $event->getOperation();
        $package = $operation->getTargetPackage();

        Git::getInstance()->updateRemotes($package);
    }
}
