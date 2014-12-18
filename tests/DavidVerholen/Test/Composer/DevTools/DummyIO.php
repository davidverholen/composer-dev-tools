<?php
/**
 * DummyIO.php
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

use Composer\Config;
use Composer\IO\IOInterface;

/**
 * Class DummyIO
 *
 * @category davidverholen_composer-dev-tools
 * @package  DavidVerholen\Test\Composer\DevTools
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
class DummyIO implements IOInterface
{

    /**
     * Is this input means interactive?
     *
     * @return bool
     */
    public function isInteractive()
    {
        return false;
    }

    /**
     * Is this output verbose?
     *
     * @return bool
     */
    public function isVerbose()
    {
        return true;
    }

    /**
     * Is the output very verbose?
     *
     * @return bool
     */
    public function isVeryVerbose()
    {
        return true;
    }

    /**
     * Is the output in debug verbosity?
     *
     * @return bool
     */
    public function isDebug()
    {
        return true;
    }

    /**
     * Is this output decorated?
     *
     * @return bool
     */
    public function isDecorated()
    {
        return true;
    }

    /**
     * Writes a message to the output.
     *
     * @param string|array $messages The message as an array of lines or a single string
     * @param bool         $newline  Whether to add a newline or not
     */
    public function write($messages, $newline = true)
    {
        foreach (is_array($messages) ? $messages : [$messages] as $message) {
            echo $newline ? sprintf("%s\n", $message) : $message;
        }
    }

    /**
     * Overwrites a previous message to the output.
     *
     * @param string|array $messages The message as an array of lines or a single string
     * @param bool         $newline  Whether to add a newline or not
     * @param integer      $size     The size of line
     */
    public function overwrite($messages, $newline = true, $size = null)
    {
        $this->write($messages, $newline);
    }

    /**
     * Asks a question to the user.
     *
     * @param string|array $question The question to ask
     * @param string       $default  The default answer if none is given by the user
     *
     * @return string The user answer
     *
     * @throws \RuntimeException If there is no data to read in the input stream
     */
    public function ask($question, $default = null)
    {
        $this->write($question);
        return $default;
    }

    /**
     * Asks a confirmation to the user.
     *
     * The question will be asked until the user answers by nothing, yes, or no.
     *
     * @param string|array $question The question to ask
     * @param bool         $default  The default answer if the user enters nothing
     *
     * @return bool true if the user has confirmed, false otherwise
     */
    public function askConfirmation($question, $default = true)
    {
        $this->write($question);
        return $default;
    }

    /**
     * Asks for a value and validates the response.
     *
     * The validator receives the data to validate. It must return the
     * validated data when the data is valid and throw an exception
     * otherwise.
     *
     * @param string|array $question  The question to ask
     * @param callback     $validator A PHP callback
     * @param bool|integer $attempts  Max number of times to ask before giving up (false by default, which means infinite)
     * @param string       $default   The default answer if none is given by the user
     *
     * @return mixed
     *
     * @throws \Exception When any of the validators return an error
     */
    public function askAndValidate(
        $question,
        $validator,
        $attempts = false,
        $default = null
    ) {
        $this->write($question);
        $validator($default);
        return $default;
    }

    /**
     * Asks a question to the user and hide the answer.
     *
     * @param string $question The question to ask
     *
     * @return string The answer
     */
    public function askAndHideAnswer($question)
    {
        $this->write($question);
    }

    /**
     * Get all authentication information entered.
     *
     * @return array The map of authentication data
     */
    public function getAuthentications()
    {
        // TODO: Implement getAuthentications() method.
    }

    /**
     * Verify if the repository has a authentication information.
     *
     * @param string $repositoryName The unique name of repository
     *
     * @return boolean
     */
    public function hasAuthentication($repositoryName)
    {
        // TODO: Implement hasAuthentication() method.
    }

    /**
     * Get the username and password of repository.
     *
     * @param string $repositoryName The unique name of repository
     *
     * @return array The 'username' and 'password'
     */
    public function getAuthentication($repositoryName)
    {
        // TODO: Implement getAuthentication() method.
    }

    /**
     * Set the authentication information for the repository.
     *
     * @param string $repositoryName The unique name of repository
     * @param string $username       The username
     * @param string $password       The password
     */
    public function setAuthentication(
        $repositoryName,
        $username,
        $password = null
    ) {
        // TODO: Implement setAuthentication() method.
    }

    /**
     * Loads authentications from a config instance
     *
     * @param Config $config
     */
    public function loadConfiguration(Config $config)
    {
        // TODO: Implement loadConfiguration() method.
    }
}
