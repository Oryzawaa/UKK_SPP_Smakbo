@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="mb-3">Welcome</h3>
                    <div class=”panel-heading”>Selamat datang {{ Auth::user()->name_petugas }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection