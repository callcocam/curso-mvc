<?php

namespace SIGA\Views;

/**
 * Description of Render
 *
 * @author Claudio Campos
 */
class Render {

    /**
     * @var \SIGA\Config
     */
    private $Config;
    protected $Path;
    protected $Template;
    protected $Templates;
    protected $Chaves;
    protected $Valores;
    protected $TagStyles = '<link rel="stylesheet" href="%s/%s.css">';
    protected $TagScripts = '<script src="%s/%s.js"></script>';

    public function __construct(\SIGA\Config $Config) {
        $this->Config = $Config;
        $this->Templates= $this->Config->getConfig('elements');
        $this->Path = ROOT_PATH;
    }

    public function styles(array $Styles = []) {
        $htmlRender = [];
        if ($Styles):
            foreach ($Styles as $Style):
                $htmlRender[] = sprintf($this->TagStyles, $this->Config->getConfig("baseURL"), $Style);
            endforeach;
        endif;
        return implode(PHP_EOL, $htmlRender);
    }

    public function scripts(array $Scripts = []) {
        $htmlRender = [];
        if ($Scripts):
            foreach ($Scripts as $Script):
                $htmlRender[] = sprintf($this->TagScripts, $this->Config->getConfig("baseURL"), $Script);
            endforeach;
        endif;
        return implode(PHP_EOL, $htmlRender);
    }

    public function renderize($Template,$Data=[]){
        $this->setChaves($Data);
        $this->setValores($Data);
        $this->load($Template);
        return str_replace($this->Chaves, $this->Valores, $this->Template);
    }

    protected function load($Template) {
        if (isset($this->Templates[$Template])):
            if (file_exists(\SIGA\Utils::directory(sprintf("%s/%s.tpl.html", $this->Path, $this->Templates[$Template])))):
                $this->Template = file_get_contents(\SIGA\Utils::directory(sprintf("%s/%s.tpl.html", $this->Path, $this->Templates[$Template])));
                return $this->Template;
            endif;
        endif;
        $this->Template = $Template;
        return $this->Template;
    }
    
    private function setChaves($Chaves) {
        $this->Chaves = explode('&', '{'.implode("}&{", array_keys($Chaves)).'}');
    }

    private function setValores($Valores) {
        $this->Valores = array_values($Valores);
    }



}
