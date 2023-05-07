<?php
/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */


/**
 * @param $value
 * @return void
 */
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}


/**
 * @param $path
 * @return string
 */
function base_path($path): string
{
    return BASE_PATH . $path;
}
