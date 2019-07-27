@extends('layouts.app')

@section('content')
  <div class="container" style="width: 100vw">

    <div class="row">

      <div class="col-md-2 border overflow-auto bg-white" style="height: 80vh">
        <h2 class="d-flex justify-content-between align-items-center">
            Tags
            <button class="btn btn-secondary btn-sm">+</button>
        </h2>

        <div class="list-group list-group-flush">
          <button type="button" class="list-group-item  d-flex justify-content-between align-items-center active">
            cons
            <span class="badge badge-primary badge-pill">14</span>
          </button>
        </div>
    </div>

      <div class="col-md-4 border overflow-auto bg-white" style="height: 80vh">

        <h2 class="d-flex justify-content-between align-items-center">
            Notes
            <button class="btn btn-secondary btn-sm">+</button>
        </h2>

        <div class="list-group list-group-flush">
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item</h5>
              <small>3 days ago</small>
            </div>
            <small>Donec id elit non mi porta.</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
            <small class="text-muted">Donec id elit non mi porta.</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
            <small class="text-muted">Donec id elit non mi porta.</small>
          </a>
        </div>

      </div>

      <div class="col-md-6 border overflow-auto bg-white" style="height: 80vh">

        <editor></editor>

      </div>

    </div>

  </div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection

