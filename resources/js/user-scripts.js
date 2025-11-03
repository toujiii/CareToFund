// console.log('jQuery version:', $.fn.jquery);
import countdown from 'countdown';

$(document).ready(function () {
    // getProfile();
    // getUserCharityRequests();
    

});


const countdownContainerObserver = new MutationObserver((mutationsList, observer) => {
    const countdownElements = document.querySelectorAll('.charity-countdown-timer');
    if (countdownElements.length > 0) {
        countdownElements.forEach((element) => {
            const endDate = element.getAttribute('data-charity-end-date');
            const charityId = element.getAttribute('data-charity-id');
            const userId = element.getAttribute('data-user-id');
            initializeCountdown(element, endDate, charityId, userId);
        });
        observer.disconnect();
    }
});

countdownContainerObserver.observe(document.body, { childList: true, subtree: true });

const observer = new MutationObserver((mutationsList, observer) => {
    const countdownElement = document.getElementById('charityCountdownTimer');
    if (countdownElement) {
        const endDate = countdownElement.getAttribute('data-charity-end-date');
        const charityId = countdownElement.getAttribute('data-charity-id');
        const userId = countdownElement.getAttribute('data-user-id');
        initializeCountdown(countdownElement, endDate, charityId, userId);

        observer.disconnect();
    }
});

observer.observe(document.body, { childList: true, subtree: true });



const pendingCharityObserver = new MutationObserver((mutationsList, observer) => {
    const pendingCharityRequestsContainer = document.getElementById('pendingCharityRequestsContainer');
    if (pendingCharityRequestsContainer) {
        console.log('Loading user charity requests...');
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
    const charityPostsContainer = document.getElementById(
        "charityPostsContainer"
    );
    if (charityPostsContainer) {
        // console.log('Loading user charities...');
        loadCharities('','','user');
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
            // console.log(response);
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

function initializeCountdown(elementId, endDateString, charityId, userId) {

    if (elementId) {
        
        const formattedEndDate = endDateString.replace(' ', 'T');
        const endDate = new Date(formattedEndDate);
        if (!isNaN(endDate)) {
            let hasEnded = false;
            const timer = countdown(function (ts) {
                if (elementId) {
                    let countdownText = '';
                    if (ts.days > 0) countdownText += `${ts.days}d `;
                    if (ts.hours > 0) countdownText += `${ts.hours}h `;
                    if (ts.minutes > 0) countdownText += `${ts.minutes}m `;
                    if (ts.seconds > 0) countdownText += `${ts.seconds}s`;

                    // Update the element's text content
                    elementId.textContent = countdownText.trim() + " left";
                }
                if (ts.value <= 0) {
                    elementId.textContent = 'Charity has ended';
                    if (!hasEnded) {
                        hasEnded = true; 
                        charityDurationComplete(charityId, userId);
                    }
                }
            }, endDate);
            
            return timer; 

        } else {
            console.error(`Invalid End Date for ${elementId}:`, endDateString);
        }
    } else {
        console.error(`Countdown element with ID "${elementId}" not found.`);
    }
}




const charitiesObserver = new MutationObserver((mutationsList, observer) => {
   
    const charitiesResultContainer = document.getElementById(
        "charitiesResultContainer"
    );
    if (charitiesResultContainer) {
        loadCharities('','','admin');
        observer.disconnect(); 
    }
});

charitiesObserver.observe(document.body, { childList: true, subtree: true });

let charitySortedBy = '';

function loadCharities(charitySortBy, charitySearchQuery, role) {
    if (charitySortedBy === charitySortBy) {
        charitySortBy = '';
        charitySortedBy = '';
    }
    if (charitySortBy) {
        charitySortedBy = charitySortBy;
    }
    $.ajax({
        url: '/charity',
        type: 'GET',
        data: {
            "sort_by": charitySortBy,
            "search_query": charitySearchQuery,
            "role": role
        },
        success: function (response) {
            // console.log(response);
            if (role === 'admin') {
                $('#charitiesResultContainer').empty();
                $('#charitiesResultContainer').html(response);
            } else if (role === 'user') {
                $('#charityPostsContainer').empty();
                $('#charityPostsContainer').html(response);
            }

            document.querySelectorAll('.charity-countdown-timer').forEach((element) => {
                const endDate = element.getAttribute('data-charity-end-date');
                initializeCountdown(element, endDate);
            });
        },
        error: function (xhr) {
            console.error(xhr);
        }
    });
}
window.loadCharities = loadCharities;

function cancelCharity(charityID) {
    $.ajax({
        url: '/cancel-charity-list/' + charityID,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            setTimeout(() => {
                window.dispatchEvent(new CustomEvent('success-modal'));
                $('#responseModalTitle').text('Charity Cancelled');
                $('#responseModalMessage').text('This charity has been cancelled successfully.');
            }, 50);
            loadCharities(charitySortedBy, '', 'admin');
        },
        error: function (xhr) {
            console.error('Error cancelling charity:', xhr);
        }
    });
}
window.cancelCharity = cancelCharity;

$(document).on("submit", "#sendDonationForm", function (e) {
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
            setTimeout(() => {
                window.dispatchEvent(new CustomEvent("success-modal"));
                $("#responseModalTitle").text("Donation Successful");
                $("#responseModalMessage").text(
                    "Your donation has been sent successfully."
                );
            }, 200);
            getProfile();
            loadCharities('', '', 'user');
            
            
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
        },
        error: function (xhr) {
            console.error(xhr);
        },
    });
});

function charityDurationComplete(charityId, userId) {
    if (charityId && userId) {
        // console.log('Charity duration complete for ID:', charityId);
        // console.log('User ID:', userId);
        $.ajax({
            url: '/charity/update',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                "charity_id": charityId,
                "user_id": userId,   
            },
            success: function (response) {
                // console.log('Charity marked as complete:', response);
                getProfile();
                loadCharities('', '', 'user');
                loadCharities(charitySortedBy, '', 'admin');
                
            },
            error: function (xhr) {
                console.error('Error marking charity as complete:', xhr);
            }
        });
    }
}