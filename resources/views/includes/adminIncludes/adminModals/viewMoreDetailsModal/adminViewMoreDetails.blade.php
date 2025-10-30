<div
    class=" fixed inset-0  z-60 w-full h-full flex items-center justify-center "
    role="dialog"
    tabindex="-1"
    x-show="isViewMoreDetailsModalOpen"
    x-transition.enter.opacity.duration.200ms>
    <div class="bg-black/60 z-40 backdrop-blur-xs w-full h-full absolute" x-on:click="isViewMoreDetailsModalOpen = false;"></div>
    <div
        class="relative z-100 bg-light-dark rounded-lg flex flex-col max-w-3xl shadow-lg m-2 overflow-auto p-4 h-[90vh]"
        x-show="isViewMoreDetailsModalOpen"
        x-transition.enter.scale.duration.200ms>
        <div class="flex justify-between pb-2 border-b mb-2 gap-4">
            <p class=" text-2xl font-bold">{{ strtok($charityRequest->user_id, ' ') }}'s Charity</p>
            <button class="hover:text-gray-300 cursor-pointer" aria-label="Close" x-on:click="isViewMoreDetailsModalOpen=false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                </svg>
            </button>
        </div>
        <p class="text-sm text-gray-300 ">
            Here are more details about this charity request. You can review the information provided by the user before making a decision.
        </p>

        <div class="flex justify-between mt-2 pb-2 border-b ">
            <p class="text-lg font-bold  self-center">
                Action:
            </p>
            <div class="flex gap-2">
                <button x-on:click="isRejectRequestModalOpen = true" class="btn-red-color text-xs md:text-sm w-20">
                    Reject
                </button>
                <button x-on:click="isApproveRequestModalOpen = true" class="btn-green-color text-xs md:text-sm">
                    Approve
                </button>
            </div>
        </div>

        @include('includes.adminIncludes.adminModals.viewMoreDetailsModal.basicDetails')
        
        <div x-show="viewMoreDetailsTab === 'idAndImages'" class="flex flex-col py-2 gap-2 sm:gap-4 mt-auto sm:flex-row h-130 sm:h-auto  overflow-auto">

            @include('includes.adminIncludes.adminModals.viewMoreDetailsModal.idAndImages')

        </div>
        <div x-show="viewMoreDetailsTab === 'imagesComparison'" class="flex flex-col py-2 gap-2 sm:gap-4 mt-auto sm:flex-row h-130 sm:h-auto  overflow-auto">

            @include('includes.adminIncludes.adminModals.viewMoreDetailsModal.imagesComparison')

        </div>
        <div class="w-full flex justify-end pt-4 border-t mt-2">
            <button x-show="viewMoreDetailsTab === 'idAndImages'" x-on:click="viewMoreDetailsTab = 'imagesComparison'" class="btn-pink text-sm w-40 flex items-center justify-center" x-on:click=" isViewMoreDetailsModalOpen = false; ">
                Compare Photos
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.86-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                </svg>
            </button>
            <button x-show="viewMoreDetailsTab === 'imagesComparison'" x-on:click="viewMoreDetailsTab = 'idAndImages'" class="btn-tertiary-purple text-sm w-20 flex items-center justify-center" x-on:click=" isViewMoreDetailsModalOpen = false; ">
                Back
            </button>
        </div>
    </div>
</div>
