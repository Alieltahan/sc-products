<?php

/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

namespace Core;

class Response
{
    private const NOT_FOUND = 404;

    public static function respond($status, $data = [])
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        echo json_encode(['status' => $status, 'data' => $data]);
        die();
    }

    public static function abort($data = [], $code = self::NOT_FOUND)
    {
        http_response_code($code);
        static::respond("failed", $data);
    }
}
