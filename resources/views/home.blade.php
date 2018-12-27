@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <update-data-person></update-data-person>

                    <hr/>
                        <h3>DATOS EXISTENTES</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="data:image/png;base64,{{$user->avatar}}">
                        </div>
                        <div class="col-lg-6">
                            <img src="data:image/png;base64,{{$user->signature}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
