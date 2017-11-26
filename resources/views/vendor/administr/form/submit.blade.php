<button id="{{ $field->getName() }}" name="{{ $field->getName() }}" {!! $field->attributes() !!} @if(strlen($field->getOption('class')) == 0) class="btn btn-primary" @endif>
    {!! $field->getLabel() !!}
</button>