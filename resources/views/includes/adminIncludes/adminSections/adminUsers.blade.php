<div 
    x-data="{
        UsersListTab: 'unarchived',
        users: [],
        async loadUsers() {
            try {
                const res = await fetch('{{ url('users') }}?with_trashed=1');
                const data = await res.json();
                this.users = data;
            } catch (e) {
                console.error('Failed to load users', e);
            }
        },
        get unarchivedUsers() {
            return this.users.filter(u => !u.deleted_at);
        },
        get archivedUsers() {
            return this.users.filter(u => u.deleted_at);
        }
    }"
    x-init="loadUsers()"
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
                    <template x-for="(user, index) in unarchivedUsers" :key="user.id">
                        <tr class="border-t border-gray-500 hover:bg-light ">
                            <td class="py-3 px-4 text-sm w-12" x-text="index + 1"></td>
                            <td class="py-3 px-4 text-sm min-w-20" x-text="user.name"></td>
                            <td class="py-3 px-4 text-sm" x-text="user.email"></td>
                            <td class="py-3 px-4 text-sm" x-text="user.gcash_number ?? '—'"></td>
                            <td class="py-3 px-4 text-sm" x-text="user.status ?? '—'"></td>
                            <td class="py-3 px-4 flex gap-4 text-sm">
                                <button x-on:click="isEditUsersModalOpen = true" class=" text-xs md:text-sm hover:text-yellow-300 cursor-pointer">
                                    <!-- edit icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </button>
                                <button x-on:click="isDeleteUserModalOpen = true" class="text-xs md:text-sm hover:text-red-500 cursor-pointer">
                                    <!-- trash icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
                <tbody x-show="UsersListTab === 'archived'">
                    <template x-for="(user, index) in archivedUsers" :key="user.id">
                        <tr class="border-t border-gray-500 hover:bg-light ">
                            <td class="py-3 px-4 text-sm w-12" x-text="index + 1"></td>
                            <td class="py-3 px-4 text-sm min-w-20" x-text="user.name"></td>
                            <td class="py-3 px-4 text-sm" x-text="user.email"></td>
                            <td class="py-3 px-4 text-sm" x-text="user.gcash_number ?? '—'"></td>
                            <td class="py-3 px-4 text-sm" x-text="user.status ?? '—'"></td>
                            <td class="py-3 px-4 flex gap-4 text-sm">
                                <button x-on:click="isEditUsersModalOpen = true" class=" text-xs md:text-sm hover:text-yellow-300 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </button>
                                <button x-on:click="isArchiveUserModalOpen = true" class="text-xs md:text-sm hover:text-red-500 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                                        <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-1v7a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V6H0V2zm2 3v7a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V5H2z"/>
                                        <path d="M5.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </template>
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