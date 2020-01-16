@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                        <a href="{{route('questions.create')}}" class="btn btn-outline-secondary">Ask Questions</a>
                        </div>
                    </div>
                    

                </div>

                <div class="card-body">
                    @include('layouts._messages')
                    @forelse ($questions as $question)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                <strong>{{$question->votes_count}}</strong>{{str_plural('vote',$question->votes_count)}}
                                </div>
                            <div class="status {{$question->status}}">
                                    <strong>{{$question->answers_count}}</strong>{{str_plural('answer',$question->answers_count)}}
                                </div>
                                <div class="view">
                                    {{$question->views." ".str_plural('view',$question->views)}}
                                </div>

                            </div>
                            <div class="media-body">
                            <div class="d-flex align-items-center">
                            <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h3>
                                 <div class="ml-auto">
                                {{-- @if(!Auth::guest()) 
                                @if (Auth::user()->can('update-question',$question)) --}}
                                @can ('update', $question)
                                 <a href="{{route('questions.edit',$question->id)}}" class="btn btn-sm btn-outline-info">Edit</a>
                                    @endcan
                                 {{-- @endif --}}
                                 {{-- @if (Auth::user()->can('delete-question',$question)) --}}
                                 @can('delete', $question)
                                 <form class="form-delete" action="{{route('questions.destroy',$question->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger"onclick="return confirm('Are You Sure?')">Delete</button>
                                </form>
                                @endcan
                                {{-- @endif --}}
                                {{-- @endif --}}
                                 </div>
                            </div>
                            <p class="lead">Asked By:
                            <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                            <small class="text-muted">{{$question->created_date}}</small>
                            </p>
                            <div class="excerpt">
                            {{$question->excerpt}}
                        </div>
                            </div>

                        </div>
                        <hr>
                        @empty
                            
                        <div class="alert alert-warning" role="alert">
                            <strong>Sorry there are no questions available</strong>
                        </div>
                    @endforelse
                    
                    {{$questions->links()}}
                     
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
