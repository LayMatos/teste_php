<?php

class EnderecoDAO extends ConexaoPDO {
    
       function getEndereco($nome){
        $pdo = parent::getInstance();
        $sql="SELECT p.pes_id, p.pes_nome,
            u.unid_sigla,
            e.end_bairro, e.end_logradouro, e.end_numero, e.end_tipo_logradouro, e.cid_id,
            c.cid_nome, c.cid_ud, c.cid_id
	FROM pessoa p 
	JOIN lotacao l on l.pes_id = p.pes_id
	JOIN unidade u on u.unid_id = l.unid_id
	JOIN unidade_endereco ue ON ue.unid_id = u.unid_id
	JOIN endereco e ON e.end_id = ue.end_id
	JOIN cidade c ON c.cid_id = e.cid_id
        where  p.pes_nome ilike '%".$nome."%'";
        $sql = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}


?>