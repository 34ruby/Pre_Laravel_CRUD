<x-app-layout>
    <x-slot name="header" >
        <div class="flex justify-between">
       <h2 class="font-semibolt text-xl">
        {{__('글쓰기 폼')}}
       </h2>
       <button onclick=location.href="{{route('posts.show', ['post'=>$post->id])}}" type="button" class="btn btn-info hover:bg-blue-700 font-bold text-white">
           돌아가기
        </button>
    </div>
    </x-slot>
    <div class ="m-4 p-4">
        <form method="post" id ="editForm" enctype="multipart/form-data" action="{{ route('posts.update', ['post'=>$post->id]) }}">
            @method('patch')
            @csrf
    <div class="mb-3">
        <label for="title" class="form-label">제목</label>
        <input value="{{ $post->title }}"type="title" name="title" class="form-control" id="title">
        @error('title')
        <div class ="text-red-500">
            <span>{{$message}}</span>
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">내용 </label>
        <textarea class="form-control" name="content" id="content" rows="3">{{ $post->content }}</textarea>
        @error('content')
        <div class ="text-red-500">
            <span>{{$message}}</span>
        </div>
        @enderror
      </div>



      <div class="input-group mb-3">

        @if($post->image)
        <img class="w-20 h-20 rounded-full card-img-top" src="{{ '/storage/images/'.$post->image }}" alt="my post image" width="200" height="200">
        <button onclick="return deleteImage()" class="btn btn-danger mt-5">이미지 삭제하기</button>
        @else
            <span>NULL</span>
        @endif
        <label for="file">File</label>
        <input type="file" image="image" class="form-control" id="image" name="image"value="{{ old('file') }}">
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-primary" >업로드<button>
      </div>
    </form>
    <script>
        function deleteImage() {
            // alert('Hi');
            editForm = document.getElementById('editForm');
            editForm._method = 'delete';
            editForm.action = '/posts/images/' + '{{ $post->id }}' ;
            editForm.submit();
            return false;
        }
    </script>
    </div>

</x-app-layout>
