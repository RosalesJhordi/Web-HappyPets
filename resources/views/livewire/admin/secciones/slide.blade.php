<div class="relative w-full" style="height: 70vh;">
    <!-- Slides Container -->
    <div class="relative overflow-hidden h-full">
        @foreach($slides as $index => $slide)
            <div class="{{ $index === $currentSlide ? 'block' : 'hidden' }} w-full h-full">
                <img src="{{ asset('img/' . $slide) }}" alt="Slide {{ $index + 1 }}" class="w-full h-full object-cover">
            </div>
        @endforeach
    </div>

    <div class="absolute inset-0 flex px-10 justify-between items-center">
        <button wire:click="previousSlide" class="bg-white  text-2xl w-10 h-10 flex justify-center items-center rounded-full shadow-lg">
            &#10094;
        </button>
        <button wire:click="previousSlide" class="bg-white  text-2xl w-10 h-10 flex justify-center items-center rounded-full shadow-lg">
            &#10095;
        </button>
    </div>

    <div class="absolute bottom-0 left-0 right-0 flex justify-center space-x-2 p-4">
        @foreach($slides as $index => $slide)
            <div class="h-2 w-2 rounded-full {{ $index === $currentSlide ? 'bg-blue-500' : 'bg-gray-400' }}"></div>
        @endforeach
    </div>
</div>