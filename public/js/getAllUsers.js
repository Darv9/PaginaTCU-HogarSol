document.addEventListener('DOMContentLoaded', function () {
    fetchUsers();
});

function fetchUsers() {
    fetch('../../src/routes/getUsersRoutes.php?action=getAllUsers', {
        method: 'GET', 
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success' && Array.isArray(data.users.data)) {
            populateTable(data.users.data);  
            populateCards(data.users.data);  
        } else {
            console.error("Error al obtener usuarios:", data.message || "No se recibieron usuarios.");
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
    });
}

function populateTable(users) {
    const userTableBody = document.getElementById('userTableBody');
    userTableBody.innerHTML = ''; // Limpiar la tabla antes de llenarla con los nuevos datos

    if (Array.isArray(users) && users.length > 0) {
        users.forEach(user => {
            const role = user.ROLE_ID === 1 ? 'Administrador' : (user.ROLE_ID === 2 ? 'Usuario' : 'Desconocido');
            const confirmed = user.USER_CONFIRMATION === 1 ? 'Confirmado' : (user.USER_CONFIRMATION === 2 ? 'Pendiente Confirmar' : 'Desconocido');
            const active = user.USER_ACTIVE === 1 ? 'Activo' : (user.USER_ACTIVE === 0 ? 'Desactivado' : 'Desconocido');
            // Crear la fila para el usuario
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.USER_ID}</td>
                <td>${user.USERNAME}</td>
                <td>${user.USERLASTNAME1}</td>
                <td>${user.USERLASTNAME2}</td>
                <td>${user.USERMAIL}</td>
                <td>${confirmed}</td>
                <td>${role}</td>
                <td>${active}</td>
                <td><button class="edit-btn" data-id="${user.USER_ID}">Editar</button></td>
                <td><button class="delete-btn" data-id="${user.USER_ID}">Desactivar</button></td>
            `;

            // Añadir la fila a la tabla
            userTableBody.appendChild(row);
        });

        // Agregar los eventos a los botones después de crear las filas
        // Editar
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-id');
                editUser(userId); // Llama a la función editUser pasando el ID
            });
        });

        // Eliminar
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-id');
                deactivateUser(userId); // Llama a la función deactivateUser pasando el ID
            });
        });
    } else {
        userTableBody.innerHTML = "<tr><td colspan='9'>No hay usuarios disponibles</td></tr>";
    }
}


function deactivateUser(userId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción desactivará al usuario.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, desactivar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, realizamos la solicitud para desactivar el usuario

            // Crear un nuevo objeto FormData
            const formData = new FormData();
            formData.append('action', 'deactivateUser'); // Añadir la acción
            formData.append('user_id', userId); // Añadir el ID del usuario

            fetch('../../src/routes/deactivateUserRoutes.php', {
                method: 'POST',
                body: formData // Usar FormData para enviar los datos
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire('Desactivado', data.message, 'success');
                    fetchUsers(); // Actualizamos la lista de usuarios
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
                Swal.fire('Error', 'Hubo un problema en el servidor', 'error');
            });
        }
    });
}


function populateCards(users) {
    const userCardsContainer = document.getElementById('userCardsContainer');
    userCardsContainer.innerHTML = '';

    if (Array.isArray(users) && users.length > 0) {
        users.forEach(user => {
            const role = user.ROLE_ID === 1 ? 'Administrador' : (user.ROLE_ID === 2 ? 'Usuario' : 'Desconocido');
            const confirmed = user.USER_CONFIRMATION === 1 ? 'Confirmado' : (user.USER_CONFIRMATION === 2 ? 'Pendiente Confirmar' : 'Desconocido');
            const active = user.USER_ACTIVE === 1 ? 'Activo' : (user.USER_ACTIVE === 0 ? 'Desactivado' : 'Desconocido');
            const card = document.createElement('div');
            card.classList.add('card');
            card.innerHTML = `
                <h3>Id del Usuario: ${user.USER_ID}</h3>
                <div><span>Nombre:</span> ${user.USERNAME}</div>
                <div><span>Primer Apellido:</span> ${user.USERLASTNAME1}</div>
                <div><span>Segundo Apellido:</span> ${user.USERLASTNAME2}</div>
                <div><span>Correo Electrónico:</span> ${user.USERMAIL}</div>
                <div><span>Confirmación de Usuario:</span> ${confirmed}</div>
                <div><span>Rol del Usuario:</span> ${role}</div>
                <div><span>Estado del Usuario:</span> ${active}</div>
                <div class="card-buttons">
                    <button onclick="editUser(${user.USER_ID})">Editar</button>
                    <button onclick="deactivateUser(${user.USER_ID})">Eliminar</button>
                </div>
            `;
            userCardsContainer.appendChild(card);
        });
    } else {
        userCardsContainer.innerHTML = "<p>No hay usuarios disponibles</p>";
    }
}

