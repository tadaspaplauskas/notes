@extends('layouts.app')

@section('content')

<div class="row">

  <div class="col">

    <h2>Helpers</h2>

    <h3>bookmark</h3>
    <p>
      KB can also serve as a bookmarking service.
      Drag the following link to your bookmark tab and then click it in any
      page you wish to save for future reference.
    </p>

    <a href="javascript:(function(){var d = document.createElement('script');d.setAttribute('src', '{{ asset('js/bookmark.js') }}?' + Date.now());document.body.appendChild(d);}());">
      Send to KB
    </a>

  </div>

</div>

@endsection

