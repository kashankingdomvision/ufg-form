@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center py-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                    <div class="row">
                        <div class="col-md-12 ">
                            @include('includes.flash_message')
                        </div>
                    </div>

                    You are logged in!

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
