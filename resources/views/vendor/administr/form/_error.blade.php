@if($errors->has($field->getName()))
    <span class="help-block">{{ $errors->first($field->getName()) }}</span>
@endif