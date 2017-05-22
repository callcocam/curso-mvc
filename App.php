<?php

namespace SIGA;

/**
 * Description of App
 *
 * @author Claudio Campos
 */
class App {

    protected $config;
    protected $controller_dir;
    protected $controller_notFound = 'NotFoundController';
    protected $request;
    protected $response;

    public function __construct(Config $configs) {
        $this->controller_dir = str_replace("/", DS, sprintf("%s/%s/Controllers", APP_PATH, "%s"));
        $this->config = $configs;

        $this->config->configs['controller_dir'] = $this->controller_dir;
        $this->config->configs['controller_notFound'] = $this->controller_notFound;

        $this->request = new Http\Request($this->config->configs['baseURI'], $this->controller_dir, $this->controller_notFound);

        $this->response = new Http\Response;
    }

    public function run() {
        /**
         * Variaveis
         */
        $subfolder = $this->request->getSubFolder() . DS;

        $controller = sprintf("%s%s", $this->request->getNameSpace(), $this->request->getController());

        $namespace = $this->request->getNameSpace();

        $action = $this->request->getAction();

        $controllerDir = sprintf($this->controller_dir, $subfolder);

        $this->controller_dir = $controllerDir;

        $controllerFile = sprintf("%s.php", $controller);

       // $controllerNotFoundFile = str_replace($this->request->getController(), $this->controller_notFound, $controllerFile);
        if (!file_exists(sprintf("%s/%s", ROOT_PATH, $controllerFile))):
           // require_once sprintf("%s/%s", ROOT_PATH, $controllerNotFoundFile);
            $controller = sprintf("%s%s", $namespace, $this->controller_notFound);
        else:
           // require_once sprintf("%s/%s", ROOT_PATH, $controllerFile);
        endif;
        $appController = (new Services\Container())->resolveClass($controller);

        // verifica se  e existe a functio com o nome da action

        if (!method_exists($appController, $action)):
            throw new \Exception("O method <{$action}> não foi encontrado no controller {$controller}");
        endif;

        $appController->setConfigs($this->config);

        $appController->setView(new View($this->config, $this->request->getSubFolder(), $this->request->getController(), $action));

        call_user_func_array([&$appController, $action], $this->request->params);
    }

}
