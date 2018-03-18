<div class="list-group-item">
    <div class="input-group">
        <input type="text" id="answer-{{ $answer->question_id or $index }}" name="question[{{ $answer->question_id or $index }}][answers][{{ $answer->id or $answerId }}]" class="form-control" value="{{ $answer->value or $value }}" required>
        <span class="input-group-btn">
            <button class="btn btn-danger remove-answer" data-question-id="{{ $answer->question_id or $index }}" data-answer-id="{{ $answer->id or $answerId }}" data-exists="{{ isset($answer) ? 1 : 0 }}" type="button">
                <span class="fa fa-trash"></span>
            </button>
        </span>
    </div>
</div>