<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * 调试
 * @param $arr
 */
function debug($arr) {
    $data = var_export($arr, true);
    static $log = null;

    if (!$log) {
        $log = new Logger('debug');
        $date = date('Y-m-d');
        $log->pushHandler(new StreamHandler(storage_path("logs/debug-{$date}.log"),Logger::INFO) );
    }

    $log->warning($data);
}

/**
 * 错误
 * @param $arr
 */
function error($arr) {
    $data = var_export($arr, true);
    static $log = null;

    if (!$log) {
        $log = new Logger('error');
        $date = date('Y-m-d');
        $log->pushHandler(new StreamHandler(storage_path("logs/error-{$date}.log"),Logger::INFO) );
    }

    $log->error($data);
}