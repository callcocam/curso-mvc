<?php

namespace SIGA;

/**
 * Description of Config
 *
 * @author Claudio Campos
 */
class Config {
    public $configs;
    
    public function __construct() {
        $this->configs = include sprintf("%s/%s/config/config.php",ROOT_PATH,APP_PATH);
    }
    
    public function getConfig(string $key=''){
        
        if(isset($this->configs[$key])):
            return $this->configs[$key];
        endif;
        return $this->configs;
    }
}
