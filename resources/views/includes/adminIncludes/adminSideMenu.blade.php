 <div x-show="openSideMenu" class="flex" :class="{ 'absolute z-10 h-screen w-screen': adminMobile }">
     <div
         class="bg-light-dark w-60 border-r border-gray-500 flex flex-col">
         <div class="w-full p-4  flex flex-col items-center justify-center border-b border-gray-500 ">
             <img src="{{ asset('images/website_logo.png') }}" alt="logo" class="h-12 w-12">
             <p class="text-sm font-semibold text-white">
                 CareToFund Admin
             </p>
         </div>
         <div class="flex flex-col t p-4 gap-2">
             <button x-on:click="adminSectionActive = 'charities'" class="flex items-center gap-2 w-full hover:bg-light px-3 py-2 rounded-lg text-white cursor-pointer">
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box2-heart-fill" viewBox="0 0 16 16">
                     <path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zM8.5 4h6l.5.667V5H1v-.333L1.5 4h6V1h1zM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                 </svg>
                 Charities
             </button>
             <button x-on:click="adminSectionActive = 'requests'"  class="flex items-center gap-2 w-full hover:bg-light px-3 py-2 rounded-lg text-white cursor-pointer">
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                     <path d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                 </svg>
                 Requests
             </button>
             <button x-on:click="adminSectionActive = 'users'"  class="flex items-center gap-2 hover:bg-light px-3 py-2 rounded-lg text-white cursor-pointer">
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                     <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                 </svg>
                 Users
             </button>
         </div>
         <div class=" mt-auto px-4 py-8 border-t border-gray-500 w-full ">
             <button class="btn-logout w-full p-2 flex items-center justify-center gap-2 ">
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                     <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                     <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                 </svg>
                 Logout
             </button>
         </div>
     </div>
     <div x-on:click="openSideMenu = false" class="bg-black/50 backdrop-blur-xs flex-1 ">
     </div>

 </div>