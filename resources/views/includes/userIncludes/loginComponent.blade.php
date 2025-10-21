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
        <div class="flex flex-col ">
            <p class="text-4xl font-bold">Welcome back, Funder!</p>
            <p class="text-sm ">
                Your kindness keeps the mission alive. Let’s make today count for someone in need.
            </p>
        </div>
        <form action="" class="mt-8 flex flex-col w-full">
            @csrf
            <p class="text-sm mb-4">
                Enter your following details bellow to continue on funding:
            </p>
            <input type="email" placeholder="Email" class="mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" required>
            <input type="password" placeholder="Password" class="mb-8 px-3 py-2 rounded-md text-black text-sm bg-white" required>
            <button class="btn-pink ">
                Continue
            </button>

        </form>
        <div class="my-2 flex flex-row justify-center items-center w-full gap-2">
            <div class="border-t border-gray-300 w-1/2"></div>
            <p>Or</p>
            <div class="border-t border-gray-300 w-1/2"></div>
        </div>
        <button class="btn-primary-purple mb-4 w-full flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
            </svg>
            Sign In with Google
        </button>
        <button class="btn-primary-purple w-full flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
            </svg>
            Sign In with Facebook
        </button>
        <div class="text-sm mt-2 w-full text-center">
            Don’t have an account yet?
            <a href="" class="text-pink font-semibold cursor-pointer hover:underline">
                Register Now!
            </a>
        </div>
    </div>
    <div x-show="activeTab === 'register'" class="w-full flex flex-col items-start ">
        <div class="flex flex-col ">
            <p class="text-4xl font-bold">Create an account today!</p>
            <p class="text-sm ">
                Every great change starts with someone who cares — like you.
            </p>
        </div>
        <form action="" class="mt-8 flex flex-col w-full">
            @csrf
            <p class="text-sm mb-4">
                Enter your following details below to create your account:
            </p>
            <input type="text" placeholder="Username" class="mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" required>
            <input type="email" placeholder="Email" class="mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" required>
            <input type="password" placeholder="Password" class="mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" required>
            <input type="password" placeholder="Confirm Password" class="mb-8 px-3 py-2 rounded-md text-black text-sm bg-white" required>
            <button class="btn-pink ">
                Continue
            </button>

        </form>
        <div class="text-sm mt-2 w-full text-center">
            Already have an account?
            <a href="" class="text-pink font-semibold cursor-pointer hover:underline">
                Sign In!
            </a>
        </div>
    </div>

</div>