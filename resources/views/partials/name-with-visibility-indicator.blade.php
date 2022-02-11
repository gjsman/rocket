<span @if(!$model->visible) class="line-through" @endif>
    {{ $model->name }}
    @if(class_basename($model) === 'Section')
        @if($model->date !== null)
            @if($model->show_date == true)
                ({{ $model->date->format('m/d/Y') }})
            @endif
        @endif
    @endif
</span>
