<div class="form-group @if($errors->has($field->getEscapedName())) has-error @endif">
    @if(strlen($field->getLabel()) > 0)<label for="{{ $field->getEscapedName('_') }}" class="control-label">{{ $field->getLabel() }}</label>@endif
    <input {!! $field->attributes() !!} id="{{ $field->getEscapedName('_') }}" name="{{ $field->getName() }}" value="{{ $field->getValue() }}" class="form-control">
    @include('administr/form::_error')
</div>