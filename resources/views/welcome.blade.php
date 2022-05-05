@extends('theme.base')

@section('content')

<div class="container py-5 text-center">
    <h1>Dancing with Death</h1>
    <a href="{{ route('schedule.index') }}" class="btn btn-primary">Schedule</a>
</div>

@endsection
