<div
    class=" fixed inset-0  z-50 w-full h-full flex items-center justify-center "
    role="dialog"
    tabindex="-1"
    x-show="isApproveRequestModalOpen"
    x-transition.enter.opacity.duration.200ms
    >
    <div class="bg-black/60 z-40 backdrop-blur-xs w-full h-full absolute" x-on:click="isApproveRequestModalOpen = false;"></div>
    <div
        class="relative z-100 bg-light-dark rounded-lg flex flex-col max-w-2xl shadow-lg m-2 overflow-y-auto p-4 h-fit"
        x-show="isApproveRequestModalOpen"
        x-transition.enter.scale.duration.200ms>
        <div class="flex justify-between pb-2 border-b mb-2 gap-4">
            <p class=" text-2xl font-bold"> Approve Charity</p>
            <button class="hover:text-gray-300 cursor-pointer" aria-label="Close" x-on:click="isApproveRequestModalOpen=false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                </svg>
            </button>
        </div>
        <p class="text-base my-4">
            Are you sure you want to approve this charity?
        </p>

        <div class="flex justify-end mt-4">
            <button class="bg-light hover:bg-light cursor-pointer rounded-md text-sm w-24" x-on:click="isApproveRequestModalOpen = false; ">
                Cancel
            </button>
            <button class="btn-pink text-sm w-24 ml-2" x-on:click=" isApproveRequestModalOpen = false; ">
                Confirm
            </button>
        </div>
    </div>
</div>