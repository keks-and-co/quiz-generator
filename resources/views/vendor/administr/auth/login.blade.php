@extends('administr::layout.auth')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Quiz</b>Generator</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">

            @include('flash::message')

            {!! $form->render() !!}

            <br>

            <a href="{{ route('admin.registration') }}" class="text-center">Register a new membership</a>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="/vendor/administr/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/vendor/administr/bootstrap/js/bootstrap.min.js"></script>
    <script src="/vendor/administr/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@stop