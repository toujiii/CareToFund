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

let sortedBy = "";

function loadCharityRequestsSection(sortBy, searchQuery) {
    if (sortedBy === sortBy) {
        sortBy = "";
        sortedBy = "";
    }

    if (sortBy) {
        sortedBy = sortBy;
    }

    $.ajax({
        url: "/charity-requests",
        method: "GET",
        data: {
            sort_by: sortBy,
            search_query: searchQuery,
        },
        success: function (response) {
            $("#charityRequestsSectionContainer").empty();
            $("#charityRequestsSectionContainer").html(response);
            // console.log(sortedBy);
        },
        error: function (error) {
            console.error("Error loading admin requests:", error);
        },
    });
}

window.loadCharityRequestsSection = loadCharityRequestsSection;

function rejectCharityRequest(requestId) {
    $.ajax({
        url: "/reject-charity-request/" + requestId,
        method: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            // console.log('Charity request rejected successfully:', response);
            setTimeout(() => {
                window.dispatchEvent(new CustomEvent("success-modal"));
                $("#responseModalTitle").text("Charity Rejected");
                $("#responseModalMessage").text(
                    "This charity has been rejected successfully."
                );
            }, 50);
            loadCharityRequestsSection(sortedBy, "");
        },
        error: function (xhr) {
            console.error("Error rejecting charity request:", xhr);
        },
    });
}
window.rejectCharityRequest = rejectCharityRequest;

function approveCharityRequest(requestId) {
    console.log("Approve Charity Request ID:", requestId);
    $.ajax({
        url: "/approve-charity-request/" + requestId,
        method: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            // console.log('Charity request approved successfully:', response);
            setTimeout(() => {
                window.dispatchEvent(new CustomEvent("success-modal"));
                $("#responseModalTitle").text("Charity Approved");
                $("#responseModalMessage").text(
                    "This charity has been approved successfully."
                );
            }, 50);
            loadCharityRequestsSection(sortedBy, "");
        },
        error: function (xhr) {
            console.error("Error approving charity request:", xhr);
        },
    });
}
window.approveCharityRequest = approveCharityRequest;

window.adminUserAction = async function (method, url, data = undefined) {
    const token =
        document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content") || "";

    const headers = {
        "X-CSRF-TOKEN": token,
        "X-Requested-With": "XMLHttpRequest",
        Accept: "application/json",
    };

    let body;
    if (typeof data !== "undefined") {
        // send JSON body for non-GET/HEAD requests
        headers["Content-Type"] = "application/json";
        body = JSON.stringify(data);
    }

    const res = await fetch(url, {
        method,
        headers,
        body,
    });

    if (!res.ok) {
        const err = await res.json().catch(() => ({ message: res.statusText }));
        throw new Error(err.message || "Request failed");
    }

    return await res.json().catch(() => ({}));
};
