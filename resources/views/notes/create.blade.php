@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Add a note</div>
        <div class="card-body">

          <form action="{{ route('notes.store') }}" method="POST">
            @include('notes.form')
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back to list</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
