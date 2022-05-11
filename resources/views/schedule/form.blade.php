@extends('theme.base')

@section('content')

<div class="container py-5 text-center">

    @if(isset($schedule))

    <h1>Edit Date</h1>
    @else
    <h1>Register Date</h1>
    @endif


    @if(isset($schedule))

    <form method="post" action="{{route('schedule.update', $schedule)}}">
        @method('PUT')
    @else

    <form method="post" action="{{route('schedule.store')}}">

    @endif


        @csrf

        <div class="mn-3 form-control">
            <label for="dancer" class="form-label">Name Dancer</label>
            <input type="text" name="Dancer" id="Dancer" class="form-control" value ="{{ old('Dancer') ?? @$schedule->Dancer }}">
            @error('Dancer')
            <p class=" form-text text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mn-3 form-control">
            <label for="mail" class="form-label">Mail Dancer</label>
            <input type="mail" name="Mail" id="Mail" class="form-control" value ="{{ old('Mail') ?? @$schedule->Mail }}">
            @error('Mail')
            <p class=" form-text text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mn-3 form-control">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="Date" id="Date" class="form-control" value="{{ old('Date') ?? @$schedule->Date}}">
            @error('Date')
            <p class=" form-text text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mn-3 form-control">
            <label for="id_hour" class="form-label">Hour</label>
            <select class="form-control" id="id_hours" name="id_hours">
                    <option value="{{ old('id_hours') ? @$schedule->id_hours : '' }}">{{ old('id_hours') ? @$schedule->hor_name : '-= Select Hour=-' }}</option>
                @foreach ($hours as $hour)
                    <option  value="{{ $hour['id'] }}">{{ $hour['hor_name'] }}</option>
                @endforeach
            </select>
            @error('id_hour')
            <p class=" form-text text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('schedule.index') }}" class="btn btn-info">Back</a>


    </form>
</div>

@endsection
