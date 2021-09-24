<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Show Post') }}
            </h2>
            <button onclick=location.href="{{ route('posts.index') }}" type="button" class="btn btn-info hover:bg-blue-700 font-bold text-white">
                Index Post
            </button>
        </div>
    </x-slot>
    <x-post-show :post="$post"></x-post-show>
    
</x-app-layout>
