<?php
 Route::post('api/documentos/save', 'DocumentosController@save');   
 Route::get('api/documentos/get', 'DocumentosController@getAll');  
 Route::Resource('api/documentos', 'DocumentosController'); 