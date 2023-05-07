<?php
/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

use Core\Products\Product;

$postData = json_decode(file_get_contents('php://input'), true);

(new Product($postData))->delete();
