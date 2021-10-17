<x-app-layout>
    <x-slot name="header" >
        <div class="flex justify-between">
       <h2 class="font-semibolt text-xl">
        {{__('글쓰기 폼')}}
       </h2>
       <button onclick=location.href="{{route('posts.index')}}" type="button" class="btn btn-info hover:bg-blue-700 font-bold text-white">
           목록보기
        </button>
    </div>
    </x-slot>
    <div class ="m-4 p-4">
        <form method="post" enctype="multipart/form-data" action="{{ route('posts.store') }}">
            @csrf
    <div class="mb-3">
        <label for="title" class="form-label">제목</label>
        <input value="{{ old('title') }}"type="title" name="title" class="form-control" id="title" placeholder="제목을 입력하세요">
        @error('title')
        <div class ="text-red-500">
            <span>{{$message}}</span>
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">내용 </label>
        <textarea class="form-control" name="content" id="content" rows="3"placeholder="내용을 입력하세요">{{ old('content') }}</textarea>
        @error('content')
        <div class ="text-red-500">
            <span>{{$message}}</span>
        </div>
        @enderror
      </div>

      <div class="input-group mb-3">
        <label for="file">File</label>
        <input type="file" image="image" class="form-control" id="image" name="image"value="{{ old('file') }}">
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-primary" >업로드<button>
      </div>
    </form>
    </div>

</x-app-layout>
