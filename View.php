<?php

namespace SIGA;

/**
 * Description of View
 *
 * @author Claudio Campos
 */
class View {

    private $action;
    protected $configs;
    protected $view;
    protected $subfolder;
    protected $controller;
    protected $layout= "layout";
    protected $vars;

    public function __construct($configs, $subfolder, $controller, $action) {
        $this->view = new \stdClass;
        $this->configs = $configs;
        $this->subfolder = $subfolder;
        $this->action = str_replace("Action","", $action);
        $this->controller = strtolower(str_replace([
            "App", "Controllers", "Controller", $subfolder, "\\"
                        ], '', $controller));
        if ($this->controller == "notfound"):
            $this->subfolder = "Base";
            $this->action = "404";
        endif;
       
    }

    public function render() {
        if ($this->layout && file_exists(sprintf("%s/%s/Base/views/layout/%s.phtml", ROOT_PATH, APP_PATH, $this->layout))):
            include sprintf("%s/%s/Base/views/layout/%s.phtml", ROOT_PATH, APP_PATH, $this->layout);
        else:
            $this->content();
        endif;
    }

    protected function content() {
        include sprintf("%s/%s/%s/views/%s/%s.phtml", ROOT_PATH, APP_PATH, $this->subfolder, $this->controller, $this->action);
    }

    public function getAction() {
        return $this->action;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function getVars() {
        return $this->vars;
    }

    public function setAction($action) {
        $this->action = $action;
        return $this;
    }

    public function setLayout($layout) {
        $this->layout = $layout;
        return $this;
    }

    public function setVars($vars) {
        $this->vars = $vars;
        return $this;
    }

}
