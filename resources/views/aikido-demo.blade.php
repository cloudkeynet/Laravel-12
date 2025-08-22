<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo de Aikido.dev - Errores PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-radius: 8px;
            background-color: #f8f9fa;
            border-left: 5px solid #dc3545;
        }
        .code-block {
            background-color: #272822;
            color: #f8f8f2;
            padding: 1rem;
            border-radius: 4px;
            margin: 1rem 0;
            overflow-x: auto;
        }
        h2 {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Demo de Aikido.dev - Errores PHP Comunes</h1>
        <p class="lead">Esta página contiene ejemplos de errores comunes en PHP para demostrar las capacidades de detección de Aikido.dev</p>
        
        <div class="error-section">
            <h2>1. Errores Básicos de PHP</h2>
            <p>Ejemplos de errores sintácticos y lógicos básicos en PHP.</p>
            <div class="code-block">
                <pre>// Error 1: Variable indefinida
$result = $undefinedVariable;

// Error 2: Operación con tipos incompatibles
$value = 10 + "20abc";

// Error 3: División por cero
$division = 100 / 0;

// Error 4: Índice de array indefinido
$array = [];
$item = $array['key'];</pre>
            </div>
            <button class="btn btn-danger" onclick="testEndpoint('/aikido-demo/basic-errors')">Probar Errores Básicos</button>
        </div>
        
        <div class="error-section">
            <h2>2. Errores de Validación</h2>
            <p>Ejemplos de errores comunes en la validación de datos de entrada.</p>
            <div class="code-block">
                <pre>// Error 1: No validar datos de entrada
$email = $request->input('email');
$password = $request->input('password');

// Error 2: Usar datos sin validar
DB::table('users')->insert([
    'email' => $email,
    'password' => $password // Error: No usar hash para contraseñas
]);</pre>
            </div>
            <form id="validationForm" class="mb-3">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="invalid-email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" value="123">
                </div>
                <button type="button" class="btn btn-danger" onclick="testValidationErrors()">Probar Errores de Validación</button>
            </form>
        </div>
        
        <div class="error-section">
            <h2>3. Errores de Base de Datos</h2>
            <p>Ejemplos de errores comunes al trabajar con bases de datos.</p>
            <div class="code-block">
                <pre>// Error 1: Consulta SQL incorrecta
$results = DB::select('SELECT * FROM non_existent_table');

// Error 2: No manejar excepciones de base de datos
$user = DB::table('users')->where('id', 999999)->firstOrFail();

// Error 3: Inyección SQL
$userId = request('user_id');
$results = DB::select("SELECT * FROM users WHERE id = $userId");</pre>
            </div>
            <button class="btn btn-danger" onclick="testEndpoint('/aikido-demo/database-errors')">Probar Errores de Base de Datos</button>
        </div>
        
        <div class="error-section">
            <h2>4. Errores de Autenticación/Autorización</h2>
            <p>Ejemplos de errores comunes en la autenticación y autorización.</p>
            <div class="code-block">
                <pre>// Error 1: No verificar autenticación
$user = Auth::user(); // Podría ser null
$userData = $user->toArray(); // Error si $user es null

// Error 2: No verificar permisos
$adminData = DB::table('admin_settings')->get();

// Error 3: Hardcodear credenciales
$apiKey = "sk_test_ejemplo123456789FakeKeyParaDemostracion";</pre>
            </div>
            <button class="btn btn-danger" onclick="testEndpoint('/aikido-demo/auth-errors')">Probar Errores de Autenticación</button>
        </div>
        
        <div class="error-section">
            <h2>5. Errores de Manejo de Archivos</h2>
            <p>Ejemplos de errores comunes al trabajar con archivos.</p>
            <div class="code-block">
                <pre>// Error 1: No validar archivos subidos
if ($request->hasFile('document')) {
    $file = $request->file('document');
    // No se valida tipo, tamaño, etc.
}

// Error 2: Permisos incorrectos
$content = file_get_contents('/etc/passwd');

// Error 3: Rutas de archivo inseguras
$fileName = $request->input('filename');
$fileContent = file_get_contents("../storage/app/" . $fileName);</pre>
            </div>
            <form id="fileForm" class="mb-3" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="document" class="form-label">Archivo</label>
                    <input type="file" class="form-control" id="document" name="document">
                </div>
                <div class="mb-3">
                    <label for="filename" class="form-label">Nombre de archivo</label>
                    <input type="text" class="form-control" id="filename" name="filename" value="../config/app.php">
                </div>
                <button type="button" class="btn btn-danger" onclick="testFileErrors()">Probar Errores de Archivos</button>
            </form>
        </div>
        
        <div class="error-section">
            <h2>6. Errores de Rendimiento</h2>
            <p>Ejemplos de errores que afectan el rendimiento de la aplicación.</p>
            <div class="code-block">
                <pre>// Error 1: Consulta N+1
$users = User::all();
foreach ($users as $user) {
    $orders = $user->orders; // Esto genera una consulta por cada usuario
}

// Error 2: Carga de datos innecesarios
$allUsers = DB::table('users')->get();

// Error 3: No usar paginación
$allPosts = DB::table('posts')->get(); // Podría devolver miles de registros</pre>
            </div>
            <button class="btn btn-danger" onclick="testEndpoint('/aikido-demo/performance-errors')">Probar Errores de Rendimiento</button>
        </div>
        
        <div class="error-section">
            <h2>7. Errores de Seguridad</h2>
            <p>Ejemplos de errores que comprometen la seguridad de la aplicación.</p>
            <div class="code-block">
                <pre>// Error 1: XSS - Cross-Site Scripting
$input = $request->input('comment');
return response('<div>' . $input . '</div>'); // No se escapa el input

// Error 2: Asignación masiva insegura
$user = new User();
$user->fill($request->all()); // Podría permitir cambiar campos protegidos
$user->save();</pre>
            </div>
            <form id="securityForm" class="mb-3">
                <div class="mb-3">
                    <label for="comment" class="form-label">Comentario (prueba XSS)</label>
                    <input type="text" class="form-control" id="comment" name="comment" value="<script>alert('XSS')</script>">
                </div>
                <button type="button" class="btn btn-danger" onclick="testSecurityErrors()">Probar Errores de Seguridad</button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Respuesta del Servidor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <pre id="responseContent" class="bg-dark text-light p-3 rounded"></pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const responseModal = new bootstrap.Modal(document.getElementById('responseModal'));
        
        function showResponse(response) {
            document.getElementById('responseContent').textContent = JSON.stringify(response, null, 2);
            responseModal.show();
        }
        
        function handleError(error) {
            document.getElementById('responseContent').textContent = 'Error: ' + error.message;
            responseModal.show();
        }
        
        function testEndpoint(url) {
            fetch(url)
                .then(response => response.json())
                .then(data => showResponse(data))
                .catch(error => handleError(error));
        }
        
        function testValidationErrors() {
            const formData = new FormData(document.getElementById('validationForm'));
            fetch('/aikido-demo/validation-errors', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => showResponse(data))
            .catch(error => handleError(error));
        }
        
        function testFileErrors() {
            const formData = new FormData(document.getElementById('fileForm'));
            fetch('/aikido-demo/file-errors', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => showResponse(data))
            .catch(error => handleError(error));
        }
        
        function testSecurityErrors() {
            const formData = new FormData(document.getElementById('securityForm'));
            fetch('/aikido-demo/security-errors', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('responseContent').textContent = data;
                responseModal.show();
            })
            .catch(error => handleError(error));
        }
    </script>
</body>
</html>
