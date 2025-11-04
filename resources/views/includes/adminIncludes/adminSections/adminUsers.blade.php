<div
    x-data="{
        UsersListTab: 'unarchived',
        users: [],
        {{--  --}}
        meta: {},
        page: 1,
        perPage: 10,
        search: '',
        {{--  --}}
        selectedUser: null,
        selectedUserId: null,
        selectedUserName: null,
        selectedUserEmail: null,
        selectUser(user) {
            this.selectedUser = user;
            this.selectedUserId = user?.id ?? null;
            this.selectedUserName = user?.name ?? null;
            this.selectedUserEmail = user?.email ?? null;
        },
        responseModal: false,
        responseModalTitle: '',
        responseModalMessage: '',
        openResponseModal(detail) {
            this.responseModalTitle = 'Success';
            this.responseModalMessage = detail?.message ?? '';
            setTimeout(() => this.responseModal = true, 500);
            setTimeout(() => this.responseModal = false, 2000);
        },
        async loadUsers(page) { // page is optional
            {{-- // if page is provided (not undefined), set it; otherwise keep current page --}}
            if (typeof page !== 'undefined') {
                this.page = page || 1;
            } else {
                this.page = this.page || 1;
            }
    
            {{-- // determine status based on selected tab --}}
            const status = this.UsersListTab === 'archived' ? 'archived' : 'unarchived';
            const params = new URLSearchParams({
                status: status,
                page: this.page,
                per_page: this.perPage
            });
            if (this.search) params.set('q', this.search);
    
            try {
                const res = await fetch('{{ url('admin/users') }}' + '?' + params.toString(), {
                    headers: { 'Accept': 'application/json' }
                });
                if (!res.ok) throw new Error(`Failed to load users (${res.status})`);
                const payload = await res.json();
                console.log('loadUsers payload:', payload);
    
                {{-- // Handle Laravel paginator { data: [...], current_page, last_page, ... } or plain array --}}
                this.users = Array.isArray(payload) ? payload : (payload.data ?? []);
                this.meta = {
                    current_page: payload.current_page ?? this.page,
                    last_page: payload.last_page ?? 1,
                    per_page: payload.per_page ?? this.perPage,
                    total: payload.total ?? this.users.length
                };
            } catch (e) {
                console.error('Failed to load users', e);
                this.users = [];
                this.meta = { current_page: 1, last_page: 1, per_page: this.perPage, total: 0 };
            }
        },
        {{-- pagination helpers --}}
        prevPage() { if (this.page > 1) this.loadUsers(this.page - 1); },
        nextPage() { if (this.page < (this.meta.last_page || 1)) this.loadUsers(this.page + 1); },
        goTo(page) { if (page >= 1 && page <= (this.meta.last_page || 1)) this.loadUsers(page); },
    
        {{-- Search input to loadUsers --}}
        async searchUsers() {
            // normalize and trim query
            this.search = (this.search ?? '').trim();
    
            // if empty, still reset to page 1 so results match expectation
            // always request page 1 for new searches
            await this.loadUsers();
        },
        {{-- Async Archive User --}}
        async archiveUser(userId) {
            if (!userId) return;
            this.isArchiving = true;
            try {
                await window.adminUserAction('DELETE', `/admin/users/${encodeURIComponent(userId)}`);
                await this.loadUsers();
                this.isArchiveUserModalOpen = false;
                this.$dispatch('success-modal', {
                    title: 'User Archived',
                    message: 'Archived successfully'
                });
            } catch (e) {
                console.error(e);
                alert(e.message || 'Archive failed');
            } finally {
                this.isArchiving = false;
            }
        },
        {{-- Async Restore User --}}
        async restoreUser(userId) {
            if (!userId) return;
            this.isRestoring = true;
            try {
                await window.adminUserAction('PUT', `/admin/users/restore/${encodeURIComponent(userId)}`);
                await this.loadUsers();
                this.isRestoreUserModalOpen = false;
                this.$dispatch('success-modal', {
                    title: 'User Restored',
                    message: 'Restored successfully'
                });
            } catch (e) {
                console.error(e);
                alert(e.message || 'Restore failed');
            } finally {
                this.isRestoring = false;
            }
        },
        {{-- Async Delete User --}}
        async deleteUser(userId) {
            if (!userId) return;
            this.isDeleting = true;
            try {
                await window.adminUserAction('DELETE', `/admin/users/forceDelete/${encodeURIComponent(userId)}`);
                await this.loadUsers();
                this.isDeleteUserModalOpen = false;
                this.$dispatch('success-modal', {
                    title: 'User Deleted',
                    message: 'Deleted successfully'
                });
            } catch (e) {
                console.error(e);
                alert(e.message || 'Delete failed');
            } finally {
                this.isDeleting = false;
            }
        },
        {{-- Async Edit User --}}
        async saveUser() {
            if (!this.selectedUserId) return;
            this.isUpdatingUser = true;
            try {
                const payload = {
                    name: this.selectedUserName,
                    email: this.selectedUserEmail
                };
                await window.adminUserAction('PUT', `/admin/users/${encodeURIComponent(this.selectedUserId)}`, payload);
                this.isEditUsersModalOpen = false;
                await this.loadUsers();
                this.$dispatch('success-modal', {
                    title: 'User updated',
                    message: 'User updated successfully'
                });
            } catch (e) {
                console.error('Update failed', e);
                // show inline error message element if present
                const errEl = document.getElementById('updateProfileError');
                if (errEl) errEl.textContent = e.message || 'Update failed';
            } finally {
                this.isUpdatingUser = false;
            }
        },
        get unarchivedUsers() {
            return this.users.filter(u => !u.deleted_at);
        },
        get archivedUsers() {
            return this.users.filter(u => u.deleted_at);
        }
    }"
    {{-- Event para hindi bumalik sa request yung active tab,, yung naka comment }} --}}
    x-init="loadUsers();
    {{-- window.dispatchEvent(new CustomEvent('admin-section-active', { detail: 'users' })); --}}
    $watch('search', value => {
        const q = (value ?? '').trim();
        if (q === (this._lastSearch ?? '')) return;
        this._lastSearch = q;
        // always go to first page for a new search
        loadUsers();
    })"
    {{-- x-on:success-modal.window="openResponseModal($event.detail)" --}}
    class="bg-light-dark w-full h-full border-gray-500 border rounded-lg p-4 text-white overflow-auto flex flex-col "
>
    <div class="flex justify-between gap-4 flex-col md:flex-row ">
        <h2 class="md:text-2xl text-lg font-semibold min-w-45 md:w-60">Manage Users</h2>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg
                    class="w-4 h-4 text-white "
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 20 20"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                    />
                </svg>
            </div>
            <input
                type="search"
                {{-- x-on:input="searchUsers()" --}}
                x-model.debounce.100ms="search"
                id="default-search"
                class="block w-full p-2 ps-10 text-sm text-white rounded-xl bg-light "
                placeholder="Search Users..."
                required
            />
        </div>
    </div>
    <div class="flex gap-2 md:gap-4 mt-4 justify-end pb-4">
        <button
            x-on:click="UsersListTab = 'unarchived'; loadUsers(1)"
            :class="{ 'bg-light': UsersListTab === 'unarchived' }"
            class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer"
        >
            Unarchived List
        </button>
        <button
            x-on:click="UsersListTab = 'archived'; loadUsers(1)"
            :class="{ 'bg-light': UsersListTab === 'archived' }"
            class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer"
        >
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
                    <template
                        x-for="(user, index) in unarchivedUsers"
                        :key="user.id"
                    >
                        <tr class="border-t border-gray-500 hover:bg-light ">
                            <td
                                class="py-3 px-4 text-sm w-12"
                                x-text="index + 1"
                            ></td>
                            <td
                                class="py-3 px-4 text-sm min-w-20"
                                x-text="user.name"
                            ></td>
                            <td
                                class="py-3 px-4 text-sm"
                                x-text="user.email"
                            ></td>
                            <td
                                class="py-3 px-4 text-sm"
                                x-text="user.gcash_number ?? '—'"
                            ></td>
                            <td
                                class="py-3 px-4 text-sm"
                                x-text="user.status ?? '—'"
                            ></td>
                            <td class="py-3 px-4 flex gap-4 text-sm">
                                <button
                                    x-on:click="selectUser(user); isEditUsersModalOpen = true"
                                    class=" text-xs md:text-sm hover:text-yellow-300 cursor-pointer"
                                >
                                    <!-- edit icon -->
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        fill="currentColor"
                                        class="bi bi-pencil-square"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"
                                        />
                                    </svg>
                                </button>
                                <button
                                    x-on:click="selectUser(user); isArchiveUserModalOpen = true"
                                    class="text-xs md:text-sm hover:text-red-500 cursor-pointer"
                                >
                                    <!-- archive icon -->
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        fill="currentColor"
                                        class="bi bi-archive"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-1v7a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V6H0V2zm2 3v7a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V5H2z"
                                        />
                                        <path d="M5.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
                <tbody x-show="UsersListTab === 'archived'">
                    <template
                        x-for="(user, index) in archivedUsers"
                        :key="user.id"
                    >
                        <tr class="border-t border-gray-500 hover:bg-light ">
                            <td
                                class="py-3 px-4 text-sm w-12"
                                x-text="index + 1"
                            ></td>
                            <td
                                class="py-3 px-4 text-sm min-w-20"
                                x-text="user.name"
                            ></td>
                            <td
                                class="py-3 px-4 text-sm"
                                x-text="user.email"
                            ></td>
                            <td
                                class="py-3 px-4 text-sm"
                                x-text="user.gcash_number ?? '—'"
                            ></td>
                            <td
                                class="py-3 px-4 text-sm"
                                x-text="user.status ?? '—'"
                            ></td>
                            <td class="py-3 px-4 flex gap-4 text-sm">
                                <button
                                    x-on:click="selectUser(user); isRestoreUserModalOpen = true"
                                    class=" text-xs md:text-sm hover:text-yellow-300 cursor-pointer"
                                >
                                    <!-- restore icon -->
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        fill="currentColor"
                                        class="bi bi-arrow-bar-up"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5m-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5"
                                        />
                                    </svg>
                                </button>
                                <button
                                    x-on:click="selectUser(user); isDeleteUserModalOpen = true"
                                    class="text-xs md:text-sm hover:text-red-500 cursor-pointer"
                                >
                                    <!-- trash icon -->
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        fill="currentColor"
                                        class="bi bi-trash"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"
                                        />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"
                                        />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <!-- Pagination Controls -->
        <div class="mt-auto flex items-center justify-end gap-2">
            <button
                class="btn-tertiary-purple text-xs md:text-sm w-8 h-full flex items-center justify-center "
                :disabled="page <= 1"
                x-on:click="prevPage()"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    fill="currentColor"
                    class="bi bi-caret-left-fill"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="m3.86 8.753 5.482 4.796c.646.566 1.658.86 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"
                    />
                </svg>
            </button>

            <template x-if="meta.last_page && meta.last_page > 0">
                <div class="flex items-center gap-1">
                    <template
                        x-for="p in Array.from({length: Math.min(7, meta.last_page)}, (_,i) => {
                    const half = Math.floor(7/2);
                    let start = Math.max(1, Math.min(page - half, meta.last_page - 6));
                    return start + i;
                })"
                        :key="p"
                    >
                        <button
                            class="px-2 py-1 rounded"
                            :class="{ 'bg-light text-dark': page === p }"
                            x-text="p"
                            x-on:click="goTo(p)"
                        ></button>
                    </template>
                </div>
            </template>

            <button
                class="btn-tertiary-purple text-xs md:text-sm w-8 h-full flex items-center justify-center"
                :disabled="page >= (meta.last_page || 1)"
                x-on:click="nextPage()"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    fill="currentColor"
                    class="bi bi-caret-right-fill"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="m12.14 8.753-5.482 4.796c-.646.566-1.658.86-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"
                    />
                </svg>

            </button>

            <div class="ml-4 text-sm text-gray-300">
                <span x-text="`Page ${page} of ${meta.last_page ?? 1}`"></span>
                <span
                    class="ml-2"
                    x-text="meta.total ? `(${meta.total} users)` : ''"
                ></span>
            </div>

        </div>
    </div>
    <!-- Modals -->
    @include('includes.adminIncludes.adminModals.editUsersModal.adminEditUsersModal')

    @include('includes.adminIncludes.adminModals.restoreUser.adminRestoreuser')

    @include('includes.adminIncludes.adminModals.deleteArchiveUserModal.adminArchiveUser')

    @include('includes.adminIncludes.adminModals.deleteArchiveUserModal.adminDeleteUser')

</div>
