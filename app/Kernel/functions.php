<?php
/**
 * @copyright zunea/hyperf-admin
 * @version 1.0.0
 * @link https://github.com/Zunea/hyperf-admin
 */

if (!function_exists('di')) {
    /**
     * di
     *
     * @param string $id
     * @return mixed
     */
    function di(string $id)
    {
        return \Hyperf\Utils\ApplicationContext::getContainer()->get($id);
    }
}

if (!function_exists('getConfig')) {
    /**
     * 获取配置
     *
     * @param string $name
     * @param null $default
     * @return mixed
     */
    function getConfig(string $name, $default = null)
    {
        return \Hyperf\Utils\ApplicationContext::getContainer()->get(\App\Service\ConfigService::class)->get($name, $default);
    }
}

if (!function_exists('getPath')) {
    /**
     * 获取文件名和后缀
     *
     * @param $filename
     *
     * @return string|string[]
     */
    function getPath($filename)
    {
        $type = pathinfo($filename);
        return $type['filename'] . '.' . strtolower($type["extension"]);
    }
}