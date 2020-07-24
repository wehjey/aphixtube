@extends('layout.master', ['title' => 'AphixTube'])

@section('content')

    <div class="container mt-5">

      <div class="row">
        <div class="col-8">
          <h3>Howdy, find your wonderful videos here!</h3>
        </div>
        <div class="col-4">
          <form class="form-inline">
            <div class="form-group mb-2">
              <label for="inputSearch" class="sr-only">Keyword</label>
              <input type="text" class="form-control" id="inputSearch" placeholder="Search videos...">
            </div>
            <button id="submitBtn" type="button" class="btn btn-secondary mb-2 ml-1">Go</button>
          </form>
        </div>
      </div>

      <hr>

      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item">
            <a id="prevPage" data-token="#" class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item">
            <a id="nextPage" data-token="#" class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>

      <div id="alert" class="row d-none">
        <div class="col">
          <div class="alert alert-warning" role="alert">
            Couldn't find any results. Please try again!
          </div>
        </div>
      </div>

      <div id="videoContainer" class="row"></div>

    </div>
@endsection

@section('script')
    <script src="{{url('js/app.js')}}"></script>
@endsection