<div class="flex justify-between pb-2 border-b mb-2">
    <p class=" text-2xl font-bold">Verify Account</p>
    <button
        class="hover:text-gray-300 cursor-pointer"
        aria-label="Close"
        x-on:click="isSettingsModalOpen = false; frontFacePreview = null; sideFacePreview = null"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            fill="currentColor"
            class="bi bi-x-circle-fill"
            viewBox="0 0 16 16"
        >
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"
            />
        </svg>
    </button>
</div>
<p class="mb-4 text-sm text-gray-300">
    Verify your account by confirming you Gcash number and uploading a image of your face.
</p>
<form
    id="verifyGcashForm"
    action="{{ route('verify-gcash') }}"
    class="flex flex-col mb-4"
>
    @csrf
    <span
        id="verifyGcashError"
        class="text-red-500 text-sm mb-4"
    ></span>
    <div class="mb-2 flex items-center gap-2">
        <label class="font-semibold text-sm">1. GCash Number</label>
        @if ($user->gcash_number != null)
            <p class="flex items-center text-sm text-green-500 gap-1">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-check-circle-fill"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                    />
                </svg>
            </p>
        @endif
    </div>
    <div class="flex gap-2 w-full">
        <input
            type="text"
            name="gcash_number"
            value="{{ $user->gcash_number ?? '' }}"
            placeholder=" 09********* "
            pattern="09[0-9]{9}"
            minlength="11"
            maxlength="11"
            class="flex-grow px-3 py-2 rounded-md text-black text-sm bg-white"
            required
            {{ $user->gcash_number ? 'disabled' : '' }}
        >

        @if ($user->gcash_number === null)
            <button
                type="submit"
                class="btn-tertiary-purple text-xs h-10 "
            >
                Verify
            </button>
        @endif

    </div>
</form>

<form
    id="verifyImagesForm"
    action="{{ route('verify-images') }}"
    class=" flex flex-col"
    :class="{ 'h-full': mobile }"
>
    @csrf
    <div class="mb-3 flex items-center gap-2">
        <label class=" font-semibold text-sm">2. User Images</label>

        @if ($user->user_front_link != null && $user->user_side_link != null)
            <p class="flex items-center text-sm text-green-500 gap-1">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-check-circle-fill"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                    />
                </svg>
            </p>
        @endif

    </div>
    <div
        class="flex gap-4 mb-4"
        :class="{ 'flex-col h-full': mobile, 'flex-row': !mobile }"
    >
        <label
            for="frontFace"
            class="flex-1 bg-gray-200 h-67 rounded-lg flex flex-col items-center justify-center hover:bg-gray-300 {{ $user->user_front_link != null ? 'cursor-default' : 'cursor-pointer' }} relative"
        >

            @if ($user->user_front_link === null)
                <template x-if="frontFacePreview">
                    <img
                        :src="frontFacePreview"
                        alt="Front Face Preview"
                        class="absolute inset-0 w-full h-full object-contain rounded-lg"
                    >
                </template>
                <div
                    x-show="!frontFacePreview"
                    class="flex flex-col items-center justify-center"
                >
                    <p class="text-gray-500 mb-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="32"
                            height="32"
                            fill="currentColor"
                            class="bi bi-image"
                            viewBox="0 0 16 16"
                        >
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            <path
                                d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z"
                            />
                        </svg>
                    </p>
                    <p class="text-gray-500 text-xs select-none">Upload Front Face</p>
                </div>
                <input
                    id="frontFace"
                    type="file"
                    name="front_face"
                    hidden
                    @change="let file = $event.target.files[0]; frontFacePreview = URL.createObjectURL(file)"
                    required
                >
            @else
                <img
                    src="{{ asset($user->user_front_link) }}"
                    alt=""
                    class="absolute inset-0 w-full h-full object-contain rounded-lg"
                >
            @endif
        </label>
        <label
            for="sideFace"
            class="flex-1 bg-gray-200 h-67 rounded-lg flex flex-col items-center justify-center hover:bg-gray-300 {{ $user->user_side_link != null ? 'cursor-default' : 'cursor-pointer' }} relative"
        >
            @if ($user->user_side_link === null)
                <template x-if="sideFacePreview">
                    <img
                        :src="sideFacePreview"
                        alt="Side Face Preview"
                        class="absolute inset-0 w-full h-full object-contain rounded-lg"
                    >
                </template>
                <div
                    x-show="!sideFacePreview"
                    class="flex flex-col items-center justify-center"
                >
                    <p class="text-gray-500 mb-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="32"
                            height="32"
                            fill="currentColor"
                            class="bi bi-image"
                            viewBox="0 0 16 16"
                        >
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            <path
                                d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z"
                            />
                        </svg>
                    </p>
                    <p class="text-gray-500 text-xs select-none">Upload Side Face</p>
                </div>
                <input
                    id="sideFace"
                    type="file"
                    name="side_face"
                    hidden
                    @change="let file = $event.target.files[0]; sideFacePreview = URL.createObjectURL(file)"
                    required
                >
            @else
                <img
                    src="{{ asset($user->user_side_link) }}"
                    alt=""
                    class="absolute inset-0 w-full h-full object-contain rounded-lg"
                >
            @endif
        </label>
    </div>

    <div
        x-show="frontFacePreview && sideFacePreview"
        class="w-full flex justify-end "
    >
        <button
            type="submit"
            class="btn-tertiary-purple  text-xs h-10"
            :class="{ 'mb-4': mobile }"
        >
            Submit Images
        </button>
    </div>

</form>
