<?php

namespace SIGA;

/**
 * Description of Models
 *
 * @author Claudio Campos
 */
class Models extends Services\Conn\Conn {

    protected $id = "id";
    protected $Tabela;

    public function findAll() {
        $this->Sql = "SELECT * FROM {$this->Tabela}";

        $this->stmt = $this->Connect->prepare($this->Sql);

        $this->stmt->execute();

        $this->Result = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($DataId) {
        $this->Sql = "SELECT * FROM {$this->Tabela} WHERE {$this->id}=:id";

        $this->stmt = $this->Connect->prepare($this->Sql);

        $this->stmt->bindValue(":{$this->id}", $DataId, \PDO::PARAM_INT);

        $this->stmt->execute();

        $this->Result = $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findBy(string $Where, string $Parses, $Limit = NULL, $Offset = NULL) {
        $this->Parses = $Parses;
        
        $this->Sql = "SELECT * FROM {$this->Tabela} {$Where}";
       
        $this->getSintax();
        if ($Limit):
            $this->stmt->bindValue(":limit", $Limit);
        endif;
        if ($Offset):
            $this->stmt->bindValue(":offset", $Offset);
        endif;
        $this->stmt->execute();

        $this->Result = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function findOneBy(string $Where, string $Parses) {
        $this->Parses = $Parses;
       
        $this->Sql = "SELECT * FROM {$this->Tabela} {$Where}";
        
        $this->getSintax();
       
        $this->stmt->execute();

        $this->Result = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    

}
