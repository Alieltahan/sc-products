<?php

/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

namespace Core\Products;

use Core\Response;
use Core\Validator\Contract\ValidatorInterface;

class Dvd extends Product implements ValidatorInterface
{
    public function validateAttr($key, $val)
    {
        $size = $val['size'];
        $this->validateNumber('size', $size);
        $this->inputs[$key] = "$size MB";
    }
}
