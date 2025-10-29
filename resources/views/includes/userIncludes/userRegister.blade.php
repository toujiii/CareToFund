@if ($errors->any())
    @if (app()->environment('local'))
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                const errors = @json($errors->all());
                alert('Please fix the following:\n\n' + errors.join('\n'));
                // ensure the parent Alpine component switches to the register tab
                window.dispatchEvent(new CustomEvent('set-active-tab', { detail: 'register' }));
            });
        </script>
    @else
        <ul class="list-disc list-inside text-red-600 font-bold">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <script>
            // when there are validation errors after redirect, tell the Alpine root to open the register tab
            window.addEventListener('DOMContentLoaded', function () {
                window.dispatchEvent(new CustomEvent('set-active-tab', { detail: 'register' }));
            });
        </script>
    @endif
@endif

<div class="flex flex-col ">
    <p class="text-4xl font-bold">Create an account today!</p>
    <p class="text-sm ">
        Every great change starts with someone who cares — like you.
    </p>
</div>
<form
    id="userRegisterForm"
    action="{{ route('register') }}"
    method="POST"
    class="mt-8 flex flex-col w-full"
>
    @csrf
    <p class="text-sm mb-4">
        Enter your following details below to create your account:
    </p>
    <input
        value="{{ old('name') }}"
        type="text"
        name="name"
        placeholder="Username"
        class="mb-4 px-3 py-2 rounded-md text-black text-sm bg-white"
        required
    >
    <input
        value="{{ old('email') }}"
        type="email"
        name="email"
        placeholder="Email"
        class="mb-4 px-3 py-2 rounded-md text-black text-sm bg-white"
        required
    >
    <input
        type="password"
        name="password"
        placeholder="Password"
        class="mb-4 px-3 py-2 rounded-md text-black text-sm bg-white"
        required
    >
    <input
        type="password"
        name="password_confirmation"
        placeholder="Confirm Password"
        class="mb-8 px-3 py-2 rounded-md text-black text-sm bg-white"
        required
    >
    <button
        class="btn-pink "
        type="submit"
    >
        Continue
    </button>

</form>
<div class="text-sm mt-2 w-full text-center">
    Already have an account?
    <button
        @click="activeTab = 'signin'"
        class="text-pink font-semibold cursor-pointer hover:underline"
    >
        Sign In!
    </button>
</div>
