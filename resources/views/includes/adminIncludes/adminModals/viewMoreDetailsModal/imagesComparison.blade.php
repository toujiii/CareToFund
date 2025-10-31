<div class="flex-1 flex-col flex gap-1">
    <p class=" text-lg font-bold ">
        Front View
    </p>
    <div class="flex gap-2 flex-1">
        <div class="flex-1 bg-gray-300 h-60 rounded-md overflow-hidden flex items-center justify-center">
            <img src="{{ asset($focusedCharityRequest->front_face_link) }}" alt="" class="w-full h-full object-contain object-center"/>
         </div>
        <div class="flex-1 bg-gray-300 h-60 rounded-md overflow-hidden flex items-center justify-center">
            <img src="{{ asset($focusedCharityRequest->user->user_front_link) }}" alt="" class="w-full h-full object-contain object-center"/>
        </div>
    </div>
</div>
<div class="flex-1 flex-col flex gap-1">
    <p class=" text-lg font-bold ">
        Side View
    </p>
    <div class="flex gap-2 flex-1">
        <div class="flex-1 bg-gray-300 h-60 rounded-md overflow-hidden flex items-center justify-center">
            <img src="{{ asset($focusedCharityRequest->side_face_link) }}" alt="" class="w-full h-full object-contain object-center"/>
        </div>
        <div class="flex-1 bg-gray-300 h-60 rounded-md overflow-hidden flex items-center justify-center">
            <img src="{{ asset($focusedCharityRequest->user->user_side_link) }}" alt="" class="w-full h-full object-contain object-center"/>
        </div>
    </div>
</div>