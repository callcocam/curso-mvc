<?php

namespace SIGA\Tags\Tag;

/**
 * Description of Img
 *
 * @author Claudio Campos
 */
class Img extends Tags {

    protected $tag = '<img src="%s" %s>';

    public function __toString(): string {
        if (\SIGA\Utils::strpos_array($this->attrs[1], array('ttps', 'ttp'))):
            return sprintf($this->tag, $this->attrs[1], $this->optional_attrs);
        endif;
        return sprintf($this->tag, sprintf("%s/%s",$this->config->getConfig('baseURL'), $this->attrs[1]), $this->optional_attrs);
    }

    public function validate() {
        if (!isset($this->attrs[1])):
            throw new \Exception("Attribute src not found");
        endif;

        if (!is_string($this->attrs[1])):
            throw new \Exception("Attribute src must be string");
        endif;
    }

}
