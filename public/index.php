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
    <link rel="stylesheet" href="../public/assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
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
    </script>
</head>
<body class="bg-blue-dark-agenda">
    <section class="max-w-6xl mx-auto p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Column 1 -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form id="realStateAgendaForm" action="../admin/controller/AdminController.php" method="post">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" id="first-name" autocomplete="first-name" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                                <div class="mt-2">
                                    <input type="text" name="last-name" id="last-name" autocomplete="last-name" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Número de teléfono</label>
                                <div class="mt-2">
                                    <input type="text" name="phone" id="phone" autocomplete="phone" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button type="submit" id="submitRealStateAgenda" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:bg-gray-400 disabled:cursor-not-allowed" disabled>Save</button>
                </div>
            </form>
        </div>

        <!-- Column 2 -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Column 2</h2>
            <p class="text-gray-600">This is the content for the second column. You can customize this section with Tailwind's utility classes.</p>
        </div>
        </div>
  </section>
    <section class="bg-gray-light validate-box">        
        <div class="address-validate">
            <div class="d-space-between">
                <button class='btn-secondary roboto-medium' onclick="goRegisters()">Ver registros</button>
            </div>


        </div>        
    </section>
     <script>
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
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.getElementById('realStateAgendaForm');
            const submitBtn = document.getElementById('submitRealStateAgenda');
            
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
                    submitBtn.classList.remove('bg-gray-400');
                    submitBtn.classList.add('bg-indigo-600');
                } else {
                    submitBtn.setAttribute('disabled', 'disabled');
                    submitBtn.classList.remove('bg-indigo-600');
                    submitBtn.classList.add('bg-gray-400');
                }
            };
            console.log("----- validate form", validateForm)
            form.addEventListener('input', validateForm);

            // Run validation on page load in case form is prefilled
            validateForm();
        });
    </script>
</body>
</html>