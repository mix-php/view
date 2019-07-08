<?php

namespace Mix\View;

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
    public $layout = '';

    /**
     * View constructor.
     * @param array $config
     */
    public function __construct($layout = 'main')
    {
        $this->layout = $layout;
    }

    /**
     * 渲染视图 (包含布局)
     * @param string $name
     * @param array $data
     * @return string
     */
    public function render(string $name, array $data = []): string
    {
        $layout          = $this->layout;
        $renderer        = new Renderer();
        $data['content'] = $renderer->render($name, $data);
        return $renderer->render("layouts.{$layout}", $data);
    }

    /**
     * 渲染视图 (不包含布局)
     * @param string $name
     * @param array $data
     * @return string
     */
    public function renderPartial(string $name, array $data = []): string
    {
        $renderer = new Renderer();
        return $renderer->render($name, $data);
    }

}
