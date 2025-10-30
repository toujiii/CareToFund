@extends('layouts.default')

@section('adminContent')

<div
    x-data="{ 
        openSideMenu: true, 
        adminScreenWidth: window.innerWidth, 
        adminMobile: false, 
        adminSectionActive: 'requests',
        isCancelCharityModalOpen: false,
        isRejectRequestModalOpen: false,
        isApproveRequestModalOpen: false,
        isViewDonationsModalOpen: false,
        isViewMoreDetailsModalOpen: false,
        viewMoreDetailsTab: 'idAndImages',
        isEditUsersModalOpen: false,
        isDeleteUserModalOpen: false,
        isArchiveUserModalOpen: false
    }"
    x-init="
        adminScreenWidth = window.innerWidth;
        openSideMenu = adminScreenWidth > 1000 ? true : false;
        adminMobile = adminScreenWidth > 1000 ? false : true;
        $watch('adminScreenWidth', value => { 
            openSideMenu = value > 1000 ? true : false; 
            adminMobile = value > 1000 ? false : true; 
    });"

    class="flex h-screen"
    @resize.window="adminScreenWidth = window.innerWidth">

    @include('includes.adminIncludes.adminSideMenu')

    @include('includes.adminIncludes.adminSideMenuToggle')

    <div class="flex-1 p-4 h-screen overflow-auto ">
        <template x-if="adminSectionActive === 'charities'">
            <div class="h-full">
                @include('includes.adminIncludes.adminSections.adminCharities')
            </div>
        </template>
        <template x-if="adminSectionActive === 'requests'">
            <div class="h-full" id="adminRequestsSectionContainer">
               
            </div>
        </template>
        <template x-if="adminSectionActive === 'users'">
            <div class="h-full">
                @include('includes.adminIncludes.adminSections.adminUsers')
            </div>
        </template>
    </div>
</div>

<!-- Scripts -->

@vite('resources/js/admin-scripts.js')

@endsection