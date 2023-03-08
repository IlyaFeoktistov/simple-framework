<?php

namespace SF\Routing;

class View
{
    private $layout;
    private $page;
    private $params;
    private $viewData;
    private $appConfig;

    public function __construct($page, $params = [], $viewData = [], $layout = '_default')
    {
        $this->page = $page;
        $this->layout = $layout;
        $this->params = $params;
        $this->viewData = $viewData;
        $this->appConfig = \SF\Foundation\Application::get()->getAppConfig()['application'];
    }

    public function render()
    {
        $layoutPath = $_SERVER['DOCUMENT_ROOT'] . '/app/views/layouts/' . $this->layout . '.php';
        $pagePath = $_SERVER['DOCUMENT_ROOT'] . '/app/views/pages/' . $this->page . '.php';
        
        $layoutMessage = "Файла $layoutPath несуществует";
        $pageMessage = "Файла $pagePath несуществует";
        
        return $this->renderContent(
            $layoutPath, 
            $layoutMessage, 
            $this->renderContent($pagePath, $pageMessage));
    }

    private function renderContent($path, $errorMessage, $content = '')
    {
        ob_start();

        extract($this->params);
        extract($this->viewData);
        extract($this->appConfig);

        if(file_exists($path))
        {
            include $path;
        }
        else
        {
            throw new \Exception($errorMessage);
        }

        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
}