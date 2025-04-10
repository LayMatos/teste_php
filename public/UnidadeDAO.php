<?php
//include ('ConexaoPDO.php');

class UnidadeDAO extends ConexaoPDO {

     function getEfetivo($id_unid){
        $pdo = parent::getInstance();
        $sql="SELECT p.pes_id, p.pes_nome, p.pes_data_nascimento, p.pes_sexo, p.pes_mae, p.pes_pai, 
            to_char(age(p.pes_data_nascimento),'yy Anos') as idade,
            l.unid_id, l.lot_portaria, l.pes_id, l.lot_id,l.lot_data_lotacao, l.lot_data_remocao,
            ft.fp_bucket, ft.fp_data, ft.fp_hash, ft.fp_id, ft.pes_id, u.unid_id, u.unid_nome, u.unid_sigla
	FROM pessoa p 
	JOIN lotacao l on l.pes_id = p.pes_id
	JOIN foto_pessoa ft on ft.pes_id = p.pes_id
	JOIN unidade u on u.unid_id = l.unid_id WHERE u.unid_id = ".$id_unid;
        $sql = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}


?>