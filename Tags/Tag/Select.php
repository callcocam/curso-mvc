<?php

namespace SIGA\Tags\Tag;

/**
 * Description of Select
 *
 * @author Claudio Campos
 */
class Select extends Tags {

    protected $tag = '<select name="%s" %s>%s</select>';

    public function __toString(): string {
         return sprintf($this->tag, $this->attrs[1], $this->optional_attrs, $this->optional_options);
    }

    public function validate() {
        if (!isset($this->attrs[1])):
            throw new \Exception("Attribute name not found");
        endif;

        if (!is_string($this->attrs[1])):
            throw new \Exception("Attribute name must be string");
        endif;
    }

}
