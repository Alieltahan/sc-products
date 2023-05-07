<?php
/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

$router->get('/', 'controllers/index.php');
$router->delete('/', 'controllers/delete.php');
$router->post('/', 'controllers/add-product.php');
