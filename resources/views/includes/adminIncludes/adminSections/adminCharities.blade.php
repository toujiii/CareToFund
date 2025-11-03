<div class="bg-light-dark w-full h-full border-gray-500 border rounded-lg p-4 text-white overflow-auto flex flex-col ">
    <div class="flex justify-between gap-4 flex-col md:flex-row ">
        <h2 class="md:text-2xl text-lg font-semibold min-w-45 md:w-60">Manage Charities</h2>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" onclick="loadCharities('', this.value, 'admin')" oninput="loadCharities('', this.value, 'admin')" class="block w-full p-2 ps-10 text-sm text-white rounded-xl bg-light " placeholder="Search Charities..." required />
        </div>
    </div>
    <div class="flex gap-2 md:gap-4 mt-4 justify-end pb-4 ">
        <button onclick="loadCharities('Finished', '', 'admin')" x-on:click="charitiesSortBy = charitiesSortBy === 'Finished' ? '' : 'Finished';" :class="{ 'bg-light': charitiesSortBy === 'Finished' }" class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Finished
        </button>
        <button onclick="loadCharities('Ongoing', '', 'admin')" x-on:click="charitiesSortBy = charitiesSortBy === 'In Progress' ? '' : 'In Progress';" :class="{ 'bg-light': charitiesSortBy === 'In Progress' }" class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            In Progress
        </button>
        <button onclick="loadCharities('Cancelled', '', 'admin')" x-on:click="charitiesSortBy = charitiesSortBy === 'Cancelled' ? '' : 'Cancelled';" :class="{ 'bg-light': charitiesSortBy === 'Cancelled' }" class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Cancelled
        </button>
    </div>
    <p class="text-xs md:text-sm pb-4 text-gray-300  border-b border-gray-500">
        These are the list of charities registered in the platform.
    </p>
    <div class="flex-1 mt-4 overflow-y-auto gap-4 flex flex-col h-70"  id="charitiesResultContainer">

    </div>
</div>

<!-- Modal Section -->



