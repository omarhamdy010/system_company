$(document).ready(function () {
    $('.absence').hide();
    $('.presence').on('click', function (e) {
        e.preventDefault();
        $('.absence').show();
        $(this).hide();
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var d = new Date();
        var dayName = days[d.getDay()];
        var name = $(this).data('name');
        var phone = $(this).data('phone');
        var email = $(this).data('email');


        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        var ss = String(today.getSeconds()).padStart(2, '0');
        var hh = String(today.getUTCHours()).padStart(2, '0');
        var m = String(today.getMinutes()).padStart(2, '0');

        today = mm + '-' + dd + '-' + yyyy + ' ' + hh + ':' + m + ':' + ss;

        var html = `
  <tr class="table-info">
      <td class="text-bold-500">${name}</td>
      <td>${email}</td>
      <td class="text-bold-500">${phone}</td>
      <td>${today}</td>
      <td>-</td>
      <td>${dayName}</td>
  </tr>
        `;
        var url = '/store';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                name: name,
                email: email,
                phone: phone,
                _token: $('#token1').val(),
            },
            dataType: 'json',
            success: function (result) {
                $('.user_table').append(html);
            },
            error: function (result) {
                console.log("===== " + result + "error");
            }
        });


    });

    $('.absence').on('click', function (e) {
        e.preventDefault();

        $(this).hide();

        $('.presence').show();
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var d = new Date();
        var dayName = days[d.getDay()];
        var name = $(this).data('name');
        var phone = $(this).data('phone');
        var email = $(this).data('email');


        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        var ss = String(today.getSeconds()).padStart(2, '0');
        var hh = String(today.getUTCHours()).padStart(2, '0');
        var m = String(today.getMinutes()).padStart(2, '0');

        today = mm + '-' + dd + '-' + yyyy + ' ' + hh + ':' + m + ':' + ss;

        var html = `
  <tr class="table-info">
      <td class="text-bold-500">${name}</td>
      <td>${email}</td>
      <td class="text-bold-500">${phone}</td>
      <td>-</td>
      <td>${today}</td>
      <td>${dayName}</td>
  </tr>
        `;
        var url = '/save';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                name: name,
                email: email,
                phone: phone,
                _token: $('#token2').val(),
            },
            dataType: 'json',
            success: function (result) {
                $('.user_table').append(html);

            },
            error: function (result) {
                console.log("===== " + result + "error");
            }
        });

    });

    });
