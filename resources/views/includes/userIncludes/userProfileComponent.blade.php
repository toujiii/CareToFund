<div  class="h-full w-full flex flex-col gap-4 " >
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

    @if ($user->gcash_number === null || $user->user_front_link === null || $user->user_side_link === null)
        <div class="bg-tertiary-purple flex items-center justify-start gap-2 p-4 rounded-md text-sm ">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                </svg>
            </p>
            <p>
                Verify your account first to create a charity.
            </p>
        </div>
    @else 

        @if($user->status === 'Offline')

            @include('includes.userIncludes.currentCharity.createNewCharityBtn')

        @elseif($user->status === 'Pending')
            
            <div id="pendingCharityRequestsContainer">
               
            </div>

        @elseif($user->status === 'Active')

            <div id="currentNewCharityContainer">

            </div>

        @elseif($user->status === 'Notified')

            <div id="userNotificationContainer">

            </div>

        @endif

    @endif

    <form action="{{ route('logout') }}" method="POST" class="w-full mt-auto mb-4">
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


@include('includes.userIncludes.userModals.charityDonationsModal.userCharityDonations')

@include('includes.userIncludes.userModals.createNewCharityModal.userCreateNewCharity')








@include('includes.userIncludes.userModals.responseModal.responseModal')

