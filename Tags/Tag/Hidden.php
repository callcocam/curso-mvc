<?php

namespace SIGA\Tags\Tag;

/**
 * Description of Hidden
 *
 * @author Claudio Campos
 */
class Hidden extends Tags {

    protected $tag = '<input type="hidden" name="%s" %s>';

    public function validate() {
        if (!isset($this->attrs[1])):
            throw new \Exception("Attribute name not found");
        endif;

        if (!is_string($this->attrs[1])):
            throw new \Exception("Attribute name must be string");
        endif;
    }

    public function __toString(): string {
        return sprintf($this->tag, $this->attrs[1], $this->optional_attrs);
    }

}
