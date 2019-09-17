@extends('layouts.app')

@section('content')

<div class="row">

  <div class="col-3 pt-2">

    <h2>Search</h2>
    <form class="form-inline mb-3" action="">
      <div class="form-group mr-1">
        <label for="search" class="sr-only">Search</label>
        <input type="text"
          class="form-control form-control-sm"
          name="search"
          id="search"
          placeholder="Search"
          value="{{ $search }}">
      </div>

      <button type="submit" class="btn btn-primary btn-sm">Search</button>
    </form>

    <h2>Tags</h2>

    <div class="list-group list-group-flush">
      @foreach ($tags as $tag)
        <a href="{{ $selectedTag->getKey() === $tag->getKey() ?
            route('notes.index')
            :
            route('tags.notes.index', $tag)
          }}"
          class="list-group-item d-flex justify-content-between align-items-center
            {{ $selectedTag->getKey() === $tag->getKey() ? 'active' : '' }}">
          {{ $tag->name }}

          <span
            class="badge badge-primary badge-pill
              {{ $selectedTag->getKey() === $tag->getKey() ? 'bg-white text-primary' : '' }}">
            {{ $tag->notes_count }}
          </span>
        </a>
      @endforeach
    </div>
  </div>

  <div class="col pt-2">
    <h2>
      Notes {{ $selectedTag->exists ? ' about ' . $selectedTag->name : '' }}

      <a class="btn btn-light btn-sm float-right"
        href="{{ $selectedTag->exists ? route('tags.notes.create', $selectedTag) : route('notes.create') }}">+ Add
      </a>

      @if ($selectedTag->exists)
        <a class="btn btn-light btn-sm float-right mr-1" href="{{ route('tags.edit', $selectedTag) }}">
          Manage tag
        </a>
        @endif
    </h2>

    @foreach ($notes as $note)
      <div class="row border-top pt-3"
        title="{{ 'Updated ' .  $note->updated_at->diffForHumans() }}">
        <div class="col">
          {!! $note->html !!}
        </div>
        <div class="col-2 small text-right pb-3">
          @if ($note->tag)
            <div>
              <span class="badge badge-info badge-pill text-white">
              {{ $note->tag->name }}
              </span>
            </div>
          @endif
          <a href="{{ route('notes.edit', $note) }}">
            Edit
          </a>
          <a href="{{ route('notes.delete', $note) }}">
            Delete
          </a>
        </div>
      </div>
    @endforeach

  </div>

</div>

@endsection

