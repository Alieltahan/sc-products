<?php

/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */


namespace Core\Products;

use Core\Response;
use Core\Validator\Contract\ValidatorInterface;

class Furniture extends Product implements ValidatorInterface
{
    protected $inputs = [];

    public function __construct($inputs = [])
    {
        parent::__construct($inputs);
        $this->inputs = $inputs;
    }

    public function execute()
    {
        foreach ($this->inputs as $key => $val) {
            $method = "validate" . ucfirst(strtolower($key));
            if (!method_exists(self::class, "$method")) {
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
        $height = $val['height'];
        $width = $val['width'];
        $length = $val['length'];
        foreach ($val as $k => $prop){
            $this->validateNumber($k, $prop);
        }
        $this->inputs[$key] = $height . 'x' . $width . 'x' . $length ;
    }
}
