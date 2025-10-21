<div class="w-full bg-new-charity rounded-md p-4">
    <p class="flex items-center justify-start pb-2 text-white font-bold text-lg border-b-1 ">
        Project Safe Shelter
    </p>
    <div class="flex flex-col gap-1 pt-2 text-white ">
        <p class="text-xs ">
            Approved on Dec 12, 2025
        </p>
        <p class="text-sm h-30 overflow-auto ">
            Thousands are left without homes after disasters. Your support helps rebuild lives by providing safe temporary shelters, clean water, and essential supplies to affected families.
            Thousands are left without homes after disasters. Your support helps rebuild lives by providing safe temporary shelters, clean water, and essential supplies to affected families.
            Thousands are left without homes after disasters. Your support helps rebuild lives by providing safe temporary shelters, clean water, and essential supplies to affected families.
        </p>
    </div>
    <div class="flex items-center justify-between mt-4">
        <div class="flex items-center gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
            </svg>
            <p class="text-xs font-bold">
                PHP 250,000
            </p>
        </div>
        <div class="flex items-center gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
            </svg>
            <p class="text-xs font-bold">
                PHP 500,000
            </p>
        </div>
    </div>

    <div
        x-data="{ progress: 0 }"
        x-init="
            setTimeout(() => {
                progress = 70; 
            }, 100);
        "
        class="w-full bg-gray-200 rounded-full my-2 overflow-hidden">
        <div
            class="bg-secondary-purple text-xs text-center py-[0.1rem] font-semibold leading-none rounded-full transition-[width] duration-1000 ease-in-out"
            :style="{ width: (progress < 100 ? progress : 100) + '%' }">
            <span x-text="progress + '%'"></span>
        </div>
    </div>
    <div class=" flex items-center justify-between pt-2">
        <div class="flex items-center gap-2 text-sm text-white font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
            </svg>
            <p>
                25 days left
            </p>
        </div>
        <button title="Donations" class=" flex items-center gap-1 btn-tertiary-purple p-2 rounded-lg ">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
            </svg>
            <p class="text-xs ">
                54
            </p>
        </button>

    </div>

</div>