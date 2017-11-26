<fieldset id="{{ $field->getName() }}">
    <legend>{{ $field->getLabel() }}</legend>

    {!! $builder->render() !!}
</fieldset>