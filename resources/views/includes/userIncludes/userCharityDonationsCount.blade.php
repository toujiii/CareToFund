<div class=" bg-primary-purple h-fit w-full rounded-md p-4 flex  gap-4 ">
    <div class="flex flex-col gap-2 flex-1 ">
        <div class="flex justify-between">
            <p class="text-sm font-bold">
                My Charities
            </p>
            <p class="text-sm font-bold ">
                {{ $charities->count() }}
            </p>
        </div>
        <button @click="isCharityDonationModalOpen = true; activeTabCharityDonations = 'charity'"  class="btn-tertiary-purple text-xs p-2 rounded-md ">
            View Charities
        </button>
    </div>
    <div class="flex flex-col gap-2 flex-1 ">
        <div class="flex justify-between">
            <p class="text-sm font-bold">
                My Donations
            </p>
            <p class="text-sm font-bold">
                {{ $user->donators->count() }}
            </p>
        </div>
        <button @click="isCharityDonationModalOpen = true; activeTabCharityDonations = 'donate'"  class="btn-tertiary-purple text-xs p-2 rounded-md ">
            View Donations
        </button>
    </div>
</div>