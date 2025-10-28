<div 
    x-data="{
        UsersListTab: 'unarchived'
    }"
    class="bg-light-dark w-full h-full border-gray-500 border rounded-lg p-4 text-white overflow-auto flex flex-col ">
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
        <button x-on:click="UsersListTab = 'unarchived'" :class="{'bg-light': UsersListTab === 'unarchived'}" class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Unarchived List
        </button>
        <button x-on:click="UsersListTab = 'archived'" :class="{'bg-light': UsersListTab === 'archived'}" class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
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
                <tbody x-show="UsersListTab === 'unarchived'">

                    @include('includes.adminIncludes.adminSections.adminUsersList.adminUnarchivedUsers')
            
                </tbody>
                <tbody x-show="UsersListTab === 'archived'">

                    @include('includes.adminIncludes.adminSections.adminUsersList.adminArchivedUsers')

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

<!-- Modals -->

@include('includes.adminIncludes.adminModals.editUsersModal.adminEditUsersModal')

@include('includes.adminIncludes.adminModals.deleteArchiveUserModal.adminArchiveUser')

@include('includes.adminIncludes.adminModals.deleteArchiveUserModal.adminDeleteUser')