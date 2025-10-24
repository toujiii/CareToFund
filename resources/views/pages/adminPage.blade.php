@extends('layouts.default')

@section('adminContent')

<div 
    x-data="{ 
        openSideMenu: true, 
        adminScreenWidth: window.innerWidth, 
        adminMobile: false, 
        adminSectionActive: 'charities'
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
    @resize.window="adminScreenWidth = window.innerWidth"

    >

    @include('includes.adminIncludes.adminSideMenu')

    @include('includes.adminIncludes.adminSideMenuToggle')

    <div class="flex-1 p-4 h-screen overflow-auto ">
        <div x-show="adminSectionActive === 'charities'">
            @include('includes.adminIncludes.adminSections.adminCharities')
        </div>
        <div x-show="adminSectionActive === 'requests'">
            @include('includes.adminIncludes.adminSections.adminRequests')
        </div>
        <div x-show="adminSectionActive === 'users'">
            @include('includes.adminIncludes.adminSections.adminUsers')
        </div>
    </div>
</div>

@endsection