<div class="flex justify-between pb-2 border-b mb-2">
    <p class=" text-2xl font-bold">Reset Password</p>
    <button class="hover:text-gray-300 cursor-pointer" aria-label="Close" x-on:click="isSettingsModalOpen=false">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
        </svg>
    </button>
</div>
<p class="mb-4 text-sm text-gray-300">
    You can reset your password by filling out the form below with your new password.
</p>

<!-- error messages -->
<!-- <p class="mb-4 text-sm text-green-500">
    Password Reset Successfully!
</p>
<p class="mb-4 text-sm text-red-500">
    Invalid input. Please check the fields and try again.
</p> -->

<form class="flex flex-col ">
    <label class="mb-2 font-semibold text-sm">Current Password</label>
    <input type="password"  class="w-full mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" required>
    <label class="mb-2 font-semibold text-sm">New Password</label>
    <input type="password"  class="w-full mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" required>
    <label class="mb-2 font-semibold text-sm">Confirm Password</label>
    <input type="passowrd" class="w-full mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" required>
    <button class="btn-tertiary-purple mt-12">
        Reset Password
    </button>
</form>