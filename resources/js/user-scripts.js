console.log('jQuery version:', $.fn.jquery);

$(document).ready(function () {
    getProfile();
});

$(document).on('submit', '#updateProfile', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                $('#updateProfileError').empty();
                getProfile();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;

                    if (errors.name) {
                        $('#updateProfileError').text(errors.name[0]);
                    }

                    if (errors.email) {
                        $('#updateProfileError').text(errors.email[0]);
                    }
                }
            },
    });
});

$(document).on('submit', '#resetPasswordForm', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // console.log(response);
                $('#resetPasswordError').empty();
                getProfile();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;

                    
                    if (errors.new_password) {
                        $('#resetPasswordError').text(errors.new_password[0]);
                        return;
                    }

                    if (errors.current_password) {
                        $('#resetPasswordError').text(errors.current_password[0]);
                        return;
                    }
                }
            },
    });
});

$(document).on('submit', '#verifyGcashForm', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            $('#verifyGcashError').empty();
            getProfile();
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;

                if (errors.gcash_number) {
                    $('#verifyGcashError').text(errors.gcash_number[0]);
                }
            }
        },
    });
});

$(document).on('submit', '#verifyImagesForm', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            getProfile();
            window.dispatchEvent(new CustomEvent('reset-previews'));
        },
        error: function (xhr) {
        }
    });
});

function getProfile() {
    $.ajax({
        url: '/profile',
        type: 'GET',
        success: function (response) {
            // console.log(response);
            $('#userProfileInfoSection').empty();
            $('#userProfileInfoSection').html(response);
        },
        error: function (xhr) {
            console.error(xhr); 
        }
    });
}