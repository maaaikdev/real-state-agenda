<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real State Agenda</title>
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
    <link rel="stylesheet" href="./public/assets/css/styles.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body class="bg-blue-dark-agenda flex items-center justify-center h-full lg:h-screen">
    <section class="max-w-6xl mx-auto sm:p-4 lg:p-8">
        <div class="flex flex-col lg:flex-row gap-0 lg:gap-6 items-center">
            <div class="p-6 w-full lg:w-2/5 border rounded-lg border-transparent lg:border-gray-500 order-2 lg:order-1">
                <form id="realStateAgendaForm" action="./admin/controller/AdminController.php" method="post">
                    <div class="space-y-12">
                        <div class="pb-3">
                            <h2 class="roboto-extralight text-xl lg:text-3xl mt-1 text-white leading-7 lg:leading-10">¡Aquí está tu regalo! <br /><strong class="roboto-medium">Obtén información valiosa de la edición 2024.</strong></h2>
                            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-4 lg:gap-y-8 sm:grid-cols-6">
                                <div class="col-span-full">
                                    <label for="names" class="block text-sm font-medium leading-6 text-white">Nombre y Apellido</label>
                                    <div class="mt-2 relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" name="names" id="names" autocomplete="names" class="block w-full rounded-md border-0 py-1.5 pl-10 pr-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                    </div>
                                    <p id="error-names" class="text-red-500 text-sm mt-1 hidden">Error e
                                </div>

                                <div class="col-span-full">
                                    <label for="phone" class="block text-sm font-medium leading-6 text-white">Teléfono</label>
                                    <div class="mt-2 relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <input type="text" name="phone" id="phone" autocomplete="phone" class="block w-full rounded-md border-0 py-1.5 pl-10 pr-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                    </div>
                                    <p id="error-phone" class="text-red-500 text-sm mt-1 hidden">Error en teléfono.</p> <!-- Mensaje de error -->
                                </div>

                                <div class="col-span-full">
                                    <label for="email" class="block text-sm font-medium leading-6 text-white">Correo electrónico</label>
                                    <div class="mt-2 relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 pl-10 pr-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                    </div>
                                    <p id="error-email" class="text-red-500 text-sm mt-1 hidden">Error en correo.</p> <!-- Mensaje de error -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit" id="submitRealStateAgenda" class="bg-gray-400 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:bg-gray-300 disabled:cursor-not-allowed" disabled>Descargar gratuita</button>
                    </div>
                </form>
                <div id="successMessage" style="display: none;" class="text-center">
                    <h2 class="text-xl lg:text-2xl font-bold text-green-500 leading-7 lg:leading-10">¡Formulario enviado con éxito!</h2>
                    <p class="roboto-light text-white">Gracias por completar el formulario. Recibirás tu mapa de acción rápidamente.</p>
                </div>
            </div>

            <div class="p-6 w-full lg:w-3/5 flex items-center justify-center flex flex-col text-center order-1 lg:order-2">
                <h1 class="roboto-light text-yellow-500 text-lg lg:text-2xl text-white leading-6 lg:leading-8">¡Accede algunas de las herramientas de la edición 2024 de tu Agenda Inteligente!</h1>
                <p class="roboto-light text-white text-sm lg:text-base text-white leading-5 lg:leading-6 pb-6 mt-4">Mantente siempre actualizado y sigue optimizando tu productividad con recursos diseñados para ayudarte a alcanzar tus objetivos de manera eficiente. <br/><br/> ¡Transforma tu forma de trabajar!</p>
                <img src="./public/assets/images/agenda.jpg" alt="Agenda Inmobiliaria" class="w-70 lg:w-96"/>
            </div>
        </div>
    </section>
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

            validateForm();

            // Al enviar el formulario
            form.addEventListener('submit', function (event) {
                form.style.display = 'none';
                successMessage.style.display = 'block';
            });
        });
    </script>
    <script>
        const nameInput = document.getElementById('names');
        const phoneInput = document.getElementById('phone');
        const emailInput = document.getElementById('email');

        // Elementos para los mensajes de error
        const errorName = document.getElementById('error-names');
        const errorPhone = document.getElementById('error-phone');
        const errorEmail = document.getElementById('error-email');

        // Validar nombre (solo letras y espacios)
        nameInput.addEventListener('input', function () {
            const nameRegex = /^[a-zA-Z\s]*$/;
            if (!nameRegex.test(nameInput.value)) {
                nameInput.classList.add('border-red-500');  // Añadir borde rojo
                errorName.textContent = 'Solo se permiten letras y espacios.';  // Mensaje de error
                errorName.classList.remove('hidden');  // Mostrar mensaje
            } else {
                nameInput.classList.remove('border-red-500');  // Quitar borde rojo
                errorName.classList.add('hidden');  // Ocultar mensaje
            }
        });

        // Validar teléfono (solo números)
        phoneInput.addEventListener('input', function () {
            const phoneRegex = /^[0-9]*$/;
            if (!phoneRegex.test(phoneInput.value)) {
                phoneInput.classList.add('border-red-500');  // Añadir borde rojo
                errorPhone.textContent = 'Solo se permiten números.';  // Mensaje de error
                errorPhone.classList.remove('hidden');  // Mostrar mensaje
            } else {
                phoneInput.classList.remove('border-red-500');  // Quitar borde rojo
                errorPhone.classList.add('hidden');  // Ocultar mensaje
            }
        });

        // Validar correo electrónico (ya usa el type=email para validación básica)
        emailInput.addEventListener('input', function () {
            if (!emailInput.validity.valid) {
                emailInput.classList.add('border-red-500');  // Añadir borde rojo
                errorEmail.textContent = 'Por favor ingresa un correo electrónico válido.';  // Mensaje de error
                errorEmail.classList.remove('hidden');  // Mostrar mensaje
            } else {
                emailInput.classList.remove('border-red-500');  // Quitar borde rojo
                errorEmail.classList.add('hidden');  // Ocultar mensaje
            }
        });

        // Validar en la acción del formulario si todos los campos son válidos
        document.querySelector('form').addEventListener('submit', function (event) {
            if (!nameInput.checkValidity() || !phoneInput.checkValidity() || !emailInput.checkValidity()) {
                event.preventDefault(); // Detiene el envío del formulario si hay algún error
            }
        });

    </script>
</body>
</html>