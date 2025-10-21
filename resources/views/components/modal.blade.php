<div x-data="{ open: false }" x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50" style="display: none;">
    <div class="bg-white rounded-lg shadow-lg w-1/2">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="text-lg font-semibold">{{ $title }}</h2>
            <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="p-4">
            {{ $slot }}
        </div>

        <!-- Modal Footer -->
        @if (isset($footer))
            <div class="p-4 border-t">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>