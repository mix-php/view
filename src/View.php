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
     * @var string
     */
    public $dir = '';

    /**
     * View constructor.
     * @param string $layout
     * @param string $dir
     */
    public function __construct(string $layout = 'main', string $dir = '')
    {
        $this->layout = $layout;
        $this->dir    = $dir;
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
        $data['content'] = $renderer->render($this->getViewDir(), $name, $data);
        return $renderer->render($this->getViewDir(), "layouts.{$layout}", $data);
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

    /**
     * 获取View目录
     * @return string
     */
    protected function getViewDir()
    {
        $dir   = $this->dir;
        $isMix = class_exists(\Mix::class);
        if ($isMix && !static::isAbsolute($dir)) {
            $dir = \Mix::$app->getViewPath() . DIRECTORY_SEPARATOR . $dir;
        }
        return $dir;
    }

    /**
     * 判断是否为绝对路径
     * @param $path
     * @return bool
     */
    protected static function isAbsolute($path)
    {
        if (($position = strpos($path, './')) !== false && $position <= 2) {
            return false;
        }
        if (strpos($path, ':') !== false) {
            return true;
        }
        if (substr($path, 0, 1) === '/') {
            return true;
        }
        return false;
    }

}
