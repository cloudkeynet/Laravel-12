<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use stdClass;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    /**
     * Ejemplo de error: variable indefinida
     */
    public function ejemploVariableIndefinida()
    {
        // Error: Undefined variable $undefinedVariable
        $results = $undefinedVariable;
        
        return Response::json(['data' => $results]);
    }
    
    /**
     * Ejemplo de error: tratar un entero como string
     */
    public function ejemploTiposIncompatibles($id)
    {
        // Ejemplo de error: tratar un entero como string
        $idValue = $id + "10"; // Error: Operación entre tipos incompatibles
        
        return Response::json(['id' => $id]);
    }
    
    /**
     * Ejemplo de error: acceder a propiedad de un null
     */
    public function ejemploAccesoObjetoNulo()
    {
        // Ejemplo de error: acceder a propiedad de un null
        $user = null;
        $name = $user->name; // Error: Trying to access property 'name' of non-object
        
        return Response::json(['success' => true], 201);
    }
    
    /**
     * Ejemplo de error: clase no encontrada
     */
    public function ejemploClaseNoEncontrada()
    {
        // Ejemplo de error: llamar a un método de una clase no instanciada
        $result = SomeClass::doSomething(); // Error: Class 'App\Http\Controllers\SomeClass' not found
        
        return Response::json(['updated' => true]);
    }
    
    /**
     * Ejemplo de error: índice de array indefinido
     */
    public function ejemploIndiceArrayIndefinido()
    {
        // Ejemplo de error: índice de array indefinido
        $config = [];
        $value = $config['key']; // Error: Undefined array key 'key'
        
        return Response::json(null, 204);
    }
    
    /**
     * Ejemplo de error: llamar a un método inexistente
     */
    protected function ejemploMetodoInexistente()
    {
        // Ejemplo de error: llamar a un método que no existe
        $this->someMethod(); // Error: Call to undefined method App\Http\Controllers\Controller::someMethod()
        
        return true;
    }
    
    /**
     * Ejemplo de error: división por cero
     */
    protected function ejemploDivisionPorCero()
    {
        // Ejemplo de error: división por cero
        $value = 100 / 0; // Error: Division by zero
        
        return Response::json(['error' => 'Error de división'], 500);
    }
    
    /**
     * Ejemplo de error: tipo de dato incorrecto
     */
    protected function ejemploTipoDatoIncorrecto()
    {
        // Ejemplo de error: pasar un tipo de dato incorrecto a una función
        $obj = new stdClass();
        $length = strlen($obj); // Error: strlen() expects parameter 1 to be string, object given
        
        return Response::json(['error' => 'Error de tipo de dato'], 500);
    }
}
