<?php

/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

namespace Core\Products;

use Core\Response;
use Core\Validator\Contract\ValidatorInterface;

class Book extends Product implements ValidatorInterface
{
    protected $inputs;

    public function __construct($inputs)
    {
        parent::__construct();
        $this->inputs = $inputs;
    }

    public function execute()
    {
        foreach ($this->inputs as $key => $val) {
            $method = "validate" . strtolower($key);
            if (!method_exists("{$this->productClass}::class", "$method")) {
                Response::respond('failed', "$key: Unexpected/Invalid product key");
            }
            $this->$method($key, $val);
        }
        if ($this->errors) {
            Response::respond('failed', $this->errors);
        }

        $this->save($this->inputs);
    }

    public function validateAttr($key, $val)
    {
        $weight = $val['weight'];
        $this->validateNumber('weight', $weight);
        $this->inputs[$key] = "$weight" . 'KG';
    }
}
