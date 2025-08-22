<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use stdClass;

class AikidoDemoController extends Controller
{
    /**
     * Mostrar errores básicos de PHP
     */
    public function basicErrors()
    {
        // Error 1: Variable indefinida
        $result = $undefinedVariable;
        
        // Error 2: Operación con tipos incompatibles
        $value = 10 + "20abc";
        
        // Error 3: División por cero
        $division = 100 / 0;
        
        // Error 4: Índice de array indefinido
        $array = [];
        $item = $array['key'];
        
        return response()->json(['message' => 'Errores básicos de PHP']);
    }
    
    /**
     * Mostrar errores de validación
     */
    public function validationErrors(Request $request)
    {
        // Error 1: No validar datos de entrada
        $email = $request->input('email');
        $password = $request->input('password');
        
        // Error 2: Usar datos sin validar
        DB::table('users')->insert([
            'email' => $email,
            'password' => $password // Error: No usar hash para contraseñas
        ]);
        
        // Error 3: Validación incorrecta
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            // Falta validación de formato de email
        ]);
        
        // Error 4: No manejar errores de validación
        if ($validator->fails()) {
            // No se hace nada con los errores
        }
        
        return response()->json(['message' => 'Datos procesados']);
    }
    
    /**
     * Mostrar errores de base de datos
     */
    public function databaseErrors()
    {
        // Error 1: Consulta SQL incorrecta
        $results = DB::select('SELECT * FROM non_existent_table');
        
        // Error 2: No manejar excepciones de base de datos
        $user = DB::table('users')->where('id', 999999)->firstOrFail();
        
        // Error 3: Inyección SQL
        $userId = request('user_id');
        $results = DB::select("SELECT * FROM users WHERE id = $userId");
        
        // Error 4: No usar transacciones para operaciones múltiples
        DB::table('orders')->insert(['user_id' => 1, 'total' => 100]);
        DB::table('order_items')->insert(['order_id' => DB::getPdo()->lastInsertId(), 'product_id' => 1]);
        
        return response()->json(['data' => $results]);
    }
    
    /**
     * Mostrar errores de autenticación/autorización
     */
    public function authErrors()
    {
        // Error 1: No verificar autenticación
        $user = Auth::user(); // Podría ser null
        $userData = $user->toArray(); // Error si $user es null
        
        // Error 2: No verificar permisos
        $adminData = DB::table('admin_settings')->get();
        
        // Error 3: Hardcodear credenciales
        $apiKey = "sk_test_ejemplo123456789FakeKeyParaDemostracion";
        
        // Error 4: No usar CSRF protection
        // Falta token CSRF en formularios
        
        return response()->json(['user' => $userData, 'admin' => $adminData]);
    }
    
    /**
     * Mostrar errores de manejo de archivos
     */
    public function fileErrors(Request $request)
    {
        // Error 1: No validar archivos subidos
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            // No se valida tipo, tamaño, etc.
        }
        
        // Error 2: Permisos incorrectos
        $content = file_get_contents('/etc/passwd');
        
        // Error 3: Rutas de archivo inseguras
        $fileName = $request->input('filename');
        $fileContent = file_get_contents("../storage/app/" . $fileName);
        
        // Error 4: No manejar errores de archivo
        $handle = fopen('/path/to/non/existent/file.txt', 'r');
        $content = fread($handle, 1024);
        fclose($handle);
        
        return response()->json(['message' => 'Archivos procesados']);
    }
    
    /**
     * Mostrar errores de rendimiento
     */
    public function performanceErrors()
    {
        // Error 1: Consulta N+1
        $users = User::all();
        foreach ($users as $user) {
            $orders = $user->orders; // Esto genera una consulta por cada usuario
        }
        
        // Error 2: Carga de datos innecesarios
        $allUsers = DB::table('users')->get();
        
        // Error 3: No usar paginación
        $allPosts = DB::table('posts')->get(); // Podría devolver miles de registros
        
        // Error 4: Bucle ineficiente
        $result = [];
        for ($i = 0; $i < 10000; $i++) {
            array_push($result, DB::table('settings')->where('id', $i)->first());
        }
        
        return response()->json(['message' => 'Operación completada']);
    }
    
    /**
     * Mostrar errores de seguridad
     */
    public function securityErrors(Request $request)
    {
        // Error 1: XSS - Cross-Site Scripting
        $input = $request->input('comment');
        return response('<div>' . $input . '</div>'); // No se escapa el input
        
        // Error 2: Asignación masiva insegura
        $user = new User();
        $user->fill($request->all()); // Podría permitir cambiar campos protegidos
        $user->save();
        
        // Error 3: Información sensible en logs
        Log::info('Usuario inició sesión', [
            'email' => $request->input('email'),
            'password' => $request->input('password') // ¡Nunca loguear contraseñas!
        ]);
        
        // Error 4: Cabeceras de seguridad faltantes
        return response()->json(['data' => 'información sensible'])
            ->header('Access-Control-Allow-Origin', '*'); // Demasiado permisivo
    }
}
