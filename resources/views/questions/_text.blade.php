<div class="form-group question" data-question-id="{{ $index }}">
    <fieldset>
        <legend>
            {{ $type }}

            <div class="pull-right">
                <button type="button" class="btn btn-danger remove-question" data-question-id="{{ $index }}" title="Remove Question">
                    <span class="fa fa-trash"></span>
                </button>
            </div>
        </legend>

        <input type="hidden" name="question[{{ $index }}][type]" value="{{ $slug }}">
        <input type="text" name="question[{{ $index }}][name]" id="question[{{ $index }}]" class="form-control">
    </fieldset>

</div>