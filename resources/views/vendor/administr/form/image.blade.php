<div class="form-group @if($errors->has($field->getEscapedName())) has-error @endif">
    <label for="{{ $field->getEscapedName('_') }}" class="control-label">{{ $field->getLabel() }}</label>
    <img src="{{ $field->getSrc() }}" class="administr_image_type img-responsive">
    <input {!! $field->attributes() !!} id="{{ $field->getEscapedName('_') }}" name="{{ $field->getName() }}" value="{{ $field->getValue() }}" class="form-control">
    @include('administr/form::_error')
</div>