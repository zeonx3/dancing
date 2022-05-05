@extends('theme.base')

@section('content')

<div class="container py-5 text-center">
    <h1>List Schedule</h1>
    <a href="{{ route('schedule.index') }}" class="btn btn-primary">Schedule</a>
    <a href="{{ route('schedule.create') }}" class="btn btn-primary">Register Date</a>
    @if (Session::has('mensaje'))
        <div class="alert alert-info my-5">
            {{ Session::get('mensaje') }}
        </div>
    @endif
    <table class="table table-light">
        <thead>
            <th>Dancer</th>
            <th>Date</th>
            <th>Hour</th>
            <th>Status</th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($schedules as $schedule)

            <tr>
                <td>{{ $schedule->Dancer }}</td>
                <td>{{ $schedule->Date }}</td>
                <td>{{ $schedule->Hour }}</td>
                <td>{{ $schedule->Status == 1 ? 'Active' : 'Inactive'}}</td>
                <td>
                    <a href="{{ route('schedule.edit', $schedule->id ) }}" class="btn btn-warning">Editar</a>

                    <form action="{{ route('schedule.destroy', $schedule) }}" method="post" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick = "return confirm('Are you sure you want to delete the Date?')">Eliminar</button>
                    </form>
                    </td>
            </tr>
            @empty

            @endforelse
        </tbody>
    </table>
    {{ $schedules->links() }}

</div>

@endsection
