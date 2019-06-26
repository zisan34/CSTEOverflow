<div class="col-lg-4 col-md-12">
  
  @auth
  @if(Auth::user()->office_stuff())
  <a href="{{ route('notice.create') }}" class="btn btn-block btn-info">Publish New Notice</a>
  @endif
  @if(Auth::user()->teacher())
  <a href="{{ route('onlineExam.create') }}" class="btn btn-block btn-info">Create New Test</a>
  @endif
  @endauth


  <!-- Search Widget -->
  <div class="card my-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-secondary btn-xs" type="button">Go!</button>
        </span>
      </div>
    </div>
  </div>

  <!-- Categories Widget -->
  <div class="card my-4">
    <h5 class="card-header">Popular Tags</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12">
          @foreach($popular_tags as $tag)
            @php
              $tag=App\Tag::find($tag->tag_id);
            @endphp
              <a href="{{ route('posts.filter.tag',['id'=>encrypt($tag->id)]) }}">{{$tag->title}}</a> &nbsp;&nbsp;&nbsp;

          @endforeach
        </div>
      </div>
    </div>
  </div>

  <!-- Side Widget -->
  <div class="card my-4">
    <h5 class="card-header">Latest Notices</h5>
    <div class="card-body">
      @php
        $notices=App\Notice::orderByDesc('created_at')->get()->take(5);
      @endphp
      @foreach($notices as $notice)
        <div class="text-center">
          <a href="{{ route('notice.view',['id'=>encrypt($notice->id)]) }}">{{$notice->title}}</a>
        </div>
      @endforeach
    </div>
  </div>

</div>