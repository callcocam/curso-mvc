<?php

namespace SIGA\Tags;

/**
 * Description of Options
 *
 * @author Claudio Campos
 */
class Options implements OptionsInterface {

    private $options = [];
    private $result = [];
    private $value;

    public function __construct(array $options = []) {
        if ($options) {
            $this->options = $options;
        }
    }

    public function __toString(): string {
        if (isset($this->options['value_options']) || isset($this->options['options_group'])):
            if ($this->options['value_empty']):
                $this->result[] = sprintf('<option value=" ">%s</option>', $this->options['value_empty']);
            endif;
            if (isset($this->options['options_group'])):
                return $this->options_group($this->options['options_group']);
            else:
                return $this->value_options(array_merge($this->result, $this->options['value_options']));
            endif;

        endif;
        return ' ' . implode(' ', $this->result);
    }

    public function setOptions(array $options, array $value = []) {
        \SIGA\Utils::dump($value[2]);
        if (isset($value[2])):
            $this->value = $value[2];
        endif;
        $this->options = $options;
    }

    private function options_group(array $groups) {
        foreach ($groups as $keyop => $group):
            if (is_array($group)):
                $this->result[] = sprintf('<optgroup label="%s">%s</optgroup>', $keyop, $this->value_options($group['value_options']));
            endif;
        endforeach;
        return implode(PHP_EOL, $this->result);
    }

    private function value_options(array $options) {
        $resultOption = [];
        if ($options):
            foreach ($options as $key => $value):
                if ($this->value == $key):
                    $resultOption[] = sprintf('<option selected value="%s">%s</option>', $key, $value);
                else:
                    $resultOption[] = sprintf('<option value="%s">%s</option>', $key, $value);
                endif;
            endforeach;
        endif;
        return implode(PHP_EOL, $resultOption);
    }

}
