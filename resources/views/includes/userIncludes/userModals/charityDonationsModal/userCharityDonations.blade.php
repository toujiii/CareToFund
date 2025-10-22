<div
    class=" fixed inset-0  z-50 w-full h-full flex items-center justify-center "
    role="dialog"
    tabindex="-1"
    x-show="isCharityDonationModalOpen"
    x-on:click.away="isCharityDonationModalOpen = false"
    x-transition.enter.opacity.duration.200ms>
    <div class="bg-black/60 z-40 backdrop-blur-xs w-full h-full absolute" x-on:click="isCharityDonationModalOpen = false;"></div>
    <div
        class="relative z-100 bg-light-dark rounded-lg flex justify-between min-h-150 max-w-2xl shadow-lg m-2 overflow-y-auto"
        x-show="isCharityDonationModalOpen"
        x-transition.enter.scale.duration.200ms>
        <div x-show="mobile === false" class=" flex flex-col bg-dark w-48 text-gray-300 sticky top-0 h-full min-h-150">
            <div @click="activeTabCharityDonations = 'charity'" :class=" activeTabCharityDonations === 'charity' ? 'bg-light-dark' : 'hover:bg-dark'" class="p-4 text-center cursor-pointer border-b border-gray-700 ">
                <p class=" text-sm ">
                    My Charities
                </p>
            </div>
            <div @click="activeTabCharityDonations = 'donate'" :class=" activeTabCharityDonations === 'donate' ? 'bg-light-dark' : 'hover:bg-dark'" class="p-4 text-center cursor-pointer border-b border-gray-700 ">
                <p class=" text-sm ">
                    My Donations
                </p>
            </div>
        </div>
        <div x-show="activeTabCharityDonations === 'charity'" class="m-4 max-w-md">

            @include('includes.userIncludes.userModals.charityDonationsModal.charityRecord')

        </div>
        <div x-show="activeTabCharityDonations === 'donate'" class="m-4 max-w-md">

            @include('includes.userIncludes.userModals.charityDonationsModal.donationRecord')

        </div>
    </div>
</div>