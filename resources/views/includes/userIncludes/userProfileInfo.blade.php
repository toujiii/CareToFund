<div class="bg-primary-purple h-fit w-full rounded-md p-4 flex flex-col gap-4 ">
    <div class="flex items-center gap-2 ">
        <div class="h-14 w-14 bg-gray-200 rounded-full">

        </div>
        <div class=" flex flex-col items-start ">
            <div class="flex items-center gap-2">
                <p class="font-bold text-base ">
                   {{ $user->name }}
                </p>
                @if ($user->gcash_number === null || $user->user_front_link === null || $user->user_side_link === null)
                    <div class="text-xs bg-yellow-400  rounded-lg px-2">
                        Unverified
                    </div>
                @else 
                    <div class="text-xs bg-green-500 text-white rounded-lg px-2">
                        Verified
                    </div>
                @endif
            </div>
            <p class="text-xs text-gray-200 mb-2">
                {{ $user->email }}
            </p>
        </div>

    </div>
    <div class=" flex gap-2 ">
        <button x-on:click="isSettingsModalOpen = true; activeTabSettings = 'editProfile'" class="btn-tertiary-purple flex-1 text-xs p-2 rounded-md">
            Edit Profile
        </button>
        <button x-on:click="isSettingsModalOpen = true; activeTabSettings = 'resetPassword'" class="btn-tertiary-purple flex-1 text-xs p-2 rounded-md">
            Password
        </button>
        <button x-on:click="isSettingsModalOpen = true; activeTabSettings = 'verifyAccount'" class="btn-tertiary-purple flex-1 text-xs p-2 rounded-md">
            Verification
        </button>
    </div>
</div>

@include('includes.userIncludes.userModals.profileSettingsModal.userProfileSettings', ['user' => $user])