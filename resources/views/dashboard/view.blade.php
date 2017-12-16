@extends('administr::layout.master')

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-question"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Quizzes</span>
                    <span class="info-box-number">{{ $numbers['quizzes'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-file-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Answered Quizzes</span>
                    <span class="info-box-number">{{ $numbers['answered'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
@stop