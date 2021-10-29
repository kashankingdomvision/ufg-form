@extends('layouts.app')

@section('title','Add Preset Comment')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Add Preset Comment </h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Setting</a></li>
                <li class="breadcrumb-item active">Preset Comments</li>
              </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center">Preset Comment Form</h3>
              </div>

              <form method="POST" action="{{ route('setting.preset-comments.store') }}">
                @csrf

                <div class="card-body">
                  <div class="form-group">
                    <label>Preset Comment </label>
                    <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" rows="5" placeholder="Enter Comments"></textarea>
                    
                    @error('comment')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-secondary float-right">Submit</button>
                  <a href="{{ route('setting.preset-comments.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                </div>

              </form>
            </div>


          </div>

        </div>
      </div>
    </section>

  </div>
@endsection
