<div
    class=" fixed inset-0  z-50 w-full h-full flex items-center justify-center "
    role="dialog"
    tabindex="-1"
    x-show="isViewDonationsModalOpen === '{{ $charity->charity_id }}'"
    x-transition.enter.opacity.duration.200ms
    >
    <div class="bg-black/60 z-40 backdrop-blur-xs w-full h-full absolute" x-on:click="isViewDonationsModalOpen = '';"></div>
    <div
        class="relative z-100 bg-light-dark rounded-lg flex flex-col max-w-2xl shadow-lg m-2 overflow-y-auto p-4 h-fit"
        x-show="isViewDonationsModalOpen === '{{ $charity->charity_id }}'"
        x-transition.enter.scale.duration.200ms>
        <div class="flex justify-between pb-2 border-b mb-2 gap-4">
            <p class=" text-2xl font-bold">Donations</p>
            <button class="hover:text-gray-300 cursor-pointer" aria-label="Close" x-on:click="isViewDonationsModalOpen = ''">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                </svg>
            </button>
        </div>
        <p class="text-sm text-gray-300">
            Here is a record of your donations. You can review the details of each donation below.
        </p>
        <div class=" mt-4 h-100 overflow-y-auto border-1 rounded-md border-gray-400 p-2 ">
            <table class="w-full ">
                <thead>
                    <tr class="border-b border-gray-400">
                        <th class="text-left p-2">Username</th>
                        <th class="text-left p-2">Date Donated</th>
                        <th class="text-left p-2">Amount Donated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $charity->donators->sortByDesc('created_at') as $donation )
                        <tr class="border-b border-white hover:bg-light">
                            <td class="p-2 text-sm">
                                @if($donation->is_anonymous)
                                    Anonymous_{{ $donation->user->id }}{{ $donation->donator_id }}
                                @else
                                    {{ ucfirst(explode(' ', $donation->user->name)[0]) }}
                                @endif
                            </td>
                            <td class="p-2 text-sm">{{ $donation->created_at->diffForHumans() }}</td>
                            <td class="p-2 text-sm text-green-300">PHP {{ number_format($donation->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>