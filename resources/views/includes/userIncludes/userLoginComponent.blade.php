<div :class="{ 'hidden': !mobile,}" class="flex items-center justify-between mb-4 px-4">
    <p class="text-3xl font-bold ">
        CareToFund
    </p>
    <button class="text-white hover:text-gray-300 cursor-pointer" @click="open = false">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
        </svg>
    </button>
</div>
<div class="flex flex-col items-center justify-center gap-8 px-4">
    <ul class="flex flex-wrap  text-sm font-medium text-center w-full ">
        <li :class="activeTab === 'signin' ? ' border-white' : 'border-white/50'" class="flex-1 border-b-2 ">
            <button @click="activeTab = 'signin'" :class="{ 'text-white': activeTab === 'signin' }" class="inline-block pb-2 w-full cursor-pointer text-base">Sign In</button>
        </li>
        <li :class="activeTab === 'register' ? ' border-white' : 'border-white/50'" class="flex-1 border-b-2 ">
            <button @click="activeTab = 'register'" :class="{ 'text-white': activeTab === 'register' }" class="inline-block pb-2 w-full cursor-pointer text-base">Register</button>
        </li>
    </ul>

    <div x-show="activeTab === 'signin'" class="w-full flex flex-col items-start ">

        @include('includes.userIncludes.userSignIn')

    </div>
    <div x-show="activeTab === 'register'" class="w-full flex flex-col items-start ">

        @include('includes.userIncludes.userRegister')
        
    </div>

</div>