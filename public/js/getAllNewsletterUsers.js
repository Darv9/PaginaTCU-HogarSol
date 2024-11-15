document.addEventListener('DOMContentLoaded', function () {
    fetchUsers();
});

function fetchUsers() {
    fetch('../../src/routes/getUsersNewsletterRoutes.php?action=getAllNewsltterUsers', {
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
    userTableBody.innerHTML = '';

    if (Array.isArray(users) && users.length > 0) {
        users.forEach(user => {
            const active = user.USER_ACTIVE === 1 ? 'Activo' : (user.USER_ACTIVE === 0 ? 'Desactivado' : 'Desconocido');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.USERMAIL}</td>
                <td>${user.USERNAME}</td>
                <td>${user.USERLASTNAME1}</td>
                <td>${user.USERLASTNAME2}</td>
                <td>${active}</td>
                <td><button class="edit-btn" data-id="${user.USER_ID}">Editar</button></td>
                <td><button class="delete-btn" data-mail="${user.USERMAIL}">Desactivar</button></td>
            `;
            userTableBody.appendChild(row);
        });

        // Agregar los eventos a los botones después de crear las filas
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-id');
                // Redirigir a la página de actualización pasando el USER_ID como parámetro
                window.location.href = `updateUsersNL.php?user_id=${userId}`;
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userMail = button.getAttribute('data-mail');
                deactivateUserNL(userMail); // Llama a la función deactivateUser pasando el ID
            });
        });
    } else {
        userTableBody.innerHTML = "<tr><td colspan='9'>No hay usuarios disponibles</td></tr>";
    }
}

function populateCards(users) {
    const userCardsContainer = document.getElementById('userCardsContainer');
    userCardsContainer.innerHTML = '';

    if (Array.isArray(users) && users.length > 0) {
        users.forEach(user => {
            const active = user.USER_ACTIVE === 1 ? 'Activo' : (user.USER_ACTIVE === 0 ? 'Desactivado' : 'Desconocido');
            const card = document.createElement('div');
            card.classList.add('card');
            card.innerHTML = `
                <h3>Correo del Usuario: ${user.USERMAIL}</h3>
                <div><span>Nombre:</span> ${user.USERNAME}</div>
                <div><span>Primer Apellido:</span> ${user.USERLASTNAME1}</div>
                <div><span>Segundo Apellido:</span> ${user.USERLASTNAME2}</div>
                <div><span>Estado del Usuario:</span> ${active}</div>
                <div class="card-buttons">
                    <button onclick="editUser(${user.USER_ID})">Editar</button>
                    <button onclick="deactivateUserNL('${user.USERMAIL}')">Desactivar</button>
                </div>
            `;
            userCardsContainer.appendChild(card);
        });
    } else {
        userCardsContainer.innerHTML = "<p>No hay usuarios disponibles</p>";
    }
}

function editUser(userId) {
    // Redirigir a la página de actualización pasando el USER_ID como parámetro
    window.location.href = `updateUsersNL.php?user_id=${userId}`;
}

function deactivateUserNL(userMail) {
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
            formData.append('action', 'deactivateUserNL'); // Añadir la acción
            formData.append('userMail', userMail); // Añadir el ID del usuario

            fetch('../../src/routes/deactivateUserNLRoutes.php', {
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