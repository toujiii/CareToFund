import './bootstrap';


// sample lang
// $(document).ready(function () {
//     $('#editProfileForm').on('submit', function (e) {
//         e.preventDefault(); // Prevent default form submission

//         const formData = $(this).serialize(); // Serialize form data

//         $.ajax({
//             url: '/update-profile', // Replace with your Laravel route
//             type: 'POST',
//             data: formData,
//             success: function (response) {
//                 // Assuming the response indicates success
//                 if (response.success) {
//                     // Use Alpine.js to show the success modal
//                     Alpine.store('successModal', true); // Update Alpine.js state
//                 }
//             },
//             error: function (xhr) {
//                 // Handle errors (e.g., validation errors)
//                 console.error(xhr.responseText);
//             },
//         });
//     });
// });