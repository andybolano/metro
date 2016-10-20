<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

use App\Documento;
use DB;

class DocumentosController extends Controller
{
     public function save(Request $request){       
        try {
            $data = $request->all();
            $doc = new Documento();
            $doc->titulo = $data["titulo"];
            $doc->descripcion = $data["descripcion"];
            $doc->save();

            $doc->url = "http://".$_SERVER['HTTP_HOST'].'/metropolitana/documentos/'.$doc->id.".pdf";
            $doc->save();
            
           
            if ($request->hasFile('archivo')) {
               
                $request->file('archivo')->move("../documentos",$doc->id.'.pdf');    
            };

            return JsonResponse::create(array('message' => "Documento Guardado Correctamente", "request" =>json_encode($data)), 200);  
        } catch (Exception $e) {            
            return JsonResponse::create(array('message' => "No se pudo guardar el documento", "exception"=>$e->getMessage(), "request" =>json_encode($data)), 401);
        }
    }
    
    public function getAll(){
        return Documento::select('id', 'titulo','descripcion','url')
                ->orderBy('titulo', 'asc')
                ->get();
          
    }
    
     public function destroy($id)
    {
        try {
            $doc = Documento::find($id);
            $doc->delete();
            return JsonResponse::create(array('message' => "Documento Eliminado Correctamente", "request" =>json_encode($id)), 200);
        } catch (Exception $ex) {
            return JsonResponse::create(array('message' => "No se pudo Eliminar el documento", "exception"=>$ex->getMessage(), "request" =>json_encode($id)), 401);
        }
    }

    
    
    
}
