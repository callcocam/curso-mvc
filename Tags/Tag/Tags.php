<?php

namespace SIGA\Tags\Tag;

use SIGA\Tags\AttrsInterface;

/**
 * Description of Tags
 *
 * @author Claudio Campos
 */
abstract class Tags implements TagsInterface {

    /**
     * @var \SIGA\Config
     */
    protected $attrs;
    protected $config;
    protected $optional_attrs;
    protected $optional_options;
    protected $attributesClass;
    protected $optionsClass;

    public function __construct(AttrsInterface $attrs, \SIGA\Tags\OptionsInterface $options, \SIGA\Config $config) {
        $this->config = $config;
        $this->attrs = func_get_args();

        foreach ($this->attrs as $key => &$object):

            if (is_a($object, "SIGA\Tags\Tag\TagsInterface")):
                $object = (string) $object;
            endif;

            if (is_a($object, "SIGA\Tags\AttrsInterface")):
                $this->attributesClass = $attrs;
                unset($this->attrs[$key]);
            endif;
            if (is_a($object, "SIGA\Tags\OptionsInterface")):
                $this->optionsClass = $options;
                unset($this->attrs[$key]);
            endif;

        endforeach;

        $this->attrs = array_values($this->attrs);

        $this->validate();
    }

    public function attributes(array $attributes) {
        $this->attributesClass->setAttr($attributes);
        $this->optional_attrs = (string) $this->attributesClass;
        return $this;
    }

    public function options(array $options) {
        $this->optionsClass->setOptions($options, $this->attrs);
        $this->optional_options = (string) $this->optionsClass;
        return $this;
    }

}
