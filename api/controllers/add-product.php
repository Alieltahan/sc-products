<?php

/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

use Core\App;
use Core\Products\Product;
use Core\Response;

$postData = json_decode(file_get_contents('php://input'), true);

if ($postData) {
    try {
        $product = new Product($postData, 'products');
        $product->add();
        Response::respond('success', 'Product has been added');
    } catch (PDOException $e) {
        Response::respond('failed', $e->getMessage());
    }
}
