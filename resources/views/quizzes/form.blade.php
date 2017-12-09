@extends('administr::layout.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $title or '' }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {!! $form->open() !!}
                        {!! $form->renderField('_token') !!}
                        {!! $form->renderField('_method') !!}
                        {!! $form->renderField('quiz') !!}

                        <fieldset>
                            <legend>
                                Questions
                                <div class="pull-right">
                                    <!-- Single button -->
                                    <div class="btn-group">
                                        <button type="button" id="add-question" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Add Question <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @foreach($question_types as $type)
                                            <li class="add-question" data-type-slug="{{ $type->slug }}" data-type-id="{{ $type->id }}">
                                                <a href="#">{{ $type->name }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </legend>

                            <div id="quiz-questions">
                                @if(isset($quiz))
                                    @foreach($quiz->questions as $question)
                                        @include('questions._question', [
                                            'question' => $question,
                                        ])
                                    @endforeach
                                @endif
                            </div>
                        </fieldset>

                        {!! $form->renderField('save') !!}
                    {!! $form->close() !!}
                    {{--{!! $form->render() !!}--}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

@section('scripts')
<script type="text/javascript">
    var Question = {
        questions: 1,
        add: function() {
            $('#add-question').attr('disabled', 'disabled');

            $.get('/quizzes/questions/question', {
                index: Question.questions,
                slug: $(this).data('typeSlug'),
                type_id: $(this).data('typeId'),
                type: $(this).text(),
            }).done(function(result) {
                $('#quiz-questions').append(result);
                $('#quiz-questions .question:last-child .question-value').focus();
                Question.questions++;
            }).fail(function(result) {
                alert(result.responseJSON.error);
            }).always(function() {
                $('#add-question').removeAttr('disabled');
            });
        },
        remove: function() {
            if(!confirm('Do you really want to remove this question?')) {
                return false;
            }

            var questionId = $(this).data('questionId');
            var exists = parseInt($(this).data('exists'));

            if(exists) {
                $.ajax({
                    url: '/quizzes/questions/' + questionId,
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    method: 'DELETE',
                })
                .done(function() {
                    $('.question[data-question-id="' + questionId + '"]').remove();
                })
                .fail(function() {
                    alert('An error occured while deleting the question, please try again.');
                });

                return;
            }

            $('.question[data-question-id="' + questionId + '"]').remove();
        }
    };

    var Answer = {
        add: function() {
            $('.add-answer').attr('disabled', 'disabled');
            var index = $(this).data('questionId');

            $.get('/quizzes/questions/answer', {
                index: index,
            }).done(function(result) {
                $('#answers-' + index).append(result);
                $('#answers-' + index + ' .list-group-item input').focus();
                Question.questions++;
            }).fail(function(result) {
                alert(result.responseJSON.error);
            }).always(function() {
                $('.add-answer').removeAttr('disabled');
            });
        },
        remove: function() {
            if(!confirm('Do you really want to remove this answer?')) {
                return false;
            }

            var answer = $(this);
            var questionId = answer.data('questionId');
            var answerId = answer.data('answerId');
            var exists = parseInt(answer.data('exists'));

            if(exists) {
                $.ajax({
                    url: '/quizzes/questions/' + questionId + '/answers/' + answerId,
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    method: 'DELETE',
                })
                .done(function() {
                    answer.parents('.list-group-item').remove();
                })
                .fail(function() {
                    alert('An error occured while deleting the answer, please try again.');
                });

                return;
            }

            answer.parents('.list-group-item').remove();
        },
    };

    $('.add-question').on('click', Question.add);

    $('#quiz-questions').on('click', '.remove-question', Question.remove);

    $('#quiz-questions').on('click', '.add-answer', Answer.add);
    $('#quiz-questions').on('click', '.remove-answer', Answer.remove);
</script>
@stop