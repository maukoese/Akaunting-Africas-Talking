@extends('layouts.admin')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('africas-talking.name') !!}
    </p>
@stop
