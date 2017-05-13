@extends('layouts.app')
@section('title')
    {{ trans('label.dashboard') }}
@stop
@section('content')
<div class="container">
    <div class="row">
        <!-- Thống Kê Tài Liệu -->
        <div class="col-md-4">
            <table id="table" class="table" style="margin-top: 20px;">
                <thead class="thead-inverse">
                    <td colspan="2" style="background-color: #CA4D4D; color: white; text-align: center;">Thống Kê Tài Liệu Theo Phòng Ban</td>
                </thead>
                <thead class="thead-inverse">
                    <tr>
                        <th>Tổng Số Tài Liệu</th>
                        @if(Auth::user()->hasRole('admin'))
                        <td><a href="{{ route('documents.index') }}">{{ $allDoc->count() }}</a></td>
                        @else
                        <td>{{ $allDoc->count() }}</td>
                        @endif
                    </tr>
                </thead>
                @foreach($allDepartment as $item)
                <thead class="thead-inverse">
                    <tr>
                        <th>{{ $item->alias }}</th>
                        @if(Auth::user()->hasRole('admin'))
                        <td><a href="{{ route('departments.documents', $item->id) }}">{{ $item->countDoc }}</a></td>
                         @else
                        <td>{{ $item->countDoc }}</td>
                        @endif
                    </tr>
                </thead>
                @endforeach()
            </table>
        </div>

        <!-- Biểu Đồ Thể Hiện-->
        <div class="col-md-6 col-md-offset-1" style="margin-top: 20px;">
            <div class="panel panel-info">
                <div class="panel-heading" style="background-color: #CA4D4D; color: white; text-align: center; font-size: 18px;">
                    BIỂU ĐỒ
                </div>
                <div class="panel-body">
                    <div id="chart-div"></div>
                    <!-- With Lava class alias -->
                    <?= $lava->render('PieChart', 'IMDB', 'chart-div') ?>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
