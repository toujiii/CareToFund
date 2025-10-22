<p class="text-sm text-gray-300 mb-4">
    You can create a new charity by filling out the necessary details in the form below. Make sure to provide accurate information to help others understand your cause.
</p>
<label class="mb-2 font-semibold text-sm">Charity Title</label>
<input type="text" class="w-full mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" required>
<label class="mb-2 font-semibold text-sm">Charity Description</label>
<textarea type="text" class="w-full mb-8 max-h-50 min-h-30 px-3 py-2 rounded-md text-black text-sm bg-white h-35" required></textarea>
<p class="text-sm text-gray-300 mb-4">
    Set a fundraising goal and duration for your charity campaign.
</p>
<div class="flex gap-4 h-fit">
    <div class="flex-1 flex flex-col gap-2">
        <label class=" font-semibold text-sm">Goal</label>
        <input type="text" class="w-full px-3 py-2 rounded-md text-black text-sm bg-white" required>
    </div>
    <div class="flex-1 flex flex-col gap-2">
        <label class="font-semibold text-sm">Duration</label>
        <select class="w-full px-3 py-2 rounded-md text-black text-sm bg-white" required>
            <option hidden>Select Duration</option>
            <option>1 Week</option>
            <option>2 Weeks</option>
            <option>1 Month</option>
        </select>
    </div>
</div>
<button x-on:click="newCharityStep = 2" class="btn-tertiary-purple mt-8 self-end text-sm w-24">
    Next
</button>