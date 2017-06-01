<?php

namespace SIGA;

/**
 * Description of Models
 *
 * @author Claudio Campos
 */
class Models extends Services\Conn\Conn {

    protected $Id = "id";
    protected $Tabela;
    protected $Join=null;
    protected $Fields = "*";
    public function findAll() {
        $this->Sql = "SELECT {$this->Fields} FROM {$this->Tabela}";
        
        $this->stmt = $this->Connect->prepare($this->Sql);

        $this->stmt->execute();

        $this->Result = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($DataId) {
        $this->Sql = "SELECT {$this->Fields} FROM {$this->Tabela} WHERE {$this->id}=:id";

        $this->stmt = $this->Connect->prepare($this->Sql);

        $this->stmt->bindValue(":{$this->id}", $DataId, \PDO::PARAM_INT);

        $this->stmt->execute();

        $this->Result = $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findBy(string $Where, string $Parses, $Limit = NULL, $Offset = NULL) {
        if ($Limit):
            $Where .= " limit:limit";
            $Parses .= " limit={$Limit}";
        endif;
        if ($Offset):
            $Where .= " offset:offset";
            $Parses .= " offset={$Offset}";
        endif;

        $this->Parses = $Parses;

        $this->Sql = "SELECT {$this->Fields} FROM {$this->Tabela} {$Where}";

        $this->getSintax();

        $this->stmt->execute();

        $this->Result = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findOneBy(string $Where, string $Parses) {
        $this->Parses = $Parses;

        $this->Sql = "SELECT {$this->Fields} FROM {$this->Tabela} {$Where}";

        $this->getSintax();

        $this->stmt->execute();

        $this->Result = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create($Data) {
        $Inputs = implode(" ,", array_keys($Data));

        $Parses = sprintf(":%s", implode(" , :", array_keys($Data)));

        $this->Sql = "INSERT INTO {$this->Tabela} ({$Inputs}) VALUES ({$Parses})";

        try {
            $this->stmt = $this->Connect->prepare($this->Sql);
            $this->stmt->execute($Data);
            $this->Result = $this->Connect->lastInsertId();
        } catch (\PDOException $exc) {
            throw Utils::dump([$exc->getCode(), $exc->getMessage()]);
        }
    }

    public function update(array $Data, string $Where, string $Parses) {
        parse_str($Parses, $this->Parses);

        foreach ($Data as $key => $value):
            $Places[] = sprintf("%s =:%s", $key, $key);
            $Data[$key] = (empty($value) ? NULL : $value);
        endforeach;

        $Place = implode(" ,", $Places);

        $this->Sql = "UPDATE {$this->Tabela} SET {$Place} WHERE {$Where}";

        try {
            $this->stmt = $this->Connect->prepare($this->Sql);
            $this->stmt->execute(array_merge($Data, $this->Parses));
            $this->Result = TRUE;
        } catch (\PDOException $exc) {
            $this->Result = FALSE;
            throw Utils::dump([$exc->getCode(), $exc->getMessage()]);
        }
    }

    public function delete(string $Where, string $Parses) {
        parse_str($Parses, $this->Parses);

        $this->Sql = "DELETE FROM {$this->Tabela} WHERE {$Where}";

        try {
            $this->stmt = $this->Connect->prepare($this->Sql);
            $this->stmt->execute($this->Parses);
            $this->Result = TRUE;
        } catch (\PDOException $exc) {
            $this->Result = FALSE;
            throw Utils::dump([$exc->getCode(), $exc->getMessage()]);
        }
    }

    public function getFields() {
        return explode(",", $this->Fields);
    }


}
