@extends('layouts.app')

@section('pagetitle')
    Details
@endsection

@section('content')

    <h3>{{ $user->firstname }} {{ $user->lastname }}</h3>

    <h4>{{ $user->email }}</h4>

    <a class="btn btn-small btn-success pull-right" href="{{ URL::to('users/'.$user->id.'/edit') }}">Edit</a>

    <h2>Books were taken</h2>

    <table class="table table-responsive table-hover table-bordered">
        <thead>
        <tr>
            <td>Title</td>
            <td>Author</td>
            <td>Year</td>
            <td>Genre</td>
            <td>Took date</td>
            @can('ret', $user)
                <td>Action</td>
            @endcan
        </tr>
        </thead>
        <tbody>

        @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->year }}</td>
                <td>{{ $book->genre }}</td>
                <td>{{ $book->pivot->created_at }}</td>
                @can('ret', $user)
                <td>

                    {!! Form::open(['url' => 'bookregister/'.$book->pivot->id, 'class' => 'pull-right']) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Return book', ['class' => 'btn btn-warning']) !!}
                    {!! Form::close() !!}

                </td>
                @endcan
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="right">
        {{ $books->render() }}
    </div>
@endsection