<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-tr from-white to-green-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 bg-gradient-to-tr from-green-400 to-green-700 p-1 rounded-lg shadow-lg">
        <div class="px-6 py-4 bg-white rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>