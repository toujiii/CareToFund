<div class="bg-light-dark w-full h-full border-gray-500 border rounded-lg p-4 text-white overflow-auto flex flex-col ">
    <div class="flex justify-between gap-4 flex-col md:flex-row ">
        <h2 class="md:text-2xl text-lg font-semibold min-w-45 md:w-60">Manage Requests</h2>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" onclick="loadCharityRequestsSection('', '')" oninput="loadCharityRequestsSection('', this.value)" class="block w-full p-2 ps-10 text-sm text-white rounded-xl bg-light " placeholder="Search Requests..." required />
        </div>
    </div>
    <div class="flex gap-2 mt-4 justify-end pb-4">
        <button onclick="loadCharityRequestsSection('Approved', '')" x-on:click="charityRequestSortBy = charityRequestSortBy === 'Approved' ? '' : 'Approved';" :class="{ 'bg-light': charityRequestSortBy === 'Approved' }" class="flex-1 px-1 py-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Approved
        </button>
        <button onclick="loadCharityRequestsSection('Pending', '')" x-on:click="charityRequestSortBy = charityRequestSortBy === 'Pending' ? '' : 'Pending';" :class="{ 'bg-light': charityRequestSortBy === 'Pending' }" class="flex-1 px-1 py-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Pending
        </button>
        <button onclick="loadCharityRequestsSection('Rejected', '')" x-on:click="charityRequestSortBy = charityRequestSortBy === 'Rejected' ? '' : 'Rejected';" :class="{ 'bg-light': charityRequestSortBy === 'Rejected' }" class="flex-1 px-1 py-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Rejected
        </button>
        <button onclick="loadCharityRequestsSection('Cancelled', '')" x-on:click="charityRequestSortBy = charityRequestSortBy === 'Cancelled' ? '' : 'Cancelled';" :class="{ 'bg-light': charityRequestSortBy === 'Cancelled' }" class="flex-1 px-1 py-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Cancelled
        </button>
    </div>
    <p class="text-xs md:text-sm pb-4 text-gray-300  border-b border-gray-500">
        These are the list of charity requests submitted by users.
    </p>
    <div class="flex-1 mt-4 overflow-y-auto gap-4 flex flex-col h-70" id="charityRequestsSectionContainer">
        {{-- Charity Requests Section --}}
        
       
    </div>
</div>

<!-- Modal Section -->

@include('includes.adminIncludes.adminModals.viewMoreDetailsModal.adminViewMoreDetails')





