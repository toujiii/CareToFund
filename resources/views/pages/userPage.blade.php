@extends('layouts.default')

@section('userContent')

<!-- Modal Section -->
@include('includes.userIncludes.userModals.profileSettingsModal.userProfileSettings')

<div
    x-data="{ 
        open: true, 
        activeTab: 'signin', 
        screenWidth: window.innerWidth, 
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
    class="relative w-full h-screen  flex ">
    <div :class="{'block': open , 'hidden': !open , 'absolute z-10 w-full': mobile }" class="sideContent  w-110 h-screen shadow-md p-4 flex flex-col  justify-center">

        <!-- @include('includes.userIncludes.userLoginComponent') -->

        @include('includes.userIncludes.userProfileComponent')

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



@endsection