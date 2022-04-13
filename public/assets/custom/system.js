$(document).ready(function () {
    $('.presence').on('click', function (e) {
        e.preventDefault();
        $(this).hide();
        // $(this).removeClass('btn-success');
        // $(this).addClass('btn-secondary disabled');
        $('.absence').removeClass('btn-secondary disabled');
        $('.absence').addClass('btn-danger');

        // var name = $(this).data('name');
        // var phone = $(this).data('phone');
        // var email = $(this).data('email');
        // var id = $(this).data('id');
        // var tzoffset = (new Date()).getTimezoneOffset() * 60000;
        // var localISOTime = (new Date(Date.now() - tzoffset))
        //     .toISOString()
        //     .slice(0, 19)
        //     .replace('T', ' ');

        // var dt = new Date();
        // var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds()+"-"+ dt.getDate() +"/"+dt.getFullYear();

        // var html = `
        //   <tr class="table-info" id="presence_add_${id}">
        //     <td class="text-bold-500">${name}</td>
        //     <td>${email}</td>
        //     <td class="text-bold-500">${phone}</td>
        //     <td>${localISOTime}</td>
        //     <td>${null}</td>
        //     </tr>`;
        // $('.user_table').append(html);

    });

    $('.absence').on('click', function (e) {
        e.preventDefault();
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-secondary disabled');
        $('.presence').removeClass('btn-secondary disabled');
        $('.presence').addClass('btn-success');
        //
        // var name = $(this).data('name');
        // var phone = $(this).data('phone');
        // var email = $(this).data('email');
        // var id = $(this).data('id');
        // var tzoffset = (new Date()).getTimezoneOffset() * 60000;
        // var localISOTime = (new Date(Date.now() - tzoffset))
        //     .toISOString()
        //     .slice(0, 19)
        //     .replace('T', ' ');
        //
        // var prences = $('#presence_add_'+id).children('td:nth-child(4)').html();
        //
        // $('#presence_add_'+id).remove();
        // var html = `
        //   <tr class="table-info" id="presence_add_${id}">
        //     <td class="text-bold-500">${name}</td>
        //     <td>${email}</td>
        //     <td class="text-bold-500">${phone}</td>
        //     <td>${prences}</td>
        //     <td>${localISOTime}</td>
        //     </tr>`;
        // $('.user_table').append(html);

    })


});
