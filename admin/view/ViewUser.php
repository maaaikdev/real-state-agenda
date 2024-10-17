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
    <link rel="stylesheet" href="../../public/assets/css/table.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../public/assets/css/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../public/assets/css/buttons.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <title>Listado de usuarios sin cobertura</title>
</head>
<body class="bg-gray-light">
    <section class="validate-box">        
        <div class="view-users">
            <div class="d-space-between">
                <h2 class="mb-0 roboto-medium text-sm lg:text-base">¡Registro de usuarios!</h2>
                <button onclick="exportToExcel()" class="roboto-medium bg-green-600 hover:bg-green-500 text-white text-sm lg:text-base py-2 px-4 rounded">Descargar Excel</button>
            </div>
            <div class="table-users bg-white">
                <?php foreach ($getDataUsers as $index => $user): ?>
                    <div class="t-responsive" id="userTable">
                        <div class="head">
                            <div class="column-head">Nombre</div>
                            <div class="column-head">Teléfono</div>
                            <div class="column-head">Email</div>
                            <div class="column-head">Fecha</div>
                            <div class="column-head">Acciones</div>
                        </div>
                        <div class="row">
                            <div class="data-user"><?= $user['names'] ?></div>
                            <div class="data-user"><?= $user['phone'] ?></div>
                            <div class="data-user"><?= $user['email'] ?></div>
                            <div class="data-user"><?= isset($user['dateCreated']) ? $user['dateCreated'] : 'N/A' ?></div> <!-- Fecha de creación -->
                            <button onclick="deleteRecord(<?= $index ?>)" class="btn-delete">
                                <i class="fas fa-trash-alt"></i> 
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>        
    </section>
    <script>
        function deleteRecord(index) {
            if (confirm("¿Estás seguro de que quieres eliminar este registro?")) {
                // Hacer una solicitud AJAX al backend para eliminar el registro
                fetch('../controller/delete-user.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ index: index })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("DATA----", data)
                    if (data.success) {
                        // Recargar la página o actualizar la tabla dinámicamente
                        location.reload();
                    } else {
                        alert('Error al eliminar el registro.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
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
        window.addEventListener('load', onLoadAndResize);

        window.addEventListener('resize', onLoadAndResize);

    </script>
    <script>
    
        function exportToExcel() {
            fetch('../../data/data-form.json')
                .then(response => response.json())
                .then(data => {
                    var excelData = [["Nombre", "Teléfono", "Email", "Fecha"]];

                    data.forEach(item => {
                        excelData.push([item.names, item.phone, item.email, item.dateCreated]);
                    });

                    var wb = XLSX.utils.book_new();
                    var ws = XLSX.utils.aoa_to_sheet(excelData);
                    XLSX.utils.book_append_sheet(wb, ws, "Usuarios");

                    XLSX.writeFile(wb, "usuarios_registro.xlsx");
                })
                .catch(error => {
                    console.error('Error al obtener los datos del archivo JSON:', error);
                });
        }
        document.querySelector("button").addEventListener("click", exportToExcel);    
    </script>


</body>
</html>