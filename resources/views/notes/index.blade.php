@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Notes</div>

        <div class="card-body">
          @if (session('message'))
            <div class="alert alert-success" role="alert">
              {{ session('message') }}
            </div>
          @endif

          <a href="{{ route('notes.create') }}" class="btn btn-primary">+ Add a note</a>

          @if (!$notes)

            <p>No notes so far. Create the first one!</p>

          @else

            @foreach ($notes as $note)

              <p>{{ $note->text }}</p>

            @endforeach

          @endif

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
