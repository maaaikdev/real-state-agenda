<?php
    // Ruta al archivo JSON de planes pospago
    $pathJSON = '../data/colombia.min.json';
    $jsonContent = file_get_contents($pathJSON);

    //echo "<script>console.log('Debug Objects: " . $jsonContent . "' );</script>";

    // Verificar si se pudo leer el archivo
    if ($jsonContent === false) {
        die('Error al leer el archivo JSON');
    }
    // Decodificar el JSON en un array asociativo
    $dataArray = json_decode($jsonContent, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real State Agenda</title>
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
    <link rel="stylesheet" href="assets/css/styles.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- <script>
        function updateOptions(value){
            const datos = <?php echo json_encode($dataArray); ?>;
            const citySelected = document.getElementById("city");
            citySelected.innerHTML = '';
            const citysList = datos.find(dep => dep.departamento == value);
            citysList.ciudades.forEach(city => {
                const option = document.createElement("option");
                option.value = city;
                option.text = city;
                citySelected.add(option);
            });
        }
    </script> -->
</head>
<body class="bg-blue-dark-agenda flex items-center justify-center h-full lg:h-screen">
    <section class="max-w-6xl mx-auto sm:p-4 lg:p-8">
        <div class="flex flex-col lg:flex-row gap-0 lg:gap-6 items-center">
        <!-- Column 1 -->
        <div class="p-6 w-full lg:w-2/5 border rounded-lg border-transparent lg:border-gray-500 order-2 lg:order-1">
            <form id="realStateAgendaForm" action="../admin/controller/AdminController.php" method="post">
                <div class="space-y-12">
                    <div class="pb-3">
                        <!-- <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2> -->
                        <h2 class="roboto-extralight text-xl lg:text-3xl mt-1 text-white leading-7 lg:leading-10">Descarga tu mapa de Acción Rápida con los <strong class="roboto-medium">9 pasos clave ahora mismo.</strong></h2>
                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-4 lg:gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <label for="names" class="block text-sm font-medium leading-6 text-white">Nombre y Apellido</label>
                                <div class="mt-2 relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="names" id="names" autocomplete="names" class="block w-full rounded-md border-0 py-1.5 pl-10 pr-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="phone" class="block text-sm font-medium leading-6 text-white">Teléfono</label>
                                <div class="mt-2 relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="text" name="phone" id="phone" autocomplete="phone" class="block w-full rounded-md border-0 py-1.5 pl-10 pr-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="email" class="block text-sm font-medium leading-6 text-white">Correo electrónico</label>
                                <div class="mt-2 relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 pl-10 pr-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <!-- <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button> -->
                    <button type="submit" id="submitRealStateAgenda" class="bg-gray-400 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:bg-gray-300 disabled:cursor-not-allowed" disabled>Descargar agenda</button>
                </div>
            </form>
            <!-- Mensaje de éxito -->
            <div id="successMessage" style="display: none;" class="text-center">
                <h2 class="text-xl lg:text-2xl font-bold text-green-500 leading-7 lg:leading-10">¡Formulario enviado con éxito!</h2>
                <p class="roboto-light text-white">Gracias por completar el formulario. Recibirás tu mapa de acción rápidamente.</p>
            </div>
        </div>

        <!-- Column 2 -->
        <div class="p-6 w-full lg:w-3/5 flex items-center justify-center flex flex-col text-center order-1 lg:order-2">
            <!-- <h2 class="text-2xl font-bold text-gray-800 mb-4">Column 2</h2>
            <p class="text-gray-600">This is the content for the second column. You can customize this section with Tailwind's utility classes.</p> -->
            <h2 class="roboto-medium text-yellow-500 text-base lg:text-xl text-white leading-8 lg:leading-8 uppercase">Mapa gratuito de acción rápida</h2>
            <p class="roboto-light text-white text-base lg:text-xl text-white leading-6 lg:leading-7 pb-6">El mapa para crear el libro que te convertirá en el referente de industria</p>
            <img src="./assets/images/agenda.jpg" alt="Agenda Inmobiliaria" class="w-70 lg:w-full"/>
        </div>
        </div>
  </section>
    <!-- <section class="bg-gray-light validate-box">        
        <div class="address-validate">
            <div class="d-space-between">
                <button class='btn-secondary roboto-medium' onclick="goRegisters()">Ver registros</button>
            </div>
        </div>        
    </section> -->
     <!-- <script>
        const inputsField = document.querySelectorAll(".label-box");

        for(i = 0; inputsField.length > i; i++){
            const input = inputsField[i]
            if(input.clientWidth < 120) {
                input.children[1].children[0].classList.add("truncate")
            } else {
                input.children[1].children[0].classList.remove("truncate");                
            }
        }

        function goRegisters() {
            window.location.href = "../admin/view/ViewUser.php";
        }
    </script> -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.getElementById('realStateAgendaForm');
            const submitBtn = document.getElementById('submitRealStateAgenda');
            const successMessage = document.getElementById('successMessage');
            
            const validateForm = () => {
                let isValid = true;
                const inputs = form.querySelectorAll('input[required]');
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                    }
                });
                
                if (isValid) {
                    submitBtn.removeAttribute('disabled');
                    submitBtn.classList.remove('bg-gray-300');
                    submitBtn.classList.add('bg-yellow-500');
                } else {
                    submitBtn.setAttribute('disabled', 'disabled');
                    submitBtn.classList.remove('bg-yellow-500');
                    submitBtn.classList.add('bg-gray-300');
                }
            };
            form.addEventListener('input', validateForm);

            // Run validation on page load in case form is prefilled
            validateForm();

            // Al enviar el formulario
            form.addEventListener('submit', function (event) {
                //event.preventDefault(); // Prevenir el envío tradicional

                // Lógica para enviar el formulario por AJAX si es necesario
                // Aquí podrías usar fetch() o XMLHttpRequest para enviar los datos al servidor

                // Ocultar el formulario y mostrar el mensaje de éxito
                form.style.display = 'none';
                successMessage.style.display = 'block';
            });
        });
    </script>
</body>
</html>