<div class="w-full bg-new-charity rounded-md p-4">
    <p class="flex items-center justify-start pb-2 text-white font-bold text-lg border-b-1 ">
        Pending for Approval
    </p>
    <div class="flex flex-col gap-1 pt-2 text-white ">
        <p class="text-base font-semibold ">
            {{ $charityRequests->title }}
        </p>
        <p class="text-sm max-h-30 overflow-auto ">
            {{ $charityRequests->description }}
        </p>
    </div>
    <div class="flex items-center  mt-4 text-white gap-4  ">
        <div class="flex items-center gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
            </svg>
            <p class="text-sm font-bold">
                PHP {{ number_format($charityRequests->fund_limit, 2) }}
            </p>
        </div>
        <div class="flex items-center gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
            </svg>
            <p class="text-sm font-bold">
                {{ $charityRequests->duration }} Days
            </p>
        </div>
    </div>
    <button x-on:click="isCancelPendingCharityModalOpen = true" class="btn-red-color w-full mt-4 p-2 text-sm">
        Cancel Charity
    </button>

</div>

@include('includes.userIncludes.userModals.cancelPendingCharityModal.userCancelsPendingCharity')