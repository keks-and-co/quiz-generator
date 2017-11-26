<div class="list-group-item">
    <div class="input-group">
        <input type="text" id="answer-{{ $index }}" name="question[{{ $index }}][answers][]" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-danger remove-answer" type="button">
                <span class="fa fa-trash"></span>
            </button>
        </span>
    </div>
</div>