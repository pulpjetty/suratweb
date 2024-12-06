@extends('layouts.app')

@section('content')
    @if(Auth::user()->level == 'Pimpinan' || Auth::user()->level == 'Pegawai')
      -
    @else
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-deck">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">
                            <h1>{{$usercount}}</h1>
                        </p>
                    </div>
                </div>
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Surat Masuk</h5>
                        <p class="card-text">
                            <h1>{{$suratmasukcount}}</h1>
                        </p>
                    </div>
                </div>

                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Surat Keluar</h5>
                        <p class="card-text">
                            <h1>{{$suratkeluarcount}}</h1>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    @endif
@endsection
