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
                    Tambah Kegiatan
                </button>
                <div class="card">
                    <h5 class="card-header bg-primary text-white">Data Kegiatan </h5>
                    <div class="card-body p-0 table-responsive">

                        <table class="table table-striped">
                            <tr>
                                <th>No.</th>
                                <th>Tgl/Waktu Kegiatan</th>
                                <th>Judul Kegiatan</th>
                                <th>Isi Kegiatan</th>
                                <th>Tindakan</th>
                            </tr>
                            @php $no = 1;
                            @endphp
                            @foreach ($activities as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->judulkegiatan}}</td>
                                    <td>{{$item->isikegiatan}}</td>

                                    <td>

                                        <a href="{{url('kegiatan/edit/'.$item->id)}}" class="btn btn-sm btn-primary">Edit</a>

                                        <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('{{$item->id}}')"
                                           title="Delete data"><i class="fa fa-trash"></i> Delete</a>
                                        <form id="form-delete-{{$item->id}}" action="{{url('kegiatan/'.$item->id)}}" method="POST">
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/add-activity') }}" method="post" >
                    @csrf
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="judulkegiatan" class="col-md-4 col-form-label text-md-right">{{ __('Judul Kegiatan') }}</label>

                            <div class="col-md-6">
                                <input id="judulkegiatan" type="text"
                                       class="form-control{{ $errors->has('judulkegiatan') ? ' is-invalid' : '' }}" name="judulkegiatan"
                                       value="{{ old('judulkegiatan') }}" required autofocus>

                                @if ($errors->has('judulkegiatan'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('judulkegiatan') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="isikegiatan" class="col-md-4 col-form-label text-md-right">{{ __('Isi Kegiatan') }}</label>

                            <div class="col-md-6">
                                <textarea id="isikegiatan" type="text"
                                       class="form-control{{ $errors->has('isikegiatan') ? ' is-invalid' : '' }}" name="isikegiatan"
                                          value="{{ old('isikegiatan') }}" rows="6" required autofocus> </textarea>

                                @if ($errors->has('isikegiatan'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('isikegiatan') }}</strong>
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
