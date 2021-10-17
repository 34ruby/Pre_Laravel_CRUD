<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('글수정 폼') }}
            </h2>
            <button onclick=location.href="{{ route('posts.show', ['post'=>$post->id]) }}" type="button" class="btn btn-info font-bold hover:bg-blue-700 text-white">
                상세보기
            </button>
        </div>
    </x-slot>
    <div class="m-4 p-4">
        <form id="editForm" class="row g-3" action="{{ route('posts.update', ['post'=>$post->id])}}"method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="col-12 m-2">
                <label for="title" class="form-label">제목</label>
                <input type="text" name="title" class="form-control" id="title"
                            value="{{ $post->title }}">
                @error('title')
                <div class="text-red-800">
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">글 내용</label>
                <textarea class="form-control" name="content" id="content" rows="3" >{{ $post->content }}</textarea>
                @error('content')
                <div class="text-red-800">
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class="col-12 m-2">
                @if($post->image)
                <div class="flex items-center">
                    <img class="w-20 h-20 rounded-full" src="{{'/storage/images/'.$post->image}}"
                        class="card-img-top" alt="my post image">
                        <button onClick="return deleteImage({{ $post->id }})" class="btn btn-danger h-10 mx-2 my-2">이미지 삭제</button>
                    </div>

                @else
                    <span>첨부 이미지 없음</span>
                @endif
                <label for="image" class="form-label">첨부 이미지</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">글 저장</button>
            </div>
        </form>
        <script>
            function deleteImage() {
                editForm = document.getElementById('editForm');
                // editForm.delete('_method');
                editForm._method = 'delete';
                editForm.action = '/posts/images/'+id;
                editForm.submit();
                return false;
            }
        </script>
    </div>
</x-app-layout>
