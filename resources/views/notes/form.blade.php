@csrf

<div class="form-group">

  <label for="tag">Tag</label>

  @error('tag')
    <div class="alert alert-warning">{{ $message }}</div>
  @enderror

  <input type="text"
    name="tag"
    id="tag"
    autocomplete="off"
    list="available_tags"
    class="form-control"
    placeholder="Add tags"
    value="{{ old('tags', optional($note->tag)->name) }}"
  >

  <datalist id="available_tags">

    @foreach ($tags as $tag)

      <option>{{ $tag->name }}</option>

    @endforeach

  </datalist>

</div>

<div class="form-group">

  <label for="content">Content</label>

  @error('content')
    <div class="alert alert-warning">{{ $message }}</div>
  @enderror

  <textarea class="form-control" name="content" id="content"
  style="height: 50vh"
  >{{ old('content', $note->content) }}</textarea>

</div>

<button class="btn btn-primary">Save</button>

