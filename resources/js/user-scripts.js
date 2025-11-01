// console.log('jQuery version:', $.fn.jquery);
import countdown from 'countdown';

$(document).ready(function () {
    // getProfile();
    // getUserCharityRequests();
    

});




const pendingCharityObserver = new MutationObserver((mutationsList, observer) => {
    const pendingCharityRequestsContainer = document.getElementById('pendingCharityRequestsContainer');
    if (pendingCharityRequestsContainer) {
        getUserCharityRequests();
        observer.disconnect(); 
    }
});

pendingCharityObserver.observe(document.body, { childList: true, subtree: true });

const userNotifObserver = new MutationObserver((mutationsList, observer) => {
    const userNotificationsContainer = document.getElementById('userNotificationContainer');
    if (userNotificationsContainer) {
        getUserNotifications();
        observer.disconnect(); 
    }
});

userNotifObserver.observe(document.body, { childList: true, subtree: true });

const charityObserver = new MutationObserver((mutationsList, observer) => {
    const currentNewCharityContainer = document.getElementById('currentNewCharityContainer');
    if (currentNewCharityContainer) {
        getCharity();
        observer.disconnect(); 
    }
});

charityObserver.observe(document.body, { childList: true, subtree: true });


document.addEventListener("DOMContentLoaded", function () {
    const userProfileComponent = document.getElementById(
        "userProfileComponent"
    );
    if (userProfileComponent) {
        getProfile();
    }
});


$(document).on("submit", "#updateProfile", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            $("#updateProfileError").empty();

            setTimeout(() => {
                window.dispatchEvent(new CustomEvent("success-modal"));
                $("#responseModalTitle").text("Profile Updated");
                $("#responseModalMessage").text(
                    "Your profile has been updated successfully."
                );
            }, 50);

            $("#responseModalTitle").text("Profile Updated");
            console.log("Updated text:", $("#responseModalTitle").text());

            getProfile();
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;

                if (errors.name) {
                    $("#updateProfileError").text(errors.name[0]);
                }

                if (errors.email) {
                    $("#updateProfileError").text(errors.email[0]);
                }
            }
        },
    });
});

$(document).on("submit", "#resetPasswordForm", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            // console.log(response);
            $("#resetPasswordError").empty();
            setTimeout(() => {
                window.dispatchEvent(new CustomEvent("success-modal"));
                $("#responseModalTitle").text("Password Reset");
                $("#responseModalMessage").text(
                    "Your password has been reset successfully."
                );
            }, 50);
            getProfile();
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;

                if (errors.new_password) {
                    $("#resetPasswordError").text(errors.new_password[0]);
                    return;
                }

                if (errors.current_password) {
                    $("#resetPasswordError").text(errors.current_password[0]);
                    return;
                }
            }
        },
    });
});

$(document).on("submit", "#verifyGcashForm", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            $("#verifyGcashError").empty();
            getProfile();
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;

                if (errors.gcash_number) {
                    $("#verifyGcashError").text(errors.gcash_number[0]);
                }
            }
        },
    });
});

$(document).on("submit", "#verifyImagesForm", function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            getProfile();
            window.dispatchEvent(new CustomEvent("reset-previews"));
        },
        error: function (xhr) {
            console.error(xhr);
        },
    });
});

$(document).on('submit', '#newCharityForm', function (e) {
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
            setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('success-modal'));
                    $('#responseModalTitle').text('Charity Created');
                    $('#responseModalMessage').text('Your charity has been created successfully.');
                }, 100);
            getProfile();
            getUserCharityRequests();
            console.log('Charity created successfully.');
        },
        error: function (xhr) {
            console.error(xhr);
            console.log('Failed to create charity.');
        }
    });
});


function getProfile() {
    $.ajax({
        url: "/profile",
        type: "GET",
        success: function (response) {
            // console.log(response);
            $("#userProfileComponent").empty();
            $("#userProfileComponent").html(response);
        },
        error: function (xhr) {
            // console.error(xhr);
        },
    });
}

function getUserCharityRequests(requests_id) {

    if (!requests_id) {
        requests_id = '';
    } 
    $.ajax({
        url: '/charity-requests/show',
        type: 'GET',
        data: {
            "request_id": requests_id
        },
        success: function (response) {
            // console.log(response);
            if (requests_id) {
                // console.log('Loading user charity requests...');
                // console.log(response);
                $('#viewMoreDetailsModalContainer').empty();
                $('#viewMoreDetailsModalContainer').html(response);
            } else {
                // console.log('Loading user charity requests...');
                // console.log(response);
                $('#pendingCharityRequestsContainer').empty();
                $('#pendingCharityRequestsContainer').html(response);
            }
        },
        error: function (xhr) {
            console.error(xhr); 
        }
    });
}
window.getUserCharityRequests = getUserCharityRequests;


function cancelCharityRequest(charityRequestID) {
    console.log('Cancel charity request ID:', charityRequestID);
    $.ajax({
        url: '/cancel-charity/' + charityRequestID,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('success-modal'));
                    $('#responseModalTitle').text('Charity Deleted');
                    $('#responseModalMessage').text('Your charity has been deleted successfully.');
                }, 50);
            getProfile();
        },
        error: function (xhr) {
            console.error(xhr);
        }
    });
}
window.cancelCharityRequest = cancelCharityRequest;

function getUserNotifications() {
    $.ajax({
        url: '/user-notifications/show',
        type: 'GET',
        success: function (response) {
            $('#userNotificationContainer').empty();
            $('#userNotificationContainer').html(response);
        },
        error: function (xhr) {
            console.error(xhr);
        }
    });
}
window.getUserNotifications = getUserNotifications;

function markNotificationAsRead(notificationID) {
    $.ajax({
        url: '/mark-as-read/' + notificationID,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            // console.log(response);

            getProfile();
        },
        error: function (xhr) {
            console.error(xhr);
        }
    });
}
window.markNotificationAsRead = markNotificationAsRead;

function getCharity(charityID) {
    if (!charityID) {
        charityID = '';
    }
    $.ajax({
        url: '/charity/show/' + charityID,
        type: 'GET',
        success: function (response) {
            // console.log(response);
            $('#currentNewCharityContainer').empty();
            $('#currentNewCharityContainer').html(response);
        },
        error: function (xhr) {
            console.error(xhr);
        }
    });
}
window.getCharity = getCharity;


const endDate = new Date('2025-12-31T23:59:59');
const timer = countdown(function (ts) {

    const countdownElement = document.getElementById('charityCountdownTimer');

    if (countdownElement) {
        countdownElement.textContent = `${ts.days}d ${ts.hours}h ${ts.minutes}m ${ts.seconds}s`;
    }
}, endDate);

window.timer = timer;