<div class="form-group @if($errors->has($field->getEscapedName())) has-error @endif">
    <label for="{{ $field->getEscapedName('_') }}" class="control-label">{{ $field->getLabel() }}</label>
    <select id="{{ $field->getEscapedName('_') }}" name="{{ $field->getName() }}" {!! $field->attributes() !!} class="form-control">
        @foreach($field->options() as $option)
            {!! $option->render() !!}
        @endforeach
    </select>
    @include('administr/form::_error')
</div>