<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CtaCte;

class CtaCteController extends Controller
{
    function getCtaCte(Request $request, $rut){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials: true');          
        $db = app('db');
        $results = $db->select("
                                SELECT c.*
                                ,(SELECT DESCCRED FROM tipocred t WHERE t.ptipcred=c.ptipcred)NOM_CREDITO
                                ,IFNULL((select sum(valaboutd) from abonosfc a where a.nrocuota=c.nrocuota and a.knumerut=c.knumerut and a.ptipcred=c.ptipcred),0)ABONOS
                                ,0 DESCUENTO
                                FROM cargosfc c
                                WHERE c.knumerut=".$rut."
                                ORDER BY c.ptipcred asc, c.nrocuota asc    
                                ");

        return  json_encode($results);
       
   }
   
    function getDeudaHoy(Request $request, $rut){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials: true');          
        $db = app('db');
        $results = $db->select("
                                SELECT c.*
                                ,(SELECT DESCCRED FROM tipocred t WHERE t.ptipcred=c.ptipcred)NOM_CREDITO
                                ,IFNULL((select sum(valaboutd) from abonosfc a where a.nrocuota=c.nrocuota and a.knumerut=c.knumerut and a.ptipcred=c.ptipcred),0)ABONOS
                                ,0 DESCUENTO
                                FROM cargosfc c
                                WHERE c.knumerut=".$rut."
                                AND DATE_FORMAT(STR_TO_DATE(fechavto, '%d/%m/%Y'), '%Y')<=".date('Y')."
                                ORDER BY c.ptipcred asc, c.nrocuota asc    
                                ");

        return  json_encode($results);
       
   }
   
   
    function getdeudaActualizada(Request $request, $rut){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials: true');  
        
        $db = app('db');
        $results = $db->select("
                                SELECT *
                                FROM cargosfc
                                WHERE KNUMERUT=".$rut."
                                ORDER BY ptipcred asc, nrocuota asc    
                                ");
        //and v.ano=DATE_FORMAT(STR_TO_DATE(FECHAPAG, '%d/%m/%Y'), '%Y')
        
//        return response()->json([
//            "contador" => count($results),
//            "datos" => $results,
//        ]);
        return  json_encode($results);
       
   }
  
}
