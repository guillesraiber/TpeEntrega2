<?php 
require_once 'libs/response.php';
require_once './app/controllers/CategoriaController.php';
require_once './app/controllers/AuthController.php';
require_once './app/controllers/LibroController.php';
require_once './app/controllers/middlewares/admin.auth.middleware.php'; 
require_once './app/controllers/middlewares/session.auth.middleware.php';
require_once './app/controllers/PedidoController.php';

// Definir base_url para redirecciones y base tag
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// Acción por defecto
$action = 'libros';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Parsear la acción para separar parámetros
$params = explode('/', $action);

// Crear la instancia de respuesta
$res = new Response();

// Aplicar middleware de autenticación de sesión globalmente, si es necesario
sessionAuthMiddleware($res);

// Crear las instancias de los controladores
$authController = new AuthController();
$categoriaController = new CategoriaController($res);
$libroController = new LibroController($res);
$pedidoController = new PedidoController($res);

switch ($params[0]) {
    // Todo lo relacionado a libros
    case 'libros':
        $libroController->listarLibros();
        break;

    case 'admin':
        if (isset($params[1]) && $params[1] === 'login') {
            $authController->login();
        } else {
            echo "404 Admin Action Not Found";
        }
        break;

    case 'eliminarLibro':
        if (isset($params[1])) {
            adminAuthMiddleware($res); // Verificar si el usuario es admin
            $libroController->eliminarLibro($params[1]); // Supone que se pasa un ID en la URL
        } else {
            echo "Error: ID del libro requerido.";
        }
        break;

    case 'detallarLibro':
        if (isset($params[1])) {
            $libroController->detalleLibro($params[1]); // Supone que se pasa un ID en la URL
        } else {
            echo "Error: ID del libro requerido.";
        }
        break;

    case 'crearLibro':
        adminAuthMiddleware($res); // Verificar si el usuario es admin
        $libroController->crearLibro();
        break;

    case 'editarLibro':
        if (isset($params[1])) {
            adminAuthMiddleware($res); // Verificar si el usuario es admin
            $libroController->editarLibro($params[1]);
        } else {
            echo "Error: ID del libro requerido.";
        }
        break;

    case 'listarCategorias':
        $categoriaController->listar();
        break;

    case 'librosPorCategoria':
        if (isset($params[1])) {
            $categoriaController->listarPorCategoria($params[1]);
        } else {
            echo "Error: ID de la categoría requerido.";
        }
        break;

    case 'editarCategoria':
        if (isset($params[1])) {
            adminAuthMiddleware($res); // Verificar si el usuario es admin
            $categoriaController->editarCategoria($params[1]);
        } else {
            echo "Error: ID de la categoría requerido.";
        }
        break;

    case 'eliminarCategoria':
        if (isset($params[1])) {
            adminAuthMiddleware($res); // Verificar si el usuario es admin
            $categoriaController->eliminarCategoria($params[1]);
        } else {
            echo "Error: ID de la categoría requerido.";
        }
        break;
    case 'pedidos':
        adminAuthMiddleware($res); // Verificar si el usuario es admin
        $pedidoController->ListarPedidos();
        break;


        case 'crearPedido':
// Asegúrate de que $res tenga la información que esperas, como el usuario
            $res = (object) ['user' => 'nombre_del_usuario'];

            // Crear una instancia del controlador con el parámetro correcto
            $pedidoController = new PedidoController($res);

            // Llamar al método crearPedido
            $pedidoController->crearPedido();

        
        case 'editarPedido':
            if (isset($params[1])) {
                adminAuthMiddleware($res);
                $pedidoController->editarPedido($params[1]);
            } else {
                echo "Error: ID del pedido requerido.";
            }
            break;
        
        case 'eliminarPedido':
            if (isset($params[1])) {
                adminAuthMiddleware($res);
                $pedidoController->eliminarPedido($params[1]);
            } else {
                echo "Error: ID del pedido requerido.";
            }
            break;
        

    case 'showLogin':
        $authController->showLogin();
        break;

    case 'login':
        $authController->login();
        break;

    case 'logout':
        $authController->logout();
        break;

    default:
        echo "404 Page Not Found";
        break;
}
