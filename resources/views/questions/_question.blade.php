<div class="form-group question" data-question-id="{{ $index }}">
    <fieldset>
        <legend>
            {{ $type }}

            <div class="pull-right">
                <button type="button" class="btn btn-default add-answer" data-question-id="{{ $index }}" title="Add Answer">
                    <span class="fa fa-plus"></span>
                </button>
                <button type="button" class="btn btn-danger remove-question" data-question-id="{{ $index }}" title="Remove Question">
                    <span class="fa fa-trash"></span>
                </button>
            </div>
        </legend>

        <input type="hidden" name="question[{{ $index }}][type]" value="{{ $slug }}">
        <input type="hidden" name="question[{{ $index }}][type_id]" value="{{ $type_id }}">

        <label for="question[{{ $index }}]">Question:</label>
        <input type="text" name="question[{{ $index }}][value]" id="question[{{ $index }}]" class="form-control">

        @if($slug !== 'text')
        <label>Answers:</label>
        <div class="answers list-group" id="answers-{{ $index }}">
        </div>
        @endif
    </fieldset>

</div>