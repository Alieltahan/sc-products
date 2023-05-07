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
    public function validate_sku($key, $val);
    public function validate_name($key, $val);
    public function validate_price($key, $val);
    public function validate_type($key, $val);
    public function validate_attr($key, $val);
}
