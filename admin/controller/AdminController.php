<?php 

class AdminController {

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los valores del formulario
            $firstName = isset($_POST['first-name']) ? $_POST['first-name'] : '';
            $lastName = isset($_POST['last-name']) ? $_POST['last-name'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

            // Ruta al archivo JSON
            $jsonFile = '../../data/data-form.json';

            // Verificar si el archivo existe y tiene contenido
            if (file_exists($jsonFile) && filesize($jsonFile) > 0) {
                // Leer el contenido existente
                $jsonData = file_get_contents($jsonFile);
                $datos = json_decode($jsonData, true); // Decodificar el contenido JSON en un array
            } else {
                // Crear un nuevo array si el archivo no existe o está vacío
                $datos = [];
            }

            // Añadir los nuevos datos al array
            $datos[] = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone,
            ];

            // Codificar los datos actualizados a formato JSON
            $jsonDataUpdated = json_encode($datos, JSON_PRETTY_PRINT);

            // Verificar que la ruta y el archivo existan y sean accesibles
            if (!is_writable($jsonFile)) {
                echo "El archivo JSON no tiene permisos de escritura o la ruta es incorrecta: " . realpath($jsonFile);
                exit(); // Detener la ejecución si el archivo no es escribible
            }

            // Intentar guardar los datos en el archivo JSON
            if (file_put_contents($jsonFile, $jsonDataUpdated) === false) {
                echo "Hubo un error al intentar guardar los datos en el archivo JSON.";
                exit(); // Detener la ejecución
            } else {
                // Si la operación fue exitosa, redirigir al usuario
                $this->downloadPDF('mi-agenda-inteligente-1.pdf');
                //$this->redirect('../view/ViewUser.php');
            }
        }
    }

    private function downloadPDF($fileName) {
        // Ruta al archivo PDF
        $filePath = '../../data/' . $fileName; // Ajusta esta ruta según tu estructura de archivos

        // Verificar si el archivo existe
        if (file_exists($filePath)) {
            // Configurar las cabeceras para la descarga
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));

            // Limpiar el buffer de salida
            ob_clean();
            flush();

            // Leer el archivo y enviarlo al navegador
            readfile($filePath);
            exit(); // Asegúrate de detener la ejecución después de la descarga
        } else {
            echo "El archivo no existe.";
            exit(); // Detener la ejecución si el archivo no se encuentra
        }
    }

    private function redirect($location) {
        header("Location: $location");
        exit();
    }
}

$adminController = new AdminController();
$adminController->handleRequest();

?>