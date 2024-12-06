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
                Tambah User
            </button>
            <div class="card">
                <h5 class="card-header bg-primary text-white">Data User </h5>
                <div class="card-body p-0 table-responsive">

                    <table class="table table-striped">
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Tool</th>
                        </tr>
                        @php $no = 1;
                        @endphp
                        @foreach ($users as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->level}}</td>

                            <td>
                                @if(Auth::user()->level == 'Pimpinan' || Auth::user()->level == 'Pegawai')
                                -
                                @else
                                <a href="{{url('user/edit/'.$item->id)}}" class="btn btn-sm btn-primary">Edit</a>

                                <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('{{$item->id}}')"
                                    title="Delete data"><i class="fa fa-trash"></i> Delete</a>
                                <form id="form-delete-{{$item->id}}" action="{{url('user/'.$item->id)}}" method="POST">
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
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('/user') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                        <div class="col-md-6">
                            <input id="username" type="text"
                                class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"
                                value="{{ old('username') }}" required autofocus>

                            @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>

                        <div class="col-md-6">
                            <select name="level" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <option value="Administrator">Administrator</option>
                                <option value="User">User</option>
                            </select>

                            @if ($errors->has('level'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('level') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
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
