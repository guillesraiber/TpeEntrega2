<?php
// Incluimos los modelos y vistas necesarios para el controlador
require_once './app/models/UserModel.php';
require_once './app/views/authView.php';

// Definición de la clase AuthController, que manejará la autenticación
class AuthController {
    private $model; // Instancia del modelo de usuario
    private $view;  // Instancia de la vista de autenticación

    // Constructor que inicializa el modelo y la vista
    public function __construct() {
        $this->model = new UserModel(); // Crea una nueva instancia de UserModel
        $this->view = new AuthView();    // Crea una nueva instancia de AuthView
    }

    // Método para mostrar el formulario de login
    public function showLogin() {
        // Muestro el formulario de login llamando a la vista
        return $this->view->showLogin();
    }

    // Método para manejar el proceso de login
    public function login() {
        // Verifica si el campo 'name' está presente y no está vacío
        if (!isset($_POST['name']) || empty($_POST['name'])) {
            return $this->view->showLogin('Falta completar el nombre de usuario');
        }
    
        // Verifica si el campo 'password' está presente y no está vacío
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falta completar la contraseña');
        }
    
        $name = $_POST['name'];
        $password = $_POST['password'];
    
        // Obtiene el usuario de la base de datos utilizando el nombre
        $userFromDB = $this->model->getUserByName($name);
    
        // Verificación del usuario y la contraseña
        if ($userFromDB) {
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->ID_Usuario;
            $_SESSION['NAME_USER'] = $userFromDB->Nombre; // Asegúrate que se guarda correctamente el nombre del usuario
            $_SESSION['ROLE_USER'] = $userFromDB->es_admin ? 'admin' : 'user'; // Verifica que se guarda el rol
            header('Location: ' . BASE_URL . 'libros');
            exit();
        } else {
            return $this->view->showLogin("Contraseña incorrecta");
        }
    }
    
    // Método para cerrar sesión
    public function logout() {
        session_start();
        session_destroy();  // Destruir la sesión
        header('Location: ' . BASE_URL . 'showLogin');  // Redirigir a la página de inicio de sesión
        exit();
    }
}
   
