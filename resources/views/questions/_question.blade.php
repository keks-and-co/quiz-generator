<div class="form-group question" data-question-id="{{ $question->id or $index }}">
    <fieldset>
        <legend>
            {{ $question->type->name or $type }}

            <div class="pull-right">
                @if(
                    (isset($slug) && $slug !== 'text')
                    || (isset($question) && $question->type->slug !== 'text')
                )
                <button type="button" class="btn btn-default add-answer" data-question-id="{{ $question->id or $index }}" title="Add Answer">
                    <span class="fa fa-plus"></span>
                </button>
                @endif
                <button type="button" class="btn btn-danger remove-question" data-question-id="{{ $question->id or $index }}" data-exists="{{ isset($question) ? 1 : 0 }}" title="Remove Question">
                    <span class="fa fa-trash"></span>
                </button>
            </div>
        </legend>

        <input type="hidden" name="question[{{ $question->id or $index }}][type]" value="{{ $question->type->slug or $slug }}">
        <input type="hidden" name="question[{{ $question->id or $index }}][slug]" value="{{ $question->type->slug or $slug }}">
        <input type="hidden" name="question[{{ $question->id or $index }}][type_id]" value="{{ $question->type_id or $type_id }}">

        <label for="question[{{ $question->id or $index }}]">Question:</label>
        <input type="text" name="question[{{ $question->id or $index }}][value]" id="question[{{ $question->id or $index }}]" class="form-control question-value" value="{{ $question->value or $value }}" required>

        @if(
            (isset($slug) && $slug !== 'text')
            || (isset($question) && $question->type->slug !== 'text')
        )
        <label>Answers:</label>
        <div class="answers list-group" id="answers-{{ $question->id or $index }}">
            @foreach(old('question.' . object_get($question, 'id', $index) . '.answer', []) as $answerId => $answer)
                @include('questions._answer', [
                    'index' => object_get($question, 'id', $index),
                    'value' => $answer,
                    'answerId' => $answerId,
                ])
            @endforeach

            @if(isset($question, $question->answers))
                @foreach($question->answers as $answer)
                    @include('questions._answer', [
                        'answer' => $answer,
                    ])
                @endforeach
            @endif
        </div>
        @endif
    </fieldset>

</div>