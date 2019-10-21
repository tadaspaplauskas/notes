{!! $note->html !!}

@foreach ($note->uploads as $upload)
<div class="mr-3 d-inline-block align-center" style="max-width: 15rem; max-height: 15rem">

  @if (Route::current()->getName() == 'notes.edit')
    <a href="{{ route('uploads.delete', $upload) }}" class="close mx-2" aria-label="Delete" title="Delete file">
      <span aria-hidden="true">&times;</span>
    </a>
  @endif

  <a href="{{ $upload->url }}">
    @if ($upload->is_image)
      <img src="{{ $upload->url }}" title="{{ $upload->name }}"
        class="img-thumbnail">
    @else
      {{ $upload->name }}
    @endif
  </a>
</div>
@endforeach