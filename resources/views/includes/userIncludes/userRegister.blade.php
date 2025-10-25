<div class="flex flex-col ">
    <p class="text-4xl font-bold">Create an account today!</p>
    <p class="text-sm ">
        Every great change starts with someone who cares — like you.
    </p>
</div>
<form action="{{ route('register') }}" method="POST" class="mt-8 flex flex-col w-full">
    @csrf
    <p class="text-sm mb-4">
        Enter your following details below to create your account:
    </p>
    <input type="text" name="name" placeholder="Username" class="mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" required>
    <input type="email" name="email" placeholder="Email" class="mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" required>
    <input type="password" name="password" placeholder="Password" class="mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="mb-8 px-3 py-2 rounded-md text-black text-sm bg-white" required>
    <button class="btn-pink " type="submit">
        Continue
    </button>

</form>
<div class="text-sm mt-2 w-full text-center">
    Already have an account?
    <button @click="activeTab = 'signin'" class="text-pink font-semibold cursor-pointer hover:underline">
        Sign In!
    </button>
</div>