@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                Tambah Kategori
            </button>
            <div class="card">
                <h5 class="card-header bg-primary text-white">Data Kategori </h5>
                <div class="card-body p-0 table-responsive">

                    <table class="table table-striped">
                        <tr>
                            <th>No.</th>
                            <th>Kategory</th>
                            <th>Tindakan</th>
                        </tr>
                        @php $no = 1;
                        @endphp
                        @foreach ($categories as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->name}}</td>

                            <td>

                                <a href="{{url('category/edit/'.$item->id)}}" class="btn btn-sm btn-primary">Edit</a>

                                <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('{{$item->id}}')"
                                    title="Delete data"><i class="fa fa-trash"></i> Delete</a>
                                <form id="form-delete-{{$item->id}}" action="{{url('category/'.$item->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('/category') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text"
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Simpan') }}
                    </button>
                </div>
            </form>
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
