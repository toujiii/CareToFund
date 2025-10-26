<div class="flex justify-between pb-2 border-b mb-2">
    <p class=" text-2xl font-bold">Donation Record</p>
    <button class="hover:text-gray-300 cursor-pointer" aria-label="Close" x-on:click="isCharityDonationModalOpen=false">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
        </svg>
    </button>
</div>
<p class="mb-4 text-sm text-gray-300">
    Here is a record of your recent donations. You can review the details of each donation below.
</p>

<div class="flex flex-col gap-4 w-full max-h-115 overflow-y-auto rounded-lg ">
    @for($i = 0; $i < 10; $i++)
        <div class="bg-light hover:bg-light p-4 rounded-md ">
            <p class="font-semibold  ">Donation to Save the Children</p>
            <p class="text-sm text-gray-300">Charity Admin: John Doe</p>
            <p class="text-sm text-gray-300">Donated on: June 10, 2024</p>
            <p class="text-sm font-semibold text-end text-yellow-200 border-t border-white mt-2 pt-2">Donated: PHP 100.00</p>
        </div>
    @endfor
    <div class="bg-light p-4 rounded-md text-center">
        <p class="text-sm text-gray-300">
            No donation records found.
        </p>
    </div>
</div>
