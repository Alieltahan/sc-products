<?php
/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

$router->get('/api/', 'controllers/index.php');
$router->delete('/api/', 'controllers/delete.php');
$router->post('/api/', 'controllers/add-product.php');
