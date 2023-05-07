<?php


/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

$attr = [
    'arr' => [
        "size" => 5
    ]
];

//function handleAttr($attr)
//{
//    foreach ($attr as $key => $val){
//        echo $key . $val;
//    }
//}
//handleAttr($attr);
$attr['arr']['size'] = 1;
var_dump($attr['arr']['size']);