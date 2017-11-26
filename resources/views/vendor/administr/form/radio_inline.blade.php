<label class="radio radio-inline">
    <input type="radio" id="{{ $field->getName() }}" name="{{ $field->getName() }}" value="{{ $field->getValue() }}" {!! $field->attributes() !!}>
    <i class="input-helper"></i>
    {{ $field->getLabel() }}
</label>