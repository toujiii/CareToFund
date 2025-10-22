<p class="text-sm text-gray-300 mb-4">
    Verify your charity by providing necessary IDs and facial Images to ensure authenticity.
</p>
<div class="flex gap-4 mb-4 h-50">
    <div class="flex flex-col flex-1 gap-4">
        <div class=" flex flex-col gap-2 h-fit">
            <label class="font-semibold text-sm">ID Type</label>
            <select class="w-full px-3 py-2 rounded-md text-black text-sm bg-white" required>
                <option hidden>Select Your ID</option>
                <option>National ID</option>
                <option>Driver's License</option>
                <option>Passport</option>
            </select>
        </div>
        <div class="flex flex-col gap-2 h-fit">
            <label class=" font-semibold text-sm">ID Number/Code</label>
            <input type="text" class="w-full px-3 py-2 rounded-md text-black text-sm bg-white" required>
        </div>
    </div>

    <div class=" flex flex-col flex-1">
        <p class="mb-2 font-semibold text-sm ">
            ID Attachment
        </p>
        <label for="idImage" class="flex-1 bg-gray-200  rounded-lg flex flex-col items-center justify-center hover:bg-gray-300 cursor-pointer relative">
            <template x-if="idImagePreview">
                <img :src="idImagePreview" alt="ID Image Preview" class="absolute inset-0 w-full h-full object-contain rounded-lg">
            </template>
            <div x-show="!idImagePreview" class="flex flex-col items-center justify-center">
                <p class="text-gray-500 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                    </svg>
                </p>
                <p class="text-gray-500 text-xs select-none">Upload ID Image</p>
            </div>
            <input id="idImage" type="file" hidden @change="let file = $event.target.files[0]; idImagePreview = URL.createObjectURL(file)" required>
        </label>
    </div>
</div>
<div class="flex gap-4 w-full" :class="{ 'flex-col  h-95 overflow-y-auto': mobile, 'h-95': !mobile }">
    <label for="newCharityFrontFace" class="flex-1 bg-gray-200 min-h-90 h-90 rounded-lg flex flex-col items-center justify-center hover:bg-gray-300 cursor-pointer relative">
        <template x-if="newCharityFrontPreview">
            <img :src="newCharityFrontPreview" alt="Front Face Preview" class="absolute inset-0 w-full h-full object-contain rounded-lg">
        </template>
        <div x-show="!newCharityFrontPreview" class="flex flex-col items-center justify-center">
            <p class="text-gray-500 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                </svg>
            </p>
            <p class="text-gray-500 text-xs select-none">Upload Front Face</p>
        </div>
        <input id="newCharityFrontFace" type="file" hidden @change="let file = $event.target.files[0]; newCharityFrontPreview = URL.createObjectURL(file)" required>
    </label>
    <label for="newCharitySideFace" class="flex-1 bg-gray-200 min-h-90 h-90 rounded-lg flex flex-col items-center justify-center hover:bg-gray-300 cursor-pointer relative">
        <template x-if="newCharitySidePreview">
            <img :src="newCharitySidePreview" alt="Side Face Preview" class="absolute inset-0 w-full h-full object-contain rounded-lg">
        </template>
        <div x-show="!newCharitySidePreview" class="flex flex-col items-center justify-center">
            <p class="text-gray-500 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                </svg>
            </p>
            <p class="text-gray-500 text-xs select-none">Upload Side Face</p>
        </div>
        <input id="newCharitySideFace" type="file" hidden @change="let file = $event.target.files[0]; newCharitySidePreview = URL.createObjectURL(file)" required>
    </label>
</div>

<div class="flex justify-between gap-4 mt-4">
    <button x-on:click="newCharityStep = 1" class="btn-tertiary-purple   text-sm w-24">
        Back
    </button>
    <button x-on:click="isCreateNewCharityConfirmationModalOpen = true;" class="btn-pink text-sm w-24">
        Submit
    </button>
</div>

