<?php

namespace SIGA\Services\Conn;

/**
 * Description of Conn
 *
 * @author Claudio Campos
 */
class Conn {

    private $Host;
    private $User;
    private $Pass;
    private $Base;
    private $Dsn = "mysql:host=%s;dbname=%s";
    private $Options = [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];

    /**
     * $Connect
     * @var \PDO
     */
    protected $Connect = NULL;

    /**
     * $stmt
     * @var \PDOStatement
     */
    protected $stmt;
    protected $Result;
    protected $Sql;
    protected $Parses;

    public function __construct(\SIGA\Config $config) {
        $this->Host = $config->getConfig('Host');
        $this->User = $config->getConfig('User');
        $this->Pass = $config->getConfig('Pass');
        $this->Base = $config->getConfig('Base');
        if (!is_array($config->getConfig('Dsn'))):
            $this->Dsn = $config->getConfig('Dsn');
        endif;
        if (!is_array($config->getConfig('Option'))):
            $this->Options = $config->getConfig('Options');
        endif;
        $this->Connectar();
    }

    private function Connectar() {
        try {
            $dsn = sprintf($this->Dsn, $this->Host, $this->Base);
            $this->Connect = new \PDO($dsn, $this->User, $this->Pass, $this->Options);
            $this->Connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exc) {
            throw \SIGA\Utils::dump([$exc->getCode(), $exc->getMessage(), $exc->getFile(), $exc->getLine()]);
        }
    }

    public function setParses(string $Parses) {
        parse_str($Parses, $this->Parses);
        return $this->Parses;
    }

    public function getSintax() {
        if ($this->Parses):
            foreach ($this->Parses as $key => $value):
                $this->stmt->bindValue(":{$key}", $value, (is_int($value)) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
            endforeach;
        endif;
    }

    public function getResult() {
        return $this->Result;
    }

}
