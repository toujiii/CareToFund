 <div class="flex-1 flex flex-col gap-1">
     <p class=" text-lg font-bold ">
         ID Details
     </p>
     <div class="  flex flex-col gap-1">
         <p class="text-sm text-gray-300">
             ID Type: {{ $focusedCharityRequest->id_type_used }}
         </p>
         <p class="text-sm text-gray-300">
             ID Number: {{ $focusedCharityRequest->id_number }}
         </p>
         <div class=" bg-gray-300 h-48  rounded-md overflow-hidden">
            <img src="{{ asset($focusedCharityRequest->id_att_link) }}" alt="" class="w-full h-full object-contain object-center"/>
         </div>
     </div>
 </div>
 <div class="flex-1 flex-col flex gap-1">
     <p class=" text-lg font-bold ">
         User Submitted Photos
     </p>
     <div class="flex gap-2 flex-1">
         <div class="flex-1 bg-gray-300 h-60 rounded-md overflow-hidden flex items-center justify-center">
            <img src="{{ asset($focusedCharityRequest->front_face_link) }}" alt="" class="w-full h-full object-contain object-center"/>
         </div>
         <div class="flex-1 bg-gray-300 h-60 rounded-md overflow-hidden flex items-center justify-center">
            <img src="{{ asset($focusedCharityRequest->side_face_link) }}" alt="" class="w-full h-full object-contain object-center"/>
         </div>
     </div>
 </div>