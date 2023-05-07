<?php
/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */


namespace Core;

use PDO;
use PDOException;
use Exception;

// Connect to our MySql DB
class Database
{
    public $connection;

    public function __construct($config, $username = 'root', $password = '')
    {
        try {
            $dsn = 'mysql:' . http_build_query($config, '', ';');
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $error) {
            Response::respond('failed', $error->getMessage());
            die();
        }
    }
}
