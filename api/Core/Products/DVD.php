<?php
/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */


namespace Core\Products;

use Core\Response;
use Core\Validator\Contract\ValidatorInterface;

class DVD extends Product implements ValidatorInterface
{
    protected $inputs=[];
    public function __construct($inputs = [])
    {
        parent::__construct($inputs);
        $this->inputs = $inputs;
    }

    public function execute()
    {
        foreach ($this->inputs as $key => $val) {
            $method = "validate_{$key}";
            if (!method_exists(self::class, "$method")) {
                Response::respond('failed', "$key: Invalid product key");
            }
            $this->$method($key, $val);
        }

        if ($this->errors) {
            Response::respond('failed', $this->errors);
        }

        $this->save($this->inputs);
    }
    public function validate_attr($key, $val)
    {
        $size = $val['size'];
        $this->validateNumber('size', $size);
        $this->inputs[$key] = "$size MB";
    }
}