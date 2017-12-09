<div class="list-group-item">
    <div class="input-group">
        <input type="text" id="answer-{{ $answer->question_id or $index }}" name="question[{{ $answer->question_id or $index }}][answers][{{ $answer->id or '' }}]" class="form-control" value="{{ $answer->value or '' }}" required>
        <span class="input-group-btn">
            <button class="btn btn-danger remove-answer" data-question-id="{{ $answer->question_id or '' }}" data-answer-id="{{ $answer->id or '' }}" data-exists="{{ isset($answer) ? 1 : 0 }}" type="button">
                <span class="fa fa-trash"></span>
            </button>
        </span>
    </div>
</div>