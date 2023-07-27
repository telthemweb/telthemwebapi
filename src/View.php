<?php
namespace Ti\Cardfraudsm;
class View
{
    public function __construct()
    {
        require_once __DIR__.'/../Utilities/section.php';
        require_once __DIR__.'/../Utilities/templete.php';
        require_once __DIR__.'/../Utilities/routeurl.php';
        require_once __DIR__.'/../Utilities/token.php';
        require_once __DIR__.'/../Utilities/url.php';
        require_once __DIR__.'/../Utilities/ifutil.php';
        require_once __DIR__.'/../Utilities/numberformat.php';
        $this->crsftokenGenerator();

    }


    public function responseValues($values)
    {
        if($values != NULL)
            foreach($values as $responseName => $responseValue)
                $$responseName = $responseValue;
    }

    public function getViewResponse($view,$layoutlb,$footerlayout, array $values)
    {
        if($values != NULL)
            foreach($values as $responseName => $responseValue)
                $$responseName = $responseValue;
           
            $this->setView($view);
             include  __DIR__ .'/../wwwdir/views/layouts/'.$layoutlb.'.php';
             $this->setLayout(include __DIR__ .'/../wwwdir/views/'.$view.'.php');
             include  __DIR__ .'/../wwwdir/views/layouts/'.$footerlayout.'.php';

    }
    protected function crsftokenGenerator()
    {
        $_SESSION['_crsftoken'] = md5(uniqid(rand(00000,99999), true));
        require_once  __DIR__ . '/../Utilities/token.php';
    }
    protected function setLayout($layout)
    {
        define('LAYOUT', $layout);
    }

    protected function getLayout()
    {
        return constant('LAYOUT');
    }

    protected function setView($view)
    {
        define('CONTENT', $view);
    }

    public function renderView($view,$layoutlb,$footerlayout, array $params)
    {
        
        $viewContent = $this->renderViewOnly($view,$layoutlb,$footerlayout, $params);
        ob_start();
            include  __DIR__ .'./../wwwdir/views/layouts/'.$layoutlb.'.php';
            $this->setLayout(include __DIR__ .'./../wwwdir/views/'.$view.'.php');
            include  __DIR__ .'./../../wwwdir/views/layouts/'.$footerlayout.'.php';
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderViewOnly($view,$layoutlb,$footerlayout, array $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
         $this->setView($view);
             include  __DIR__ .'./../wwwdir/views/layouts/'.$layoutlb.'.php';
             $this->setLayout(include __DIR__ .'./../resources/views/'.$view.'.php');
             include  __DIR__ .'./../wwwdir/views/layouts/'.$footerlayout.'.php';
        return ob_get_clean();
    }

}