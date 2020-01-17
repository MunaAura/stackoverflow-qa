
    <form id="favorite-question-{{ $model->id }}" action="{{$model->id }}/favorites" method="POST" style="display:none;">
            @csrf
            @if ($model->is_favorited)
                @method ('DELETE')
            @endif
    </form>