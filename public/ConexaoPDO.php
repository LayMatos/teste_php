<?php
abstract class ConexaoPDO {

    const USER = "postgres";
    const PASS = "123456";
    const LOCALHOST = "localhost";
    const DBNAME = "project";

    private static $instance = null;

    private static function conection() {

        try {
            if (self::$instance == null):
                $dns = "pgsql:host=" . self::LOCALHOST . ";dbname=" . self::DBNAME;
                self::$instance = new PDO($dns, self::USER, self::PASS);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            endif;
            //echo "Conexao realizada com sucesso! ";
        } catch (PDOException $e) {
            echo "Erro  de Conexao .: " . $e->getMessage();
        }
        return self::$instance;
    }

    public static function getInstance() {
        return self::conection();
    }

}
?>