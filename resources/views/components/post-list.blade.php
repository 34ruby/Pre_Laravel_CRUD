<div class="m-4 p-4">
    <!-- Be present above all else. - Naval Ravikant -->

    <table class="table  table-hover">
        <thead>
          <tr>
            <th scope="col">제목</th>
            <th scope="col">작성자</th>
            <th scope="col">작성일</th>
            <th scope="col">추천수</th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $post)
            <tr>
              <td><a href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a></td>
              <td>{{ $post->writer->name }}</td>
              <td>{{ $post->created_at->diffForHumans() }}</td>
              <td>{{ $post->likes->count() }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $posts->links() }}
</div>
