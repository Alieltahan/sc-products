<?php

/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */


namespace Core\Products;

use Core\Query;
use Core\Response;

class Product extends Query
{
    protected $errors = [];

    /**
     * @var array
     */
    protected $inputs;
    /**
     * @var mixed|string
     */
    protected $productClass;
    /**
     * @var mixed
     */
    protected $table;
    protected $productTypes = [
        'book' => Book::class,
        'dvd' => Dvd::class,
        'furniture' => Furniture::class
    ];

    public function __construct($inputs = [], $table = 'products')
    {
        parent::__construct();
        foreach ($inputs as $key => $val) {
            $this->inputs[$key] = $val;
        }
        $this->table = $table;
    }

    public function display()
    {
        return $this->select(['*'], $this->table)->stmt()->fetchAll();
    }

    public function save($values)
    {
        $this->insertProduct($values, $this->table);
    }

    public function add()
    {
        $type = strtolower($this->inputs['type']);
        $this->productClass = $this->productTypes[$type];
        (new $this->productClass($this->inputs))->execute();
    }

     public function execute()
    {
        foreach ($this->inputs as $key => $val) {
            $method = "validate" . ucfirst(strtolower($key));
            if (!method_exists(get_class($this), "$method")) {
                if (!method_exists(parent::class, "$method")) {
                    Response::respond('failed', "$key: Unexpected/Invalid product key");
                }
            }
            $this->$method($key, $val);
        }
        if ($this->errors) {
            Response::respond('failed', $this->errors);
        }
        $this->save($this->inputs);
    }

    public function validateSku($key, $val)
    {
        if ($this->findDuplicateSKU($val)) {
            $key = strtoupper($key);
            $this->errors[] = "${key}: ID already exist, please use unique sku";
        }
    }

    public function validateName($key, $val)
    {
        $this->validateString($key, $val);
    }

    public function validatePrice($key, $val)
    {
        $this->validateNumber($key, $val);
    }

    public function validateType($key, $val)
    {
        if (!in_array(strtolower($val), array_keys($this->productTypes), false)) {
            $key = strtoupper($key);
            $this->errors[] = "$key: Unexpected product type";
        }
    }

    protected function validateString($key, $val)
    {
        if (empty($val)) {
            $key = strtoupper($key);
            $this->errors[] = "${key} is a required field";
        }
    }

    protected function validateNumber($key, $val)
    {
        if ($val < 0 || empty($val)) {
            $key = strtoupper($key);
            $this->errors[] = "${key} should be valid integer/float greater than 0";
        }
    }

    public function delete(){
        try {
            forEach($this->inputs['skus'] as $val) {
                $this->deleteProduct($this->table)->where('sku', '=', $val)->stmt();
            }
        } catch (\PDOException $e) {
            Response::respond('failed', $e->getMessage());
        }
        $productsCount =  count($this->inputs['skus']);
        if(!$productsCount) {
            Response::respond('failed', 'Please select products to be deleted');
        }
        $count = $productsCount > 1 ? 's' : '';
        Response::respond('success', "$productsCount product{$count} has been deleted.");
    }
}
