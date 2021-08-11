@extends('layouts.admin')

@section('title')
    Halaman Produk
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">List Produk</h2>
                <p class="dashboard-subtitle">
                    Ubah Produk
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('product.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama produk</label>
                                                <input type="text" name="produk" class="form-control"
                                                    value="{{ $item->produk }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pemilik Produk</label>
                                                <select name="user_id" class="form-control">
                                                    <option value="{{ $item->user_id }}" selected>
                                                        {{ $item->users->nama }}
                                                    </option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select name="kategori_id" class="form-control">
                                                    <option value="{{ $item->kategori_id }}" selected>
                                                        {{ $item->kategori->kategori }}</option>
                                                    @foreach ($kategori as $kategori)
                                                        <option value="{{ $kategori->id }}">{{ $kategori->kategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="number" name="harga" class="form-control"
                                                    value="{{ $item->harga }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Stok</label>
                                                <input type="number" name="stok" class="form-control"
                                                    value="{{ $item->stok }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" id="editor" cols="30" rows="4"
                                                    class="form-control">{!! $item->deskripsi !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-right">
                                                <button type="submit" class="btn btn-success px-5">
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("editor");

    </script>
@endpush
