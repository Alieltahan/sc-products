<?php

/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

namespace Core;

use Core\Products\Product;
use PDOException;

class Query
{
    public $db;
    private $statement;
    /**
     * @var array
     */
    private $inputs = [];
    /**
     * @var string
     */
    private $query;


    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }


    public function select($columns = [], $table = 'products'): Query
    {
        $this->query = 'SELECT ' . implode(',', $columns) . ' FROM ' . $table;
        return $this;
    }

    public function stmt(): Query
    {
        $this->statement = $this->db->connection->prepare($this->query);
        $this->statement->execute($this->inputs);
        return $this;
    }

    public function fetchAll()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function where($column, $operator, $value): Query
    {
        $this->inputs[$column] = $value;
        $this->query .= " WHERE $column $operator :$column";
        return $this;
    }

    public function insertProduct($values, $table = 'products')
    {
        try {
            $this->statement = $this->db->connection->prepare('INSERT INTO ' . $table . '(' . implode(', ', array_keys($values)) . ')' .
            ' VALUES( :' . implode(',:', array_keys($values)) . ')');
            $this->statement->execute($values);
        } catch (PDOException $e) {
            Response::respond('failed', $e->getMessage());
        }
    }

    public function findDuplicateSKU($sku)
    {
        return $this->select(['sku'])->where('sku', '=', $sku)->stmt()->find();
    }

    public function deleteProduct($table = 'products')
    {
        $this->query = "DELETE FROM $table";
        return $this;
    }
}
