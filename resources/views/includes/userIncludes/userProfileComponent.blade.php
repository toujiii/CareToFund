<div  class="h-full w-full flex flex-col gap-4 ">
    <div :class="{ 'hidden': !mobile,}" class="flex items-center justify-between mb-4 ">
        <p class="text-3xl font-bold ">
            CareToFund
        </p>
        <button class="text-white hover:text-gray-300 cursor-pointer" @click="open = false">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
            </svg>
        </button>
    </div>
    
    @include('includes.userIncludes.userProfileInfo')

    @include('includes.userIncludes.userCharityDonationsCount')
    
    <div class=" w-full  ">
        <p class="text-base">
            Current Charity
        </p>
    </div>

    @include('includes.userIncludes.currentCharity.createNewCharityBtn')

    <!-- @include('includes.userIncludes.currentCharity.pendingNewCharity') -->

    <!-- @include('includes.userIncludes.currentCharity.currentNewCharity') -->

    <form action="{{ route('logout') }}" method="POST" class="w-full mt-auto p-2 mb-4">
        @csrf
        <button type="submit" class="btn-logout w-full flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
            </svg>
            Logout
        </button>
    </form>
</div>

<!-- Modal Section -->
@include('includes.userIncludes.userModals.profileSettingsModal.userProfileSettings')

@include('includes.userIncludes.userModals.charityDonationsModal.userCharityDonations')

@include('includes.userIncludes.userModals.createNewCharityModal.userCreateNewCharity')

@include('includes.userIncludes.userModals.createNewCharityModal.newCharityConfirmation')

@include('includes.userIncludes.userModals.donationModal.userDonations')

@include('includes.userIncludes.userModals.cancelPendingCharityModal.userCancelsPendingCharity')

@include('includes.userIncludes.userModals.viewDonationsModal.userViewDonations')