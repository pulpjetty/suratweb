@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <h5 class="card-header bg-primary text-white">Surat Keluar</h5>
                <div class="card-body p-0">
                    <div class="row mb-3 p-3 mb-0">
                        <div class="col-md-6">
                            <form method="GET" aclass="form-inline">
                                <div class="input-group">
                                    <input type="text" name="search" value="{{request()->search}}" class="form-control"
                                        placeholder="Search title/no. surat/TGL Surat(yyyy-m-d)"
                                        aria-label="Search name or ID Card" aria-describedby="basic-addon2"
                                        autocomplete="off" autofocus="on">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-danger"> Search </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <tr>
                            <th>No.</th>
                            <th>TGL. Surat</th>
                            <th>Title</th>
                            <th>Nomor Surat</th>
                            <th>Kategori</th>
                            <th>Tool</th>
                        </tr>
                        @php $no = 1;
                        @endphp
                        @foreach ($suratkeluar as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{date('d-m-Y', strtotime($item->tgl_surat))}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->nomor_surat}}</td>
                            <td>{{$item->category->name}}</td>
                            
                            <td>
                                <a href="{{url('arsip/detail/'.$item->id)}}" class="btn btn-sm btn-warning">Lihat</a>
                                <a href="{{url('arsip/edit/'.$item->id)}}" class="btn btn-sm btn-primary">Edit</a>

                                <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('{{$item->id}}')"
                                    title="Delete data"><i class="fa fa-trash"></i> Delete</a>
                                <form id="form-delete-{{$item->id}}" action="{{url('arsip/'.$item->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                               
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
                <div class="card-footer text-muted">
                    {{ $suratkeluar->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
