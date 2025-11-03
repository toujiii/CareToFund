@if ($charities->isEmpty())
<div class="bg-light rounded-lg border border-gray-500 p-8 flex flex-col items-center justify-center gap-4  ">
    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m-2.715 5.933a.5.5 0 0 1-.183-.683A4.5 4.5 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.5 3.5 0 0 0 8 10.5a3.5 3.5 0 0 0-3.032 1.75.5.5 0 0 1-.683.183M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8" />
    </svg>
    <p class="text-center text-sm text-gray-300">
        No records found.
    </p>
</div>
@endif

@foreach ($charities as $charity)
    <div class="bg-light rounded-lg border border-gray-500 p-4 flex flex-col  ">
        <div class="flex items-center justify-between ">
            <div class="flex items-center gap-2 ">
                <div class="h-12 w-12 bg-gray-300 rounded-full">
                    <img src="{{ asset($charity->charity_request->user->user_front_link) }}" alt="" class="h-12 w-12 rounded-full object-cover">
                </div>
                <div class="flex flex-col ">
                    <p class="text-sm">
                        {{ ucfirst($charity->charity_request->user->name) }} 
                    </p>
                    <p class="text-xs text-gray-300">
                        Approved {{ $charity->charity_request->approved_datetime->format('M d, Y') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="flex gap-2 md:gap-4 mt-4 bg-light-dark p-2 md:p-4 rounded-md flex-wrap">
            <div x-on:click="isViewDonationsModalOpen = '{{ $charity->charity_id }}'" title="Donations" class=" flex items-center gap-2 bg-light p-2 rounded-lg hover:bg-light cursor-pointer  ">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                </svg>
                <p class="text-xs md:text-sm ">
                    {{ $charity->donators->count() }}
                </p>
            </div>

            

            <p class="text-xs md:text-sm  flex items-center gap-2 bg-light p-2 rounded-lg hover:bg-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                </svg>
                @if ($charity->charity_status === 'Ongoing') 
                    <span class="charity-countdown-timer" data-user-id="{{ $charity->charity_request->user->id }}" data-charity-id="{{ $charity->charity_id }}" data-charity-end-date="{{ \Carbon\Carbon::parse($charity->charity_request->approved_datetime)->addDays(7) }}"></span>
                @else
                    <span class="text-gray-300">{{ $charity->charity_request->duration }} Days</span>
                @endif
            </p>
            <p class="text-xs md:text-sm text-gray-300 flex items-center gap-2 bg-light p-2 rounded-lg hover:bg-light ">
                Status:
                @if($charity->charity_status == 'Ongoing')

                <span class=" text-yellow-400">In Progress</span>

                @elseif($charity->charity_status == 'Cancelled')

                <span class=" text-red-400">Cancelled</span>

                @elseif($charity->charity_status == 'Finished')

                <span class=" text-gray-400">Finished</span>

                @endif
            </p>
        </div>
        <div class="flex flex-col ">
            <p class="text-xl font-bold py-2">
                {{ $charity->charity_request->title }}
            </p>
            <p class="text-sm mb-4 max-h-20 overflow-auto">
                {{ $charity->charity_request->description }}
            </p>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                </svg>
                <p class="text-xs">
                    PHP {{ number_format($charity->raised, 2) }}
                </p>
            </div>
            <div class="flex items-center gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                    <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                </svg>
                <p class="text-xs">
                    PHP {{ number_format($charity->charity_request->fund_limit, 2) }}
                </p>
            </div>
        </div>

        <div
            x-data="{ progress: 0 }"
            x-init="
                setTimeout(() => {
                    progress = {{ round(($charity->raised / $charity->charity_request->fund_limit) * 100) }};
                }, 100);
            "
            class="w-full bg-gray-200 rounded-full my-2 overflow-hidden">
            <div
                class="bg-secondary-purple text-xs text-center py-[0.1rem] h-[15px] font-semibold leading-none rounded-full transition-[width] duration-1000 ease-in-out"
                :style="{ width: (progress < 100 ? progress : 100) + '%' }">
                <span x-show="progress > 5" x-text="progress + '%'"></span>
            </div>
        </div>
        @if( $charity->charity_status === 'Ongoing' )
            <div class=" flex items-center justify-end pt-4 mt-2 border-t border-gray-500">
                <button x-on:click="isCancelCharityModalOpen = '{{ $charity->charity_id }}'" class="btn-red-color text-xs md:text-sm">
                    Cancel Charity
                </button>
            </div>

            @include('includes.adminIncludes.adminModals.cancelCharityModal.adminCancelCharity', ['charityID' => $charity->charity_id])
            
        @endif
    </div>

    @include('includes.adminIncludes.adminModals.viewDonationsModal.adminViewDonations', ['charity' => $charity])
@endforeach