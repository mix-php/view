<?php

namespace Mix\View;

use Mix\Bean\BeanInjector;
use Mix\Http\Message\Response;
use Mix\Http\Message\Stream\ContentStream;

/**
 * Class View
 * @package Mix\View
 * @author liu,jian <coder.keda@gmail.com>
 */
class View
{

    /**
     * @var Response
     */
    public $response;

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
        $this->response->withContentType('text/html', 'utf-8');
    }

    /**
     * 渲染视图 (包含布局)
     * @param $name
     * @param array $data
     * @return Response
     */
    public function render($name, $data = []): Response
    {
        $layout          = $this->layout;
        $renderer        = new Renderer();
        $data['content'] = $renderer->render($name, $data);
        $html            = $renderer->render("layouts.{$layout}", $data);
        return $this->response->withBody(new ContentStream($html));
    }

    /**
     * 渲染视图 (不包含布局)
     * @param $name
     * @param array $data
     * @return Response
     */
    public function renderPartial($name, $data = []): Response
    {
        $renderer = new Renderer();
        $html     = $renderer->render($name, $data);
        return $this->response->withBody(new ContentStream($html));
    }

}
