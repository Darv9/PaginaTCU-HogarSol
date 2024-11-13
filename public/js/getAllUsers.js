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
    userTableBody.innerHTML = '';

    if (Array.isArray(users) && users.length > 0) {
        users.forEach(user => {

            const role = user.ROLE_ID === 1 ? 'Administrador' : (user.ROLE_ID === 2 ? 'Usuario' : 'Desconocido'); //Para mostrar admin o user en la tabla
            const confirmed = user.USER_CONFIRMATION === 1 ? 'Confirmado' : (user.USER_CONFIRMATION === 2 ? 'Pendiente Confirmar' : 'Desconocido'); //Para mostrar si esta verificado o no en la tabla
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.USER_ID}</td>
                <td>${user.USERNAME}</td>
                <td>${user.USERLASTNAME1}</td>
                <td>${user.USERLASTNAME2}</td>
                <td>${user.USERMAIL}</td>
                <td>${confirmed}</td>
                <td>${role}</td>
            `;
            userTableBody.appendChild(row);
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
            const role = user.ROLE_ID === 1 ? 'Administrador' : (user.ROLE_ID === 2 ? 'Usuario' : 'Desconocido'); //Para mostrar admin o user en la tabla
            const confirmed = user.USER_CONFIRMATION === 1 ? 'Confirmado' : (user.USER_CONFIRMATION === 2 ? 'Pendiente Confirmar' : 'Desconocido'); //Para mostrar si esta verificado o no en la tabla
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
            `;
            userCardsContainer.appendChild(card);
        });
    } else {
        userCardsContainer.innerHTML = "<p>No hay usuarios disponibles</p>";
    }
}
