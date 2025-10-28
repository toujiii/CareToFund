<div
    class=" fixed inset-0  z-50 w-full h-full flex items-center justify-center "
    role="dialog"
    tabindex="-1"
    x-show="isCreateNewCharityModalOpen"
    x-transition.enter.opacity.duration.200ms
    x-on:transitionend="if (!isCreateNewCharityModalOpen) newCharityStep = 1; "
    >
    <div class="bg-black/60 z-40 backdrop-blur-xs w-full h-full absolute" x-on:click="isCreateNewCharityModalOpen=false; $refs.newCharityForm.reset(); idImagePreview = null; newCharityFrontPreview = null; newCharitySidePreview = null;"></div>
    <div
        class="relative z-100 bg-light-dark rounded-lg flex flex-col max-w-2xl shadow-lg m-2 overflow-y-auto p-4 h-fit"
        x-show="isCreateNewCharityModalOpen"
        x-transition.enter.scale.duration.200ms>
        <div class="flex justify-between pb-2 border-b mb-2 gap-4">
            <p class=" text-2xl font-bold">New Charity</p>
            <button class="hover:text-gray-300 cursor-pointer" aria-label="Close" x-on:click=" isCreateNewCharityModalOpen=false; $refs.newCharityForm.reset(); idImagePreview = null; newCharityFrontPreview = null; newCharitySidePreview = null; ">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                </svg>
            </button>
        </div>
        <form x-ref="newCharityForm" id="newCharityForm" action="{{ route('user-create-new-charity') }}">
            @csrf
            <div x-show="newCharityStep === 1" class="flex flex-col">
   
                    @include('includes.userIncludes.userModals.createNewCharityModal.newCharityStep1')
     
            </div>
            <div x-show="newCharityStep === 2" class="flex flex-col">
        
                    @include('includes.userIncludes.userModals.createNewCharityModal.newCharityStep2')
       
            </div>

            @include('includes.userIncludes.userModals.createNewCharityModal.newCharityConfirmation')

        </form>
        
    </div>
</div>