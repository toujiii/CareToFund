
document.addEventListener("DOMContentLoaded", function () {
    const adminRequestsSectionContainer = document.getElementById(
        "adminRequestsSectionContainer"
    );
    if (adminRequestsSectionContainer) {
        loadCharityRequestsSection();
    }
});

function loadCharityRequestsSection() {
    console.log("Admin Requests Section Loaded");

    $.ajax({
        url: '/charity-requests',
        method: 'GET',
        success: function (data) {
            $('#adminRequestsSectionContainer').html(data);
        },
        error: function (error) {
            console.error("Error loading admin requests:", error);
        }
    });
}