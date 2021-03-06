<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Beanstalk\Command;

use Beanstalk\Command;
use Beanstalk\Connection;
use Beanstalk\Exception;

/**
 * Watch command
 *
 * The "watch" command adds the named tube to the watch list for the current
 * connection. A reserve command will take a job from any of the tubes in the
 * watch list. For each new connection, the watch list initially consists of one
 * tube, named "default".
 *
 * @author Joshua Dechant <jdechant@shapeup.com>
 */
class WatchTube extends Command
{

    protected $tube;

    /**
     * Constructor
     *
     * @param  string             $tube Tube to add to the watch list. If the tube doesn't exist, it will be created
     * @throws BeanstalkException When $tube exceeds 200 bytes
     */
    public function __construct($tube)
    {
        if (strlen($tube) > 200) {
            throw new Exception('Tube name must be at most 200 bytes', Exception::TUBE_NAME_TOO_LONG);
        }

        $this->tube = $tube;
    }

    /**
     * Get the command to send to the beanstalkd server
     *
     * @return string
     */
    public function getCommand()
    {
        return sprintf('watch %s', $this->tube);
    }

    /**
     * Parse the response for success or failure.
     *
     * @param  string              $response Response line, i.e, first line in response
     * @param  string              $data     Data recieved with reponse, if any, else null
     * @param  BeanstalkConnection $conn     BeanstalkConnection use to send the command
     * @throws BeanstalkException  When any error occurs
     * @return integer             The number of tubes being watched
     */
    public function parseResponse($response, $data = null, Connection $conn = null)
    {
        if (preg_match('/^WATCHING (.+)$/', $response, $matches)) {
            return intval($matches[1]);
        }

        throw new Exception('An unknown error has occured.', Exception::UNKNOWN);
    }
}
