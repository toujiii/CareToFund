<div class="bg-light-dark w-full h-full border-gray-500 border rounded-lg p-4 text-white overflow-auto flex flex-col ">
    <div class="flex justify-between gap-4 flex-col md:flex-row ">
        <h2 class="md:text-2xl text-lg font-semibold min-w-45 md:w-60">Manage Users</h2>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full p-2 ps-10 text-sm text-white rounded-xl bg-light " placeholder="Search Users..." required />
        </div>
    </div>
    <div class="flex gap-2 md:gap-4 mt-4 justify-end pb-4">
        <button class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Unarchived List
        </button>
        <button class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Archived List
        </button>
    </div>
    <p class="text-xs md:text-sm pb-4 text-gray-300  border-b border-gray-500">
        These are the list of users registered in the platform.
    </p>
    <div class="flex-1 mt-4 overflow-hidden gap-2 flex flex-col h-60  rounded-lg ">
        <div class="w-full overflow-auto border border-gray-500 rounded-lg "> 
            <table class="w-full overflow-auto border-spacing-x-10">
                <thead>
                    <tr class=" bg-dark">
                        <th class="text-start py-3 px-4 text-sm">#</th>
                        <th class="text-start py-3 px-4 text-sm">Name</th>
                        <th class="text-start py-3 px-4 text-sm">Email</th>
                        <th class="text-start py-3 px-4 text-sm">GCash</th>
                        <th class="text-start py-3 px-4 text-sm">Status</th>
                        <th class="text-start py-3 px-4 text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    @for ($i = 0; $i < 10; $i++)
                        <tr class="border-t border-gray-500 hover:bg-light ">
                            <td class="py-3 px-4 text-sm w-12">{{ $i + 1 }}</td>
                            <td class="py-3 px-4 text-sm min-w-20">User {{ $i + 1 }}</td>
                            <td class="py-3 px-4 text-sm">user{{ $i + 1 }}@example.com</td>
                            <td class="py-3 px-4 text-sm">0900000000</td>
                            <td class="py-3 px-4 text-sm">Active</td>
                            <td class="py-3 px-4 flex gap-4 text-sm">
                                <button class=" text-xs md:text-sm hover:text-yellow-300 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                </button>
                                <button class="text-xs md:text-sm hover:text-red-500 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                                    <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <div class=" flex items-center justify-center md:justify-end gap-2 mt-auto h-8 ">
            <button class="btn-tertiary-purple text-xs md:text-sm w-8 h-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.86 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg>
            </button>
            <button class="btn-tertiary-purple text-xs md:text-sm w-8 h-full flex items-center justify-center">
                1
            </button>
            <button class="btn-tertiary-purple text-xs md:text-sm w-8 h-full flex items-center justify-center">
                2
            </button>
            <button class=" text-xs md:text-sm w-8 h-full">
                ...
            </button>
            <button class="btn-tertiary-purple text-xs md:text-sm w-8 h-full flex items-center justify-center">
                4
            </button>
            <button class="btn-tertiary-purple text-xs md:text-sm w-8 h-full flex items-center justify-center">
                5
            </button>
            <button class="btn-tertiary-purple text-xs md:text-sm w-8 h-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.86-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                </svg>
            </button>

        </div>
    </div>
</div>