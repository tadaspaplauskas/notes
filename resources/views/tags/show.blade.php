@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Home</div>

        <div class="card-body">
          @if (session('message'))
            <div class="alert alert-success" role="alert">
              {{ session('message') }}
            </div>
          @endif

          <p>
              <a href="{{ route('notes.create') }}" class="btn btn-primary">+ Add a note</a>
          </p>

          <h2>{{ $tag->name }}</h2>

          <h3>Related tags</h3>

          @if ($tags->isEmpty())

            <p>No related tags.</p>

          @else
            @foreach ($tags as $tag)

              @include('components.tag', [
                'tag' => $tag,
                'max' => $tags->max('notes_count'),
              ])

            @endforeach
          @endif

          <h3>Notes</h3>

          @if (!$notes)

            <p>No notes so far. Create the first one!</p>

          @else

            @foreach ($notes as $note)

              <p>
                <strong>
                  {{ implode(', ', $note->tags->pluck('name')->toArray()) }}
                </strong>

                {{ $note->text }}
              </p>

            @endforeach

          @endif

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
