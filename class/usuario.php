<?php

class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario(){
        return $this->idusuario;
    }
    public function setIdusuario($value){
        $this->idusuario = $value;
    }
    public function getDeslogin(){
        return $this->dessenha;
    }
    public function setDeslogin($d){
        $this->deslogin = $d;
    }
    public function getDessenha(){
        return $this->dessenha;
    }
    public function setDessenha($ds){
        $this->dessenha = $ds;
    }
    public function getDtcadastro(){
        return $this->dtcadastro;
    }
    public function setDtcadastro($dt){
        $this->dtcadastro = $dt;
    
    }
    public function loadById($id){
        $sql = new Sql(); // instanciando uma classe
        $result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario =:ID", array(":ID"=>$id // chamando o metodo select e f azendo um select no banco
    
    ));
    // if(isset($result[0]) mesma coisa que a função de baixo
    if(count($result) > 0){
        $row = $result[0];
        $this->setIdusuario($row['idusuario']);
        $this->setDeslogin($row['deslogin']);
        $this->setDessenha($row['dessenha']);
        $this->setDtcadastro(new DateTime($row['dtcadastro']));
        
    }
    }
    public static function getList(){
        $sql = new Sql();
    
        return $sql ->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
    }
public static function search($login){
    $sql = new Sql(); // instanciado
    return $sql->select("SELECT * FROM tb_usuarios  WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
    ':SEARCH'=>"%".$login."%"

    ));
}

    public function login($login, $password){
        $sql = new Sql(); // instanciando uma classe
        $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin =:LOGIN AND dessenha = :PASSWORD", array( // chamando o metodo select e f azendo um select no banco
        ":LOGIN"=>$login,
        ":PASSWORD"=>$password
    ));
    // if(isset($result[0]) mesma coisa que a função de baixo
    if(count($result) > 0){
        $row = $result[0];
        $this->setIdusuario($row['idusuario']);
        $this->setDeslogin($row['deslogin']);
        $this->setDessenha($row['dessenha']);
        $this->setDtcadastro(new DateTime($row['dtcadastro']));
        
    }else{
        throw new Exception("Login ou senha invalidos", 1);
        
    }
    }
    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/y/ H")
        ));
    }
    
}

?>