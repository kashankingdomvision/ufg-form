@extends('layouts.app')

@section('title','Update Stored Text')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Update Stored</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item active">Store Text</li>
              </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title text-center">Stored Text Update Form</h3>
              </div>

              <form method="POST" action="{{ route('store.texts.update', $storeText->slug) }}">
                @csrf @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label>Name <span style="color:red">*</span></label>
                        <input type="text" value="{{ $storeText->name }}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Stored Text Name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Title <span style="color:red">*</span></label>
                        <input type="text" value="{{ $storeText->page_title }}" name="page_title" class="form-control @error('page_title') is-invalid @enderror" placeholder="Stored Text Title" required>
                        @error('page_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Text <span style="color:red">*</span></label>
                        <textarea name="description" class="summernote form-control" > {!! $storeText->description !!} </textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                  <a href="{{ route('store.texts.index') }}" class="btn btn-outline-danger buttonSumbit float-right mr-3">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
@endsection
