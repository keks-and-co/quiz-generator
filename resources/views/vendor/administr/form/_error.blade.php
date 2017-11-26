@if($errors->has($field->getEscapedName()))
    <span class="help-block">{{ $errors->first($field->getEscapedName()) }}</span>
@endif