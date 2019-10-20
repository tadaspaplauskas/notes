{!! $note->html !!}

@foreach ($note->uploads as $upload)
<div class="img-thumbnail my-3">
  <a href="{{ route('uploads.delete', $upload) }}" class="close mx-2" aria-label="Delete" title="Delete file">
    <span aria-hidden="true">&times;</span>
  </a>

  <a href="{{ $upload->url }}">
    @if ($upload->is_image)
      <img src="{{ $upload->url }}" title="{{ $upload->name }}"
        class="img-fluid">
    @else
      {{ $upload->name }}
    @endif
  </a>
</div>
@endforeach