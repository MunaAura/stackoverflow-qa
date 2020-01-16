@if($answerCount>0)
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
                            @include('shared._vote',[
                            'model'=>$answer
                            ])
                                
                            
                        </div>
                        <div class="media-body">
                            {!!$answer->body_html!!}
                            <div class="row">
                                <div class="col-4">
                                            
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

                                <div class="col-4"></div>
                                <div class="col-4" class="ml-auto">
                                    
                                       @include('shared._author',['model'=>$answer,
                                       'label'=>'answered'])
                                       
                                    
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
@endif