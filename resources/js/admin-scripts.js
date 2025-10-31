
// $(document).ready(function () {
//      loadCharityRequestsSection();
// });


// document.addEventListener("DOMContentLoaded", function () {
//     const adminRequestsSectionContainer = document.getElementById(
//         "adminRequestsSectionContainer"
//     );
//     if (adminRequestsSectionContainer) {
//         loadCharityRequestsSection();
//     }
// });


const observer = new MutationObserver((mutationsList, observer) => {
    const charityRequestsSectionContainer = document.getElementById(
        "charityRequestsSectionContainer"
    );
    if (charityRequestsSectionContainer) {
        loadCharityRequestsSection();
        observer.disconnect(); 
    }
});

observer.observe(document.body, { childList: true, subtree: true });



let sortedBy = '';

function loadCharityRequestsSection(sortBy, searchQuery) {
    if (sortedBy === sortBy) {
        sortBy = '';
        sortedBy = '';
    }

    if (sortBy) {
        sortedBy = sortBy;
    }

    $.ajax({
        url: '/charity-requests',
        method: 'GET',
        data: {
            "sort_by": sortBy,
            "search_query": searchQuery
        },
        success: function (data) {
            $('#charityRequestsSectionContainer').html(data);
            // console.log(sortedBy);
        },
        error: function (error) {
            console.error("Error loading admin requests:", error);
        }
    });
}

window.loadCharityRequestsSection = loadCharityRequestsSection;


function rejectCharityRequest(requestId) {
    $.ajax({
        url: '/reject-charity-request/' + requestId,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log('Charity request rejected successfully:', response);
            
        },
        error: function (xhr) {
            console.error('Error rejecting charity request:', xhr);
        }
    });
}
window.rejectCharityRequest = rejectCharityRequest;