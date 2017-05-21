<?php

namespace SIGA\Services\Sessions;

/**
 * Description of StartSession
 *
 * @author Claudio Campos
 */
class StartSession {
 
    static function sec_session_start(bool $regenerete = FALSE){
        $cookiesParams = session_get_cookie_params();
        
        session_set_cookie_params($cookiesParams['lifetime'], $cookiesParams['path'], $cookiesParams['domain'], FALSE, TRUE);
        
        session_start([
            'name'=>'sec_sessio_id',
            'use_only_cookies' =>1
        ]);
        
        if($regenerete):
            session_regenerate_id($regenerete);
        endif;
    }
    
}
