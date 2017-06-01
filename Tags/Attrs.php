<?php

namespace SIGA\Tags;

/**
 * Description of Attr
 *
 * @author Claudio Campos
 */
class Attrs implements AttrsInterface {

    private $attrs = [];

    public function __construct(array $attrs = []) {
        if ($attrs):
            $this->attrs = $attrs;
        endif;
    }

    public function __toString(): string {
        $result = [];
        foreach ($this->attrs as $key => $value):
            $result[] = sprintf('%s="%s"', $key, $value);
        endforeach;
        return ' '. implode(' ', $result);
    }

    public function setAttr(array $attrs) {
        $this->attrs = $attrs;
    }

}
