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
    public function validateAttr($key, $val)
    {
        $height = $val['height'];
        $width = $val['width'];
        $length = $val['length'];
        foreach ($val as $k => $prop) {
            $this->validateNumber($k, $prop);
        }
        $this->inputs[$key] = $height . 'x' . $width . 'x' . $length;
    }
}
