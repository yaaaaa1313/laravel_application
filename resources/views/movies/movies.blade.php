<div class="movies row mt-5 text-center">
  @foreach ($movies as $movie)
    @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
</div>
<div class="row text-center mt-3">
@endif
  <div class="col-lg-4 mb-5">
    <div class="movie text-left d-inline-block">
       @php
         $countFavoriteUsers = $movie->favoriteUsers()->count();
       @endphp
          <div class="text-right mb-2">いいね！
             <span class="badge badge-pill badge-success">{{ $countFavoriteUsers }}</span>
          </div>
      <div>
        @if ($movie)
        <iframe width="290" height="1633.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
          @endif
      </div>
      <p>
        @if (isset($movie->title))
            {{ $movie->title}}
        @endif    
      </p>
      @include('favorite.favorite_button',['movie' => $movie])
      @if (Auto::id() === $movie->user_id)
          <form method="post" action="{{ route('movie.delete', $movie->id) }}">
            @csrf 
            @method('DELETE')
            <button type="submit" class="btn btn-danger">この動画は削除する</button>
          </form>
      @endif
    </div>
  </div>
  @endforeach  
</div>
{{ $movies->links('pagination::bootstrap-4')}}