<div class="bg-light-dark w-full h-full border-gray-500 border rounded-lg p-4 text-white overflow-auto flex flex-col ">
    <div class="flex justify-between gap-4 flex-col md:flex-row ">
        <h2 class="md:text-2xl text-lg font-semibold min-w-45 md:w-60">Manage Requests</h2>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full p-2 ps-10 text-sm text-white rounded-xl bg-light " placeholder="Search Requests..." required />
        </div>
    </div>
    <div class="flex gap-2 md:gap-4 mt-4 justify-end pb-4">
        <button class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Approved
        </button>
        <button class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Pending
        </button>
        <button class="flex-1 p-2 bg-light-dark hover:bg-light rounded-lg border border-gray-500 text-xs md:text-sm cursor-pointer">
            Rejected
        </button>
    </div>
    <p class="text-xs md:text-sm pb-4 text-gray-300  border-b border-gray-500">
        These are the list of charity requests submitted by users.
    </p>
    <div class="flex-1 mt-4 overflow-y-auto gap-4 flex flex-col h-70">
       
        @foreach ($charityRequests as $charityRequest)
            <div class="bg-light rounded-lg border border-gray-500 p-4 flex flex-col  ">
                <div class="flex items-center justify-between ">
                    <div class="flex items-center gap-2 ">
                        <div class="h-12 w-12 bg-gray-300 rounded-full">
                            <img src="{{ asset($charityRequest->user->user_front_link) }}" alt="" class=" w-full h-full object-cover rounded-full">
                        </div>
                        <div class="flex flex-col ">
                            <p class="text-sm">
                                {{ $charityRequest->user->name }}
                            </p>
                            <p class="text-xs text-gray-300">
                                Requested on {{ $charityRequest->datetime->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                    <div x-on:click="isViewMoreDetailsModalOpen = true" title="More" class=" flex items-center gap-2 bg-light-dark p-2 rounded-full hover:bg-light-dark cursor-pointer  ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                        </svg>
                    </div>
                </div>
                <div class="flex gap-2 md:gap-4 mt-4 bg-light-dark p-2 md:p-4 rounded-md flex-wrap">
                    <div class="flex items-center gap-2 items-center gap-2 bg-light p-2 rounded-lg hover:bg-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                            <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                        </svg>
                        <p class="text-xs">
                            PHP {{ number_format($charityRequest->fund_limit, 2) }}
                        </p>
                    </div>
                    <p class="text-xs md:text-sm  flex items-center gap-2 bg-light p-2 rounded-lg hover:bg-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                        </svg>
                        {{ $charityRequest->duration }} Days
                    </p>
                    <p class="text-xs md:text-sm text-gray-300 flex items-center gap-2 bg-light p-2 rounded-lg hover:bg-light ">
                        Status: 
                        @if($charityRequest->request_status == 'Pending')

                            <span class=" text-yellow-400">Pending</span>

                        @elseif($charityRequest->request_status == 'Approved')

                            <span class=" text-green-400">Approved</span>

                        @elseif($charityRequest->request_status == 'Rejected')

                            <span class=" text-red-400">Rejected</span>

                        @elseif($charityRequest->request_status == 'Cancelled')

                            <span class=" text-gray-400">Cancelled</span>

                        @endif
                    </p>
                </div>
                <div class="flex flex-col ">
                    <p class="text-xl font-bold py-2">
                        {{ $charityRequest->title }}
                    </p>
                    <p class="text-sm mb-4 max-h-20 overflow-auto">
                        {{ $charityRequest->description }}
                    </p>
                </div>
                @if( $charityRequest->request_status === 'Pending'  )
                    <div class=" flex items-center justify-end pt-4 border-t border-gray-500 gap-2 ">
                        <button x-on:click="isRejectRequestModalOpen = true" class="btn-red-color text-xs md:text-sm w-20">
                            Reject
                        </button>
                        <button x-on:click="isApproveRequestModalOpen = true" class="btn-green-color text-xs md:text-sm">
                            Approve
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
       
    </div>
</div>

<!-- Modal Section -->

@include('includes.adminIncludes.adminModals.rejectRequestModal.adminRejectRequest')

@include('includes.adminIncludes.adminModals.approveRequestModal.adminApproveRequest')

@include('includes.adminIncludes.adminModals.viewMoreDetailsModal.adminViewMoreDetails')

