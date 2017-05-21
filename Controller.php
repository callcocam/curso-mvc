<?php

namespace SIGA;

/**
 * Description of Controller
 *
 * @author Claudio Campos
 */
class Controller {

    protected $config;
    protected $request;
    protected $response;
    protected $view;

    public function __construct(Config $config) {
        
        $this->response = new Http\Response;
        if ($config):
            $this->setConfigs($config);
        endif;
    }

    public function setConfigs($config) {
        $this->config = $config;
        $this->request = new Http\Request($config->baseURI, $config->controller_dir, $config->controller_notFound);
    }

    /*
     * Default Action
     */

    public function indexAction() {
         $this->getView()->render();
    }

    public function __get(string $param) {
        if (isset($this->view->$param)):
            return $this->view->$param;
        elseif (isset($this->$param)):
            return $this->$param;
        else:
            throw new \Exception("Param <{$param}> não encontrado");
        endif;
    }

    public function redirect(string $route, string $controller = '', string $action = '', string $id = '') {
        $URL = sprintf("%s/%s", $this->config->baseURL, $route);
        if (!empty($controller) && empty($action) && empty($id)):
            $URL = sprintf("%s/%s/%s", $this->config->baseURL, $route, $controller);
        elseif (!empty($controller) && !empty($action) && empty($id)):
            $URL = sprintf("%s/%s/%s/%s", $this->config->baseURL, $route, $controller, $action);
        elseif (!empty($controller) && !empty($action) && !empty($id)):
            $URL = sprintf("%s/%s/%s/%s/%s", $this->config->baseURL, $route, $controller, $action, $id);
        endif;
        return $this->response->redirectTo($URL);
    }
    public function getView() {
        return $this->view;
    }

    public function setView($view) {
        $this->view = $view;
        return $this;
    }


}
