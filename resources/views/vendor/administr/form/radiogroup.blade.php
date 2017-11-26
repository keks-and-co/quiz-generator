<div class="form-group">
    <label for="{{ $field->getName() }}" class="control-label">{{ $field->getLabel() }}</label> <br>
    @foreach($field->radios() as $radio)
        {!! $radio->setView('administr/form::radio_inline')->render() !!}
    @endforeach
    @include('administr/form::_error')
</div>