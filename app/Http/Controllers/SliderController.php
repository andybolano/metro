<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

use App\Slider;
use DB;

class SliderController extends Controller
{
    

    
    public function show($idSlider){       
        return Slider::find($idSlider); 
    }
    
    public function getAll(){
        return Slider::select('id', 'titulo')
                ->orderBy('titulo', 'asc')
                ->get();
          
    }
    
 
        /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        
        try {
              $result = "";
          return $result;  
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    
    public function storeImage(Request $request){
        
        try {
            $data = $request->all();
            
            $id = $data["id"];
            
            $slider = Slider::find($id);
            $slider->ruta = "http://".$_SERVER['HTTP_HOST'].'/laroca/img/slider/'.$id.".jpg";
            $slider->save();
            
            
            if ($request->hasFile('imagen')) {
                $request->file('imagen')->move("../img/slider", $id.".jpg");
                return JsonResponse::create(array('message' => "Imagen Guardada Correctamente","request"=>  json_encode($data)), 200);
            }
            return JsonResponse::create(array('message' => "Error al Guardar imagen","request"=>  json_encode($data)), 200);
        } catch (Exception $exc) {
            return JsonResponse::create(array('message' => "No se pudo guardar La imagen", "exception"=>$exc->getMessage()), 401);
        }
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {           
            $data = $request->all();
        
            $slider = new Slider();
            
            $slider->nombre = $data["nombre"];
            $slider->marca = $data["marca"];
            $slider->categoria = $data["categoria"];
            $slider->subcategoria = $data["subcategoria"];
            $slider->precio = $data["precio"];
            $slider->porcentajeVendedor = $data["porcentajeVendedor"];
            $slider->porcentajeDescuento = $data["porcentajeDescuento"];
            $slider->presentacion = $data["presentacion"];
            $slider->descripcion = $data["descripcion"];
            $slider->visitas = 0;
            $slider->calificacion = 0;
            $slider->estado = "ACTIVO";
            $slider->save();
            
            $slider->ruta = "http://".$_SERVER['HTTP_HOST'].'/laroca/img/slider/'.$slider->id.".jpg";
            $slider->save();
            
            if ($request->hasFile('imagen')) {
                $request->file('imagen')->move("../img/slider", $slider->id.".jpg");
            }
            
            return JsonResponse::create(array('message' => "Slider Guardada Correctamente", "request" => $slider), 200);
            
        } catch (Exception $exc) {
            return JsonResponse::create(array('message' => "No se pudo guardar la slider", "exception"=>$exc->getMessage(), "request" =>json_encode($data)), 401);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            
            $data = $request->all();
            
            $slider = Slider::find($id);

            $slider->nombre = $data["nombre"];
  
            $slider->categoria = $data["categoria"];
            $slider->subcategoria = $data["subcategoria"];
            $slider->precio = $data["precio"];
            $slider->porcentajeVendedor = $data["porcentajeVendedor"];
            $slider->porcentajeDescuento = $data["porcentajeDescuento"];
            $slider->presentacion = $data["presentacion"];
            $slider->descripcion = $data["descripcion"];
            
            $slider->save();
            
        
            
        return JsonResponse::create(array('message' => "Slider Modificada Correctamente", "request" =>json_encode($data)), 200);
            
        } catch (Exception $exc) {
            return JsonResponse::create(array('message' => "No se pudo Modificar la slider", "exception"=>$exc->getMessage(), "request" =>json_encode($data)), 401);
        }

    }
   
     public function calificar(Request $request){
      try {
         $data = $request->all();
         $id = $data["slider"];
         $slider = Slider::find($id);
         $slider->calificacion = $data["calificacion"];
         $slider->save();
           return JsonResponse::create(array('message' => "Slider Calificado Correctamente", 200));
            
        } catch (Exception $exc) {
            return JsonResponse::create(array('message' => "No se pudo Calificar la slider", "exception"=>$exc->getMessage(), 401));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $slider = Slider::find($id);
            $slider->delete();
            return JsonResponse::create(array('message' => "Slider Eliminada Correctamente", "request" =>json_encode($id)), 200);
        } catch (Exception $ex) {
            return JsonResponse::create(array('message' => "No se pudo Eliminar la slider", "exception"=>$ex->getMessage(), "request" =>json_encode($id)), 401);
        }
    }

    public function getSlidersSubcategoria($idSubcategoria)
    {
        
          $result = DB::select(DB::raw(
                        "Select p.*, m.id as idMarca, m.nombre as nombreMarca, m.ruta as rutaMarca from sliders as p, marcas as m
                        WHERE  p.marca = m.id AND p.subcategoria = $idSubcategoria AND p.estado='ACTIVO'" 
                         

                    ));
          return $result; 
          
          /*
        return Slider::select('*')->where('subcategoria',$idSubcategoria)->get();*/
    }
}

