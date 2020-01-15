<div class="container">
<div class="row mt-4 justify-content-center">
    <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                   <div class="card-title">
                      <h3>Your Answer</h3>
                    </div>
                        <hr>
                <form action="{{ route('questions.answers.store', $question->id) }}" method="post">
                            @csrf
                                <div class="form-group">
                                <textarea name="body" id="" class="form-control {{$errors->has('body')? 'is_invalid':''}}" rows="7"></textarea>
                                @if ($errors->has('body'))
                                <div class="inavlid-feedback">
                                <strong>{{$errors->first('body')}}</strong>
                                </div>
                                    
                                @endif
                                
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                                </div>
                        </form>
                </div>
          </div>
    </div>
</div>
</div>