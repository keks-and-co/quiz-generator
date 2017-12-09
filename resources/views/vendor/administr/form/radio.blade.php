<div class=" @if($errors->has($field->getEscapedName())) has-error @endif ">
    <div class="radio">
        <label>
            <input type="radio" id="{{ $field->getEscapedName('_') }}" name="{{ $field->getName() }}" value="{{ $field->getValue() }}" {!! $field->attributes() !!}>
            <i class="input-helper"></i>
            {{ $field->getLabel() }}
        </label>
        @include('administr/form::_error')
    </div>
</div>