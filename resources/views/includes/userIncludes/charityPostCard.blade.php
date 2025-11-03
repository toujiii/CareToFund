

@if ($charities->isEmpty() || (Auth::check() && $charities->where('charity_request.user.id', '!=', auth()->user()->id)->where('charity_status', 'Ongoing')->isEmpty()) || (!Auth::check() && $charities->where('charity_status', 'Ongoing')->isEmpty()))
<div class="bg-light rounded-lg border border-gray-500 p-8 flex flex-col items-center justify-center gap-4 w-full ">
    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m-2.715 5.933a.5.5 0 0 1-.183-.683A4.5 4.5 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.5 3.5 0 0 0 8 10.5a3.5 3.5 0 0 0-3.032 1.75.5.5 0 0 1-.683.183M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8" />
    </svg>
    <p class="text-center text-sm text-gray-300">
        No records found.
    </p>
</div>
@endif

@foreach ($charities as $charity)
    @if (Auth::check() ? $charity->charity_request->user->id != auth()->user()->id && $charity->charity_status == 'Ongoing' : $charity->charity_status == 'Ongoing')
        <div class="h-fit w-full bg-light-dark rounded-lg p-4">
            <div class="flex items-center justify-between border-b-1 pb-4">
                <div class="flex items-center gap-2 ">
                    <div class="h-12 w-12 bg-gray-400 rounded-full">
                        <img src="{{ asset($charity->charity_request->user->user_front_link) }}" alt="" class=" h-full w-full object-cover rounded-full">
                    </div>
                    <div class="flex flex-col ">
                        <p class="text-sm">
                            {{ ucfirst($charity->charity_request->user->name) }}
                        </p>
                        <p class="text-xs text-gray-300">
                            {{ $charity->charity_request->approved_datetime->format('M d, Y') }}
                        </p>
                    </div>
                </div>
                <div title="Donations" class=" flex items-center gap-1 bg-light p-2 rounded-lg hover:bg-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                    </svg>
                    <p class="text-xs ">
                        {{ $charity->donators->count() }}
                    </p>
                </div>
            </div>
            <div class="flex flex-col gap-4 py-4">
                <p class="text-xl font-bold">
                    {{ $charity->charity_request->title }}
                </p>
                <p class="text-sm">
                    {{ $charity->charity_request->description }}
                </p>
            </div>
            <div class="flex items-center justify-between ">
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
            <div class=" flex items-center justify-between pt-2">
                <div class="flex items-center gap-2 text-sm text-pink font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                    </svg>
                    @if ($charity->charity_status === 'Ongoing') 
                        <span class="charity-countdown-timer" data-user-id="{{ $charity->charity_request->user->id }}" data-charity-id="{{ $charity->charity_id }}" data-charity-end-date="{{ \Carbon\Carbon::parse($charity->charity_request->approved_datetime)->addDays(7) }}"></span>
                    @else
                        <span class="text-gray-300">{{ $charity->charity_request->duration }} Days</span>
                    @endif
                </div>

                @if(Auth::check())
                    <button x-on:click="isDonationModalOpen = '{{ $charity->charity_id }}';" class=" btn-pink ">
                        <p class="  mx-1">
                            Donate
                        </p>
                    </button>

                    @include('includes.userIncludes.userModals.donationModal.userDonations', ['charity' => $charity])

                @else
                    <div class="flex items-center justify-center gap-2 text-gray-300">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                            </svg>
                        </p>
                        <p class="text-xs">
                            Sign in first to Donate
                        </p>
                    </div>
                @endif
            </div>
        </div>
    @endif
@endforeach

