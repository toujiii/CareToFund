<div
    class=" fixed inset-0  z-50 w-full h-full flex items-center justify-center "
    role="dialog"
    tabindex="-1"
    x-show="isSettingsModalOpen"
    x-on:click.away="isSettingsModalOpen = false"
    x-transition.enter.opacity.duration.200ms>
    <div class="bg-black/60 z-40 backdrop-blur-xs w-full h-full absolute" x-on:click="isSettingsModalOpen = false; frontFacePreview = null; sideFacePreview = null"></div>
    <div
        class="relative z-100 bg-light-dark rounded-lg flex justify-between min-h-150 max-w-2xl shadow-lg m-2 overflow-y-auto"
        x-show="isSettingsModalOpen"
        x-transition.enter.scale.duration.200ms>
        <div x-show="mobile === false" class=" flex flex-col bg-dark w-48 text-gray-300 sticky top-0 h-full min-h-150">
            <div @click="activeTabSettings = 'editProfile'" :class=" activeTabSettings === 'editProfile' ? 'bg-light-dark' : 'hover:bg-dark'" class="p-4 text-center cursor-pointer border-b border-gray-700 ">
                <p class=" text-sm ">
                    Edit User Profile
                </p>
            </div>
            <div @click="activeTabSettings = 'resetPassword'" :class=" activeTabSettings === 'resetPassword' ? 'bg-light-dark' : 'hover:bg-dark'" class="p-4 text-center cursor-pointer border-b border-gray-700 ">
                <p class=" text-sm ">
                    Reset Password
                </p>
            </div>
            <div @click="activeTabSettings = 'verifyAccount'" :class=" activeTabSettings === 'verifyAccount' ? 'bg-light-dark' : 'hover:bg-dark'" class="p-4 border-b border-gray-700 cursor-pointer text-center">
                <p class=" text-sm ">
                    Verify Account
                </p>
            </div>
        </div>
        <template x-if="activeTabSettings === 'editProfile'" >
            <div  class="m-4 max-w-md" >

                @include('includes.userIncludes.userModals.profileSettingsModal.profileSettingEditProfile')

            </div>
        </template>
        <template x-if="activeTabSettings === 'resetPassword'" >
            <div  class="m-4 max-w-md">

                @include('includes.userIncludes.userModals.profileSettingsModal.profileSettingResetPassword')

            </div>
        </template>
        <template x-if="activeTabSettings === 'verifyAccount'" >
            <div  class="m-4 max-w-md">

                @include('includes.userIncludes.userModals.profileSettingsModal.profileSettingVerifyAccount')

            </div>
        </template>
    </div>
</div>

