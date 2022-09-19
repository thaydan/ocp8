<?php

namespace App\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

class DynamicConnection extends Connection
{
    public function __construct(array $params, Driver $driver, $config, $eventManager)
    {
        parent::__construct($params, $driver, $config, $eventManager);
    }

    /**
     * @throws Exception
     */
    public function loadUserDatabase(string $host, string $port, string $user, string $password, string $dbName)
    {
        $params = $this->getParams();
        if ($this->isConnected())
            $this->close();
        $params['url'] = "mysql://" . $user . ":" . $password . "@" . $host . ":" . $port . "/" . $dbName;
        $params['host'] = $host;
        $params['port'] = $port;
        $params['dbname'] = $dbName;
        $params['user'] = $user;
        $params['password'] = $password;
        parent::__construct(
            $params,
            $this->_driver,
            $this->_config,
            $this->_eventManager
        );

        $application = new Application($this->get('kernel'));
        $application->setAutoExit(false);

        // Make sure we close the original connection because it lost the reference to the database
        $this->getDoctrine()->getManager()->getConnection()->close();

        // Create new database
        $options = array('command' => 'doctrine:database:create');
        $application->run(new ArrayInput($options));

        // Update schema
        $options = array('command' => 'doctrine:schema:update','--force' => true);
        $application->run(new ArrayInput($options));

        // Loading Fixtures, --append option prevent confirmation message
        $options = array('command' => 'doctrine:fixtures:load','--append' => true);
        $application->run(new ArrayInput($options));
    }
}
