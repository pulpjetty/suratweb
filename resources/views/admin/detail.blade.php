@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <h5 class="card-header bg-primary text-white">Detail Arsip Surat</h5>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <tr>
                            <td width="150">Tanggal Surat</td>
                            <td> : {{$arsip->tgl_surat}}</td>

                        </tr>
                        <tr>
                            <td width="150">Title</td>
                            <td> : {{$arsip->title}}</td>
                        </tr>
                        <tr>
                            <td width="150">Nomor Surat</td>
                            <td> : {{$arsip->nomor_surat}} </td>
                        </tr>
                    </table>
                        <div class="p-0" style="height:800px;">
                                <embed src="{{Storage::url($arsip->file)}}" width="100%" height="100%"> </embed>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
