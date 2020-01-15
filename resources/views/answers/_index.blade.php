<div class="row mt-4 justify-content-center">
    <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                <h2>{{$answersCount. " ". str_plural('Answer',$answersCount)}}</h2>

                </div>
                <hr>
                @include('layouts._messages')
                @foreach ($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This Answer is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x   "></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a title="This Answer is not useful" class="vote-down off">
                                <i class="fas fa-caret-down  fa-3x  "></i>
                            </a>
                            <a title="Mark this answer as best answer" class="{{$answer->status}} mt-2">
                               <i class="fas fa-check fa-2x  "></i>
                                
                            </a>
                        </div>
                        <div class="media-body">
                            {!!$answer->body_html!!}
                            <div class="row">
                                <div class="col-4">
                                            <div class="ml-auto">
                                                {{-- @if(!Auth::guest()) 
                                                @if (Auth::user()->can('update-question',$question)) --}}
                                                @can ('update', $answer)
                                                <a href="{{route('questions.answers.edit',[$question->id,$answer->id])}}" class="btn btn-sm btn-outline-info">Edit</a>
                                                    @endcan
                                                {{-- @endif --}}
                                                {{-- @if (Auth::user()->can('delete-question',$question)) --}}
                                                @can('delete', $answer)
                                                <form class="form-delete" action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"onclick="return confirm('Are You Sure?')">Delete</button>
                                                </form>
                                                @endcan
                                                {{-- @endif --}}
                                                {{-- @endif --}}
                                                </div>
                                </div>

                                <div class="col-4"></div>
                                <div class="col-4">
                                    
                                        <span class="text-muted">Answered{{$answer->created_date}}</span>
                                        <div class="media mt-2">
                                        <a href="{{$answer->user->url}}" class="pr-2">
                                        <img src="{{$answer->user->avatar}}" alt="">
                                        </a>
                                        <div class="media-body mt-1">
                                        <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                        </div>
                                        </div>
                                       
                                    
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <hr>
                @endforeach
              </div>
            </div>
          </div>
         
        </div>
    </div>
</div>