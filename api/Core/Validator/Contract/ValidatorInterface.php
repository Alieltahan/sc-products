<?php

/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

namespace Core\Validator\Contract;

interface ValidatorInterface
{
    public function execute();
    public function validateSku($key, $val);
    public function validateName($key, $val);
    public function validatePrice($key, $val);
    public function validateType($key, $val);
    public function validateAttr($key, $val);
}
