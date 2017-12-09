<label class="radio radio-inline">
    <input type="radio" id="{{ $field->getEscapedName('_') }}" name="{{ $field->getName() }}" value="{{ $field->getValue() }}" {!! $field->attributes() !!}>
    <i class="input-helper"></i>
    {{ $field->getLabel() }}
</label>