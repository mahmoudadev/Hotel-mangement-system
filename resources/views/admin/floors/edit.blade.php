@extends('admin.admin_template')

@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Floor</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('floors.update', $floor->id) }}"> Back</a>
            </div>
        </div>

    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($floor, ['method' => 'PATCH','route' => ['floors.update', $floor->id]]) !!}
    @include('admin.floors.form')
    {!! Form::close() !!}
@endsection