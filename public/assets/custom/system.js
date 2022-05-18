$(document).ready(function () {
    $('#prence').submit( function (e) {
        e.preventDefault();

        $('.presence').addClass('disabled');
        $('.leave').removeClass('disabled');

        // var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        // var d = new Date();
        // var dayName = days[d.getDay()];
        //
        // var today = new Date();
        // var dd = String(today.getDate()).padStart(2, '0');
        // var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        // var yyyy = today.getFullYear();
        // var ss = String(today.getSeconds()).padStart(2, '0');
        // var hh = String(today.getUTCHours()).padStart(2, '0');
        // var m = String(today.getMinutes()).padStart(2, '0');
        //
        // today = mm + '-' + dd + '-' + yyyy + ' ' + hh + ':' + m + ':' + ss;
        //
        // var html = `
        //       <tr class="table-info">
        //           <td class="text-bold-500">presence</td>
        //           <td>${today}</td>
        //           <td>${dayName}</td>
        //       </tr>
        // `;

        let formData = new FormData(this);

        var url = '/store';
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    this.reset();
                    console.log('Image has been uploaded successfully');
                }
            },
            error: function (response) {
                console.log(response);
            }
        });


    });

    $('#abrence').submit(function (e) {
        e.preventDefault();

        // var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        // var d = new Date();
        // var dayName = days[d.getDay()];
        // var name = $(this).data('name');
        // var phone = $(this).data('phone');
        // var email = $(this).data('email');
        //
        //
        // var today = new Date();
        // var dd = String(today.getDate()).padStart(2, '0');
        // var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        // var yyyy = today.getFullYear();
        // var ss = String(today.getSeconds()).padStart(2, '0');
        // var hh = String(today.getUTCHours()).padStart(2, '0');
        // var m = String(today.getMinutes()).padStart(2, '0');
        //
        // today = mm + '-' + dd + '-' + yyyy + ' ' + hh + ':' + m + ':' + ss;
        //
        // var html = `
        //       <tr class="table-info">
        //           <td class="text-bold-500">leave</td>
        //           <td>${today}</td>
        //           <td>${dayName}</td>
        //       </tr>
        // `;

        let formData = new FormData(this);

        var url = '/store';
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    this.reset();
                    console.log('Image has been uploaded successfully');
                }
                // $('.user_table').append(html);
            },
            error: function (response) {
                console.log(response);
            }
        });


    });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload").change(function () {
        readURL(this);
    });

});
