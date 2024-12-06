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
            <div class="card">
                <h5 class="card-header bg-primary text-white">Add Arsip Surat</h5>
                <div class="card-body">
                    <form action="{{url('/add-arsip')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Surat</label>
                                <div class="col-sm-3">
                                <input type="date" name="tgl_surat" class="form-control" id="tgl_surat" value="{{date('Y-m-d')}}" required>
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-6">
                                <input type="text" name="title" class="form-control" id="title" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nomor Surat</label>
                            <div class="col-sm-6">
                                <input type="text" name="nomor_surat" class="form-control" id="nomor_surat">
                            </div>
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Jenis Surat</legend>
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_surat" id="jenis"
                                            value="Masuk" required>
                                        <label class="form-check-label" for="jenis">
                                            Surat Masuk
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_surat" id="jenis"
                                            value="Keluar" required>
                                        <label class="form-check-label" for="jenis1">
                                            Surat keluar
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <div class="col-sm-2">Upload File</div>
                            <div class="col-sm-6">
                                <input type="file" name="file" class="form-control-file" id="file"
                                accept="application/pdf" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">Kategori</div>
                            <div class="col-sm-4">
                                <select name="category_id" class="form-control">
                                    <option value="">--Pilih--</option>
                                    @foreach (Helper::getCategory() as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
