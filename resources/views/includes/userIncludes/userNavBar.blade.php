<div class="h-fit bg-light-dark shadow-md w-full top-0 left-0 sticky  ">
    <div :class="{'hidden': !mobile}" class="h-8 flex items-center justify-start bg-dark px-4">
        <p class=" text-lg font-bold text-white">
            CareToFund.com
        </p>
    </div>
    <div class="h-13 px-4 flex items-center justify-between">
        <div class="flex items-center justify-center ">
            <button @click="open = !open" class="cursor-pointer me-2 hover:text-gray-300 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <img src="{{ asset('images/website_logo.png') }}" alt="logo" :class="{'hidden': mobile}" class="h-12 w-12">
        </div>

        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" oninput="loadCharities('', this.value, 'user')" class="block w-full p-2 ps-10 text-sm text-white rounded-xl bg-light " placeholder="Search Charities..." required />
        </div>
    </div>
</div>