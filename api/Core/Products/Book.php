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
    public function validateAttr($key, $val)
    {
        $weight = $val['weight'];
        $this->validateNumber('weight', $weight);
        $this->inputs[$key] = "$weight" . 'KG';
    }
}
