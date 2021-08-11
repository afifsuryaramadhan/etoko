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
                    Halaman Produk
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">
                                    + Tambah Produk Baru</a>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Produk</th>
                                                <th>Pemilik</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}'
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'produk',
                    name: 'produk'
                },
                {
                    data: 'users.nama',
                    name: 'users.nama'
                },
                {
                    data: 'kategori.kategori',
                    name: 'kategori.kategori'
                },
                {
                    data: 'harga',
                    name: 'harga'
                },
                {
                    data: 'stok',
                    name: 'stok'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%'
                },
            ]
        })

    </script>
@endpush
