<?php

namespace SIGA\Http;

/**
 * Description of Response
 *
 * @author Claudio Campos
 */
class Response {
    public function redirectTo(string $URL){
         header(sprintf("Location: %s",$URL));
    }
}
