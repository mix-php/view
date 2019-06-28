<?php

namespace Mix\View;

use Mix\View\Exception\ViewException;

/**
 * Class Renderer
 * @package Mix\View
 * @author liu,jian <coder.keda@gmail.com>
 */
class Renderer
{

    /**
     * 标题
     * @var string
     */
    public $title;

    /**
     * 渲染视图
     * @param $__template__
     * @param $__data__
     * @return string
     */
    public function render($__template__, $__data__)
    {
        // 传入变量
        extract($__data__);
        // 生成视图
        $__filepath__ = \Mix::$app->getViewPath() . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $__template__) . '.php';
        if (!is_file($__filepath__)) {
            throw new ViewException("视图文件不存在：{$__filepath__}");
        }
        ob_start();
        include $__filepath__;
        return ob_get_clean();
    }

}
