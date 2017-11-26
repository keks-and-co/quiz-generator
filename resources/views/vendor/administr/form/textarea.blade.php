<div class="form-group @if($errors->has($field->getEscapedName())) has-error @endif">
    <label for="{{ $field->getName() }}" class="control-label">{{ $field->getLabel() }}</label>
    <textarea id="{{ $field->getName() }}" name="{{ $field->getName() }}" {!! $field->attributes() !!} class="form-control">{!! $field->getValue() !!}</textarea>
    @include('administr/form::_error')
</div>