// console.log('jQuery version:', $.fn.jquery);

$(document).ready(function () {

    
    // getProfile();

});

document.addEventListener('DOMContentLoaded', function () {
    const userProfileComponent = document.getElementById('userProfileComponent');
    if (userProfileComponent) {
       getProfile();
    }
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
                
                
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('success-modal'));
                    $('#responseModalTitle').text('Profile Updated');
                    $('#responseModalMessage').text('Your profile has been updated successfully.');
                }, 50);

                
                $('#responseModalTitle').text('Profile Updated');
                console.log('Updated text:', $('#responseModalTitle').text());

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
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('success-modal'));
                    $('#responseModalTitle').text('Password Reset');
                    $('#responseModalMessage').text('Your password has been reset successfully.');
                }, 50);
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
            console.error(xhr);
        }
    });
});

function getProfile() {
    $.ajax({
        url: '/profile',
        type: 'GET',
        success: function (response) {
            // console.log(response);
            $('#userProfileComponent').empty();
            $('#userProfileComponent').html(response);
        },
        error: function (xhr) {
            // console.error(xhr); 
        }
    });
}

