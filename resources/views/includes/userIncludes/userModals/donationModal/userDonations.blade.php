<div
    class=" fixed inset-0  z-50 w-full h-full flex items-center justify-center "
    role="dialog"
    tabindex="-1"
    x-show="isDonationModalOpen"
    x-transition.enter.opacity.duration.200ms
    >
    <div class="bg-black/60 z-40 backdrop-blur-xs w-full h-full absolute" x-on:click="isDonationModalOpen = false;"></div>
    <div
        class="relative z-100 bg-light-dark rounded-lg flex flex-col max-w-2xl shadow-lg m-2 overflow-y-auto p-4 h-fit"
        x-show="isDonationModalOpen"
        x-transition.enter.scale.duration.200ms>
        <div class="flex justify-between pb-2 border-b mb-2 gap-4">
            <p class=" text-2xl font-bold">Donate to John Doe</p>
            <button class="hover:text-gray-300 cursor-pointer" aria-label="Close" x-on:click="isDonationModalOpen=false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                </svg>
            </button>
        </div>
        <p class="text-sm text-gray-300">
            You can donate to this charity by filling out the form below. Please verify your information carefully before submitting.
        </p>
        <div>
            <p class="text-xl font-bold my-4">
                Project Safe Shelter
            </p>
            <div class="flex gap-8 mb-4 bg-light p-2 rounded-md">
                <p class="text-xs text-gray-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                        <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                    </svg>
                    PHP 500,000 
                </p>
                <p class="text-xs text-gray-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                    </svg>
                    7 Days
                </p>
            </div>
            <p class="text-sm h-30 overflow-y-auto">
                Thousands are left without homes after disasters. Your support helps rebuild lives by providing safe temporary shelters, clean water, and essential supplies to affected families.
                Thousands are left without homes after disasters. Your support helps rebuild lives by providing safe temporary shelters, clean water, and essential supplies to affected families.
                Thousands are left without homes after disasters. Your support helps rebuild lives by providing safe temporary shelters, clean water, and essential supplies to affected families.
            </p>
        </div>
        <div x-data="{ isAnonymous: false }" class="flex flex-col gap-2 h-fit pt-4 border-t mt-4">
            <div class="flex justify-between gap-1">
                <label class=" font-semibold text-sm">Amount To Donate</label>
                <label for="isAnonymous" class="flex items-center gap-1 text-sm  cursor-pointer select-none" 
                    :class="{ 'text-green-400': isAnonymous, 'text-gray-300 hover:text-gray-400': !isAnonymous }"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-incognito" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="m4.736 1.968-.892 3.269-.014.058C2.113 5.568 1 6.006 1 6.5 1 7.328 4.134 8 8 8s7-.672 7-1.5c0-.494-1.113-.932-2.83-1.205l-.014-.058-.892-3.27c-.146-.533-.698-.849-1.239-.734C9.411 1.363 8.62 1.5 8 1.5s-1.411-.136-2.025-.267c-.541-.115-1.093.2-1.239.735m.015 3.867a.25.25 0 0 1 .274-.224c.9.092 1.91.143 2.975.143a30 30 0 0 0 2.975-.143.25.25 0 0 1 .05.498c-.918.093-1.944.145-3.025.145s-2.107-.052-3.025-.145a.25.25 0 0 1-.224-.274M3.5 10h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5m-1.5.5q.001-.264.085-.5H2a.5.5 0 0 1 0-1h3.5a1.5 1.5 0 0 1 1.488 1.312 3.5 3.5 0 0 1 2.024 0A1.5 1.5 0 0 1 10.5 9H14a.5.5 0 0 1 0 1h-.085q.084.236.085.5v1a2.5 2.5 0 0 1-5 0v-.14l-.21-.07a2.5 2.5 0 0 0-1.58 0l-.21.07v.14a2.5 2.5 0 0 1-5 0zm8.5-.5h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5"/>
                    </svg>
                    Donate Anonymously
                </label>
                <input hidden id="isAnonymous" type="checkbox" x-model="isAnonymous">
            </div>
            <input type="text" class="w-full px-3 py-2 rounded-md text-black text-sm bg-white" required>
            <div class="flex items-start gap-2 mt-2 pb-4 border-b ">
                <input type="checkbox" id="termsCheckbox" required>
                <label for="termsCheckbox" class="text-sm text-gray-300 ">
                    I confirm that I am willingly making this donation and consent to its processing, including the secure handling of my personal and payment information in accordance with the Privacy Policy.
                </label>
            </div>
            <button class="btn-pink mt-2  self-end text-sm">
                Donate Now
            </button>
        </div>
    </div>
</div>