<?php

namespace SIGA\Tags\Tag;

/**
 * Description of A
 *
 * @author Claudio Campos
 */
class A extends Tags {

    protected $tag = '<a href="%s" %s>%s</a>';

    public function validate() {
        if (!isset($this->attrs[1])):
            throw new \Exception("Attribute href not found");
        endif;

        if (!is_string($this->attrs[1])):
            throw new \Exception("Attribute href must be string");
        endif;

        if (!isset($this->attrs[2])):
            throw new \Exception("Attribute anchor not found");
        endif;

        if (!is_string($this->attrs[2])):
            throw new \Exception("Attribute anchor must be string");
        endif;
    }

    public function __toString(): string {
        if (\SIGA\Utils::strpos_array($this->attrs[1], array('ttps', 'ttp'))):
            return sprintf($this->tag, $this->attrs[1], $this->optional_attrs, $this->attrs[2]);
        endif;
        return sprintf($this->tag, sprintf("%s/%s", $this->config->getConfig('baseURL'), $this->attrs[1]), $this->optional_attrs, $this->attrs[2]);
    }

}
