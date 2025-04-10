<?php
//include ('ConexaoPDO.php');

class PessoaDAO extends ConexaoPDO {
    
    function getList(){
        $pdo = parent::getInstance();
        $sql="SELECT p.pes_nome,e.end_bairro FROM pessoa p
        JOIN pessoa_endereco pe on pe.pes_id = p.pes_id
        JOIN endereco e on pe.end_id = e.end_id";
        $sql = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>