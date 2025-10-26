@extends('layouts.default')

@section('userContent')



<div
    x-data="{ 
        open: true, 
        activeTab: 'signin', 
        screenWidth: window.innerWidth, 
        isSettingsModalOpen: false, 
        activeTabSettings: '', 
        isCharityDonationModalOpen: false,
        activeTabCharityDonations: '',
        isCreateNewCharityModalOpen: false,
        newCharityStep: 1,
        isCreateNewCharityConfirmationModalOpen: false,
        isDonationModalOpen: false,
        isCancelPendingCharityModalOpen: false,
        isViewDonationsModalOpen: false,
        mobile: false, 
        frontFacePreview: null, 
        sideFacePreview: null,
        idImagePreview: null,
        newCharityFrontPreview: null,
        newCharitySidePreview: null,
        successModal: false,
    }"
    x-init="
        screenWidth = window.innerWidth;
        open = screenWidth > 1000 ? true : false;
        mobile = screenWidth > 1000 ? false : true;
        $watch('screenWidth', value => { 
            open = value > 1000 ? true : false; 
            mobile = value > 1000 ? false : true; 
    });"
    @resize.window="screenWidth = window.innerWidth"
    @reset-previews.window="frontFacePreview = null; sideFacePreview = null"
    class="relative w-full h-screen  flex ">
    <div :class="{'block': open , 'hidden': !open , 'absolute z-10 w-full': mobile }" class="sideContent  w-110 h-screen shadow-md p-4 flex flex-col  justify-center">

        @if(Auth::check())
            @include('includes.userIncludes.userProfileComponent')
        @else
            @include('includes.userIncludes.userLoginComponent')
        @endif

        <p class="text-xs text-center mt-auto">
            © {{ date('Y') }} CareToFund. All rights reserved.
        </p>
    </div>

    <div class="flex flex-1 h-screen flex relative overflow-auto ">
        <div class="z-0 w-full h-fit flex flex-col relative">

            @include('includes.userIncludes.userNavBar')

            <div class=" w-full  flex flex-col gap-4 items-start justify-center p-4 ">
                @for ($i = 0; $i < 5; $i++)

                    @include('includes.userIncludes.charityPostCard')

                @endfor
                  
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
@vite('resources/js/user-scripts.js')

@endsection