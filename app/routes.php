<?php
declare(strict_types=1);

include ('../public/ConexaoPDO.php');
include ('../public/PessoaDAM.php');
include ('../public/UnidadeDAO.php');
include ('../public/EnderecoDAO.php');

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world ELBERSON!');
        //colocar codigo
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
      $app->get('/teste/{id}', function (Request $request, Response $response, $args) {
        $response->getBody()->write('Hello world ELBERSON! teste'.$args['id']);
        //colocar codigo
        return $response;
    });
    
    $app->get('/pessoas', function (Request $request, Response $response) {
        
         $dao = new PessoaDAO();   
         $rs = $dao->getList();
         $arr_final = array();
         foreach($rs as $extrato){
             $arr = array(
                 "nome" => $extrato['pes_nome'],
                 "bairro" => $extrato['end_bairro']
                ); 
             array_push($arr_final,$arr);
             
         }
         $json = json_encode($arr_final);
        // var_dump($dao->getList());
         
        // echo $json;
         
         $response->getBody()->write($json);     
             
             
           //  $response->getBody()->write('Hello world ELBERSON! teste'.$args['id']);
        //colocar codigo
        return $response;
    });
    
     $app->get('/efetivo/{id}', function (Request $request, Response $response, $args) {
         
       $unidDAO =  new UnidadeDAO();  
       $rs =  $unidDAO->getEfetivo($args['id']);
       $arr_final = array();  
       foreach($rs as $extrato){
           $arr = array(
                 "pes_id" => $extrato['pes_id'],
                 "pes_nome" => $extrato['pes_nome'],
                 "pes_data_nascimento" => $extrato['pes_data_nascimento'],
                 "pes_sexo" => $extrato['pes_sexo'],                        
                 "pes_mae" => $extrato['pes_mae'],
                 "pes_pai" => $extrato['pes_pai'],                        
                 "idade" => $extrato['idade'],
                 "unid_id" => $extrato['unid_id'],                         
                 "lot_portaria" => $extrato['lot_portaria'],
                 "lot_id" => $extrato['lot_id'],                        
                 "lot_data_lotacao" => $extrato['lot_data_lotacao'],
                 "lot_data_remocao" => $extrato['lot_data_remocao'],                           
                 "fp_bucket" => $extrato['fp_bucket'],
                 "fp_data" => $extrato['fp_data'],                        
                 "fp_hash" => $extrato['fp_hash'],
                 "unid_nome" => $extrato['unid_nome'],       
                 "unid_sigla" => $extrato['unid_sigla']                         
                         
                         
                ); 
                 
                 
                 
             array_push($arr_final,$arr);  
           
       }
       $json = json_encode($arr_final);      
       
        $response->getBody()->write($json);           
        return $response;
    });    
   
    $app->get('/servidor/{nome}', function (Request $request, Response $response, $args) {
        
        $enderdao = new EnderecoDAO();
        $rs = $enderdao->getEndereco($args['nome']);
         $arr_final = array();
         foreach($rs as $extrato){
             $arr = array(
                 "pes_id" => $extrato['pes_id'],
                 "pes_nome" => $extrato['pes_nome'],                     
                 "unid_sigla" => $extrato['unid_sigla'],
                 "end_bairro" => $extrato['end_bairro'],         
                 "end_logradouro" => $extrato['end_logradouro'],
                 "end_numero" => $extrato['end_numero'],       
                 "end_tipo_logradouro" => $extrato['end_tipo_logradouro'],
                 "cid_id" => $extrato['cid_id'],                    
                 "cid_nome" => $extrato['cid_nome'],
                 "cid_ud" => $extrato['cid_ud']                      
                ); 
             array_push($arr_final,$arr);
             
         }
         $json = json_encode($arr_final);
        // var_dump($dao->getList());
         
        // echo $json;
         
         $response->getBody()->write($json); 
        return $response;
    }); 
    
};
