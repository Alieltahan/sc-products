<?php

/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

use Core\Products\Product;
use Core\Response;

$data = [];

$product = new Product();


try {
    $data = $product->display();
} catch (PDOException $error) {
    Response::respond('failed', $error->getMessage());
}

Response::respond('success', $data);
