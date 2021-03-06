Beanstalk\\Command\\Release Class Ref
=====================================

.. php:namespace:: Beanstalk\Command

.. php:class:: Release

    :Extends: :php:class:`Beanstalk\\Command`
    :Description: Release command
    :Author: Joshua Dechant <jdechant@shapeup.com>


    The release command puts a reserved job back into the ready queue (and marks
    its state as "ready") to be run by any client. It is normally used when the job
    fails because of a transitory error.

.. topic:: Class Methods

    * :php:meth:`Release::__construct` -- Constructor
    * :php:meth:`Release::getCommand` -- Get the command to send to the beanstalkd server
    * :php:meth:`Release::parseResponse` -- Parse the response for success or failure.

.. php:method:: __construct( $id , $priority , $delay )

    :Description: Constructor
    :param integer $id: The job id to release
    :param integer $priority: A new priority to assign to the job
    :param integer $delay: Number of seconds to wait before putting the job in the ready queue.

.. php:method:: getCommand(  )

    :Description: Get the command to send to the beanstalkd server
    :returns: *string*

.. php:method:: parseResponse( $response [ , $data = null , $conn = null ] )

    :Description: Parse the response for success or failure.
    :param string $response: Response line, i.e, first line in response
    :param string $data: Data recieved with reponse, if any, else null
    :param Beanstalk\Connection $conn: BeanstalkConnection use to send the command
    :returns: *boolean* True if command was successful
    :throws: *\Beanstalk\Exception* When the server runs out of memory
    :throws: *\Beanstalk\Exception* When the job cannot be found or has already timed out
    :throws: *\Beanstalk\Exception* When any other error occurs


