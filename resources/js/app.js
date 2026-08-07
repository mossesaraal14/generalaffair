import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import axios from 'axios';

window.axios = axios;

$(document).on('click', '.btn-show', async function (e) {

    e.preventDefault();

    try {

        const response = await axios.get($(this).attr('href'));

        console.log(response.data);

        $('#ticket_id').html(response.data.ticket_id);
        $('#user_name').html(response.data.user.name);
        $('#user_email').html(response.data.user.email);
        $('#department').html(response.data.department);
        $('#category').html(response.data.category);
        $('#status').html(response.data.status);
        $('#description').html(response.data.description);
        $('#note').html(response.data.note);
        $('#created_at').html(response.data.created_at);
        $('#updated_at').html(response.data.updated_at);

        $('#exampleModal').modal('show');

    } catch (error) {

        console.error(error);

    }

});

$(document).on('click', '.btn-close', async function(e) {
    e.preventDefault();

    $(this).closest('.modal').modal('hide');
});

// document.addEventListener('click', async function (e) {

//     const button = e.target.closest('.btn-show');

//     if (!button) return;

//     e.preventDefault();

//     try {

//         const response = await axios.get(button.href);

//         console.log(response.data);

//         document.getElementById('ticket_id').innerHTML = response.data.ticket_id;
//         document.getElementById('user_name').innerHTML = response.data.user.name;
//         document.getElementById('user_email').innerHTML = response.data.user.email;
//         document.getElementById('department').innerHTML = response.data.department;
//         document.getElementById('category').innerHTML = response.data.category;
//         document.getElementById('status').innerHTML = response.data.status;
//         document.getElementById('description').innerHTML = response.data.description;
//         document.getElementById('created_at').innerHTML = response.data.created_at;
//         document.getElementById('updated_at').innerHTML = response.data.updated_at;

//     } catch (error) {

//         console.error(error);

//     }

// });

// document.addEventListener('click', async function(e) {
//     const button = e.target.closest('.btn-show');
//     if(!button) return;

//     e.preventDefault();

//     const modal = new
//     try {
//         const response = await axios.get(button.href);
//         console.log(response.data);
//     } catch (error) {
//         console.log(error);
//     }
// });
