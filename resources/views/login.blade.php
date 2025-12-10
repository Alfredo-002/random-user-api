<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-200 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-xl p-10 w-full max-w-md text-center">

        <h1 class="text-2xl font-bold text-gray-700 mb-6">
            Bienvenido
        </h1>

        <p class="text-gray-500 mb-8">
            Inicia secion en corto
        </p>

        <!-- BOTÓN INICIAR SESIÓN -->
        <a href="{{ route('login') }}"
           class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition mb-4">
            Iniciar Sesión
        </a>

        <!-- BOTÓN CREAR CUENTA -->
        <a href="/register"
           class="block w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
            Crear Nueva Cuenta
        </a>

    </div>

</body>
</html>
