<?php
    // Ruta al archivo JSON de planes pospago
    $pathJSON = '../../data/data-form.json';
    $jsonDataForm = file_get_contents($pathJSON);

    //echo "<script>console.log('Debug Objects: " . $jsonContent . "' );</script>";

    // Verificar si se pudo leer el archivo
    if ($jsonDataForm === false) {
        die('Error al leer el archivo JSON');
    }
    // Decodificar el JSON en un array asociativo
    $getDataUsers = json_decode($jsonDataForm, true);

    // echo "<pre>";  // Esto es solo para hacer la salida más legible en el navegador
    // print_r($getDataUsers);
    // echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/table.css">
    <link rel="stylesheet" href="../../public/assets/css/styles.css">
    <link rel="stylesheet" href="../../public/assets/css/buttons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Listado de usuarios sin cobertura</title>
</head>
<body>
    <section class="bg-gray-light validate-box">        
        <div class="view-users">
            <div class="go-back roboto-regular" onclick="goBack()">
                <img src="../../public/assets/icons/arrow-left.svg" alt="go back" />
                Volver
            </div>
            <div class="d-space-between">
                <h2 class="mb-0 roboto-medium">¡Registro de usuarios!</h2>
                <!-- <button class='btn-secondary roboto-medium' onclick="goAddRegister()">Nuevo usuario</button> -->
            </div>
            <div class="table-users bg-white">
                <?php foreach ($getDataUsers as $user): ?>
                    <div class="t-responsive">
                        <div class="head">
                            <div class="column-head">Nombre</div>
                            <div class="column-head">Apellido</div>
                            <div class="column-head">Email</div>
                            <div class="column-head">Número de teléfono</div>
                        </div>
                        <div class="row">
                            <div class="data-user"><?= $user['first_name'] ?></div>
                            <div class="data-user"><?= $user['last_name'] ?></div>
                            <div class="data-user"><?= $user['email'] ?></div>
                            <div class="data-user"><?= $user['phone'] ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>        
    </section>    
    <script>
        function onLoadAndResize(){
            const widthScreen = window.innerWidth;
            const headTable = document.querySelectorAll(".head");

            if(widthScreen < 768) {
                headTable.forEach((element, index) => {
                    element.style.display = 'block';
                })
            } else { 
                headTable.forEach((element, index) => {
                    if(index !== 0){
                        element.style.display = 'none';
                    } else {
                        element.style.display = 'grid';
                    }
                })
            }
        };

        // Agregamos un event listener para el evento 'load' de la ventana
        window.addEventListener('load', onLoadAndResize);

        // Agregamos un event listener para el evento 'resize' de la ventana
        window.addEventListener('resize', onLoadAndResize);

        function goBack() {
            window.location.href = "../../public/";
        }
        
        function goAddRegister() {
            window.location.href = "../../public/";
        } 

    </script>
</body>
</html>