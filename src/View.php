<?php

namespace Mix\View;

use Mix\Bean\BeanInjector;

/**
 * Class View
 * @package Mix\View
 * @author liu,jian <coder.keda@gmail.com>
 */
class View
{

    /**
     * @var string
     */
    public $layout = 'main';

    /**
     * View constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        BeanInjector::inject($this, $config);
    }

    /**
     * 渲染视图 (包含布局)
     * @param $name
     * @param array $data
     * @return string
     */
    public function render($name, $data = [])
    {
        $layout          = $this->layout;
        $renderer        = new Renderer();
        $data['content'] = $renderer->render($name, $data);
        return $renderer->render("layouts.{$layout}", $data);
    }

    /**
     * 渲染视图 (不包含布局)
     * @param $name
     * @param array $data
     * @return string
     */
    public function renderPartial($name, $data = [])
    {
        $renderer = new Renderer();
        return $renderer->render($name, $data);
    }

}
