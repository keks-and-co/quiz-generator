<div class="{{ $errors->has($field->getEscapedName()) ? 'has-error' : '' }}">
    <div class="checkbox">
        <label>
            <input type="checkbox" id="{{ $field->getEscapedName() }}" name="{{ $field->getName() }}" value="{{ $field->getValue() }}" {!! $field->attributes() !!}>
            {{ $field->getLabel() }}
        </label>
        @include('administr/form::_error')
    </div>
</div>