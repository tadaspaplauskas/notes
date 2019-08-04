@extends('layouts.app')

@section('content')
  <notes class="container-fluid" inline-template v-cloak>

    <div class="row" style="height: 85vh">

      <div class="col-3 border{{--  overflow-auto --}} bg-white pt-2">

        <h2>
          Tags
          <button class="btn btn-light btn-sm">+ Add</button>
        </h2>

        <div class="list-group list-group-flush">
          <button type="button" class="list-group-item  d-flex justify-content-between align-items-center active">
            turizmas
            <span class="badge badge-primary badge-pill bg-white text-primary">14</span>
          </button>

          <button type="button" class="list-group-item  d-flex justify-content-between align-items-center">
            festivaliai
            <span class="badge badge-primary badge-pill">3</span>
          </button>

          <button type="button" class="list-group-item  d-flex justify-content-between align-items-center">
            motociklai
            <span class="badge badge-primary badge-pill">9</span>
          </button>
        </div>
      </div>

      <div class="col content-editor pt-2 border{{--  overflow-auto --}} bg-white">

        <button class="btn btn-light btn-sm"
          @click="addSnippet"
          v-if="!snippets.length"
        >+ Add</button>


        <div v-else class="row" v-for="snippet in snippets">
          <div class="col-1">
            <button class="btn btn-light btn-sm" @click="addSnippet">+ Add</button>
          </div>
          <div class="col">
            <editor
              :initial-content="snippet.content"
              style="max-width: 40rem"></editor>
          </div>

          <div class="col-1 small text-right">
            2019-08-02
          </div>

        </div>

      </div>
    </div>
  </notes>

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

