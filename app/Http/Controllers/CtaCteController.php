<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CtaCte;

class CtaCteController extends Controller
{
    function getCtaCte(Request $request, $rut){
        $db = app('db');
        $results = $db->select("
                                SELECT *
                                FROM cargosfc
                                WHERE KNUMERUT=".$rut."
                                ORDER BY ptipcred asc, nrocuota asc    
                                ");
        //and v.ano=DATE_FORMAT(STR_TO_DATE(FECHAPAG, '%d/%m/%Y'), '%Y')
        
        return response()->json([
            "contador" => count($results),
            "datos" => $results,
        ]);
       
   }
   
   
       function getdeudaActualizada(Request $request, $rut){
        $db = app('db');
        $results = $db->select("
                                SELECT *
                                FROM cargosfc
                                WHERE KNUMERUT=".$rut."
                                ORDER BY ptipcred asc, nrocuota asc    
                                ");
        //and v.ano=DATE_FORMAT(STR_TO_DATE(FECHAPAG, '%d/%m/%Y'), '%Y')
        
        return response()->json([
            "contador" => count($results),
            "datos" => $results,
        ]);
       
   }
  
}
