@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header bg-primary text-white">Data Arsip Surat</h5>
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
                    <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">
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
                        @foreach ($arsips as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{date('d-m-Y', strtotime($item->tgl_surat))}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->nomor_surat}}</td>
                            <td>{{$item->category->name}}</td>

                            <td>

                                <a href="{{url('arsip/detail/'.$item->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                                <a href="{{url('arsip/edit/'.$item->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('{{$item->id}}')"
                                                title="Delete data"><i class="fa fa-trash"></i></a>

                                <form id="form-delete-{{$item->id}}" action="{{url('arsip/'.$item->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                                    @endif
                            </td>
                        </tr>
                        @endforeach

                    </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    {{ $arsips->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="center"><embed src="LOKASI_FILE.pdf" width="100%" height="700"> </embed></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    function confirmDelete(id) {
    if (confirm("Apakah anda yakin ingin menghapus data penting ini ?")) {
      $('#form-delete-'+id).submit();
    }
  }
</script>
@endpush
@endsection
