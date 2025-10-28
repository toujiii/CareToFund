<p class="text-sm text-gray-300 mb-4">
    You can create a new charity by filling out the necessary details in the form below. Make sure to provide accurate information to help others understand your cause.
</p>
<label class="mb-2 font-semibold text-sm">Charity Title</label>
<input type="text" name="title" class="w-full mb-4 px-3 py-2 rounded-md text-black text-sm bg-white" >
<label class="mb-2 font-semibold text-sm">Charity Description</label>
<textarea type="text" name="description" class="w-full mb-8 max-h-50 min-h-30 px-3 py-2 rounded-md text-black text-sm bg-white h-35" ></textarea>
<p class="text-sm text-gray-300 mb-4">
    Set a fundraising goal and duration for your charity campaign.
</p>
<div class="flex gap-4 h-fit mb-4">
    <div class="flex-1 flex flex-col gap-2">
        <label class=" font-semibold text-sm">Goal (PHP)</label>
        <input type="number" name="fund_limit" min="100" max="100000" step="100" class="w-full px-3 py-2 rounded-md text-black text-sm bg-white" >
    </div>
    <div class="flex-1 flex flex-col gap-2">
        <label class="font-semibold text-sm">Duration</label>
        <select name="duration" class="w-full px-3 py-2 rounded-md text-black text-sm bg-white" >
            <option hidden>Select Duration</option>
            <option value="7">1 Week</option>
            <option value="14">2 Weeks</option>
            <option value="30">1 Month</option>
        </select>
    </div>
</div>
<div class="w-full flex justify-end pt-4 border-t ">
    <button type="button" x-on:click="newCharityStep = 2" class="btn-tertiary-purple  self-end text-sm w-24">
        Next
    </button>
</div>