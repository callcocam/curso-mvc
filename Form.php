<?php

namespace SIGA;

/**
 * Description of Form
 *
 * @author Claudio Campos
 */
class Form {

    protected $title;
    protected $data;
    protected $fields = [];
    protected $type = [
        'button' => 'button',
        'checkboxcolor' => 'checkboxcolor',
        'date' => '',
        'datetime' => 'datetime',
        'datetime-local' => 'datetime-local',
        'email' => 'email',
        'file' => 'file',
        'hidden' => 'hidden',
        'image' => 'image',
        'month' => 'month',
        'number' => 'number',
        'passwordv' => 'passwordv',
        'radio' => 'radio',
        'range' => 'range',
        'reset' => 'reset',
        'search' => 'search',
        'submit' => 'submit',
        'tel' => 'tel',
        'text' => 'text',
        'time' => 'time',
        'url' => 'url',
        'week' => 'week'
    ];

    public function __construct(array $data = [], string $title = "SigaForm") {
        $this->data = $data;
        $this->title = $title;
    }

    public function add(array $dados) {

        $this->fields = array_merge($this->fields, $dados);
    }

}
