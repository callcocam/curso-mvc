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
        '1' => 'button',
        '2' => 'checkboxcolor',
        '3' => 'date',
        '4' => 'datetime',
        '5' => 'datetime-local',
        '6' => 'email',
        '7' => 'file',
        '8' => 'hidden',
        '9' => 'image',
        '10' => 'month',
        '11' => 'number',
        '12' => 'password',
        '13' => 'radio',
        '14' => 'range',
        '15' => 'reset',
        '16' => 'search',
        '17' => 'submit',
        '18' => 'tel',
        '19' => 'text',
        '20' => 'time',
        '21' => 'url',
        '22' => 'week',
        '23' => 'select',
    ];
    private $defaul = [
        'type' => '',
        'name' => '',
        'attrs' => [],
        'options' => []
    ];

    public function __construct(array $data = [], string $title = "SigaForm") {
        $this->data = $data;
        $this->title = $title;
        
    }

    public function add(array $dados) {
        if (!isset($dados['type'])):
            throw new \SIGA\Exception\PHPErrorException(1, "O type do elemento não foi passado", __FILE__, '47');
        endif;
        if (!array_search($dados['type'], $this->type)):
            throw new \SIGA\Exception\PHPErrorException(1, "O type {$dados['type']} não é valido!", __FILE__, '49');
        endif;
        if (!isset($dados['name'])):
            throw new \SIGA\Exception\PHPErrorException(1, "O [name] do elemento não foi passado", __FILE__, '47');
        endif;
        $this->fields[$dados['name']] = array_merge($this->defaul, $dados);
    }

    public function get(string $field): array {
        if (!isset($this->fields[$field])):
            throw new \SIGA\Exception\PHPErrorException(1, "O elemento {$field} não foi encontrado", __FILE__, '60');
        endif;
        return $this->fields[$field];
    }

}
