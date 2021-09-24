<div>
    <!-- Be present above all else. - Naval Ravikant -->
    <div class="card" style="width: 80% margin:10">
        @if($post->image)
        <img src="{{ '/storage/images/'.$post->image }}" class="card-img-top" alt="my post image" width="200" height="200">
        @else 
            <span>NULL</span>
        @endif
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ $post->content }}</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">작성자 : {{ $post->writer->name }}</li>
          <li class="list-group-item">등록일 : {{ $post->created_at->diffForHumans() }}</li>
          <li class="list-group-item">수정일 : {{ $post->updated_at->diffForHumans() }}</li>
        </ul>
        <div class="card-body flex">
          {{-- <input type="text" id = "myInput" > --}}
          <a href="{{ route('posts.edit', ['post'=>$post->id]) }}" class="card-link">수정</a>
          <form id="form" class="ml-4" method="post" onsubmit="e.preventDefault(); confirmDelete(event)" action="{{ route('posts.destroy', ['post'=>$post->id]) }}">
            @csrf
            @method('delete')
            {{-- <input name="_method" value="delete" type="hidden"> --}}
            <button onclick="return confirmDelete()" type="submit">삭제</button>
          </form>
          
        </div>
      </div>
      <script>
        function confirmDelete(e) {          
          myform = document.getElementById('form');
          // alert('삭제하시겠습니가..?')
          flag = confirm('진짜 지울거야?');
          if (flag) {
            myform.submit();
          } 
          // e.preventDefault(); // form이 서버로 전달되는 것을 막아준다.
          return false;
        }
      </script>
</div>