@extends('template')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection

@section('title')
    <h3>Data Pengguna</h3>
    <br>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Tabel Daftar Pengguna
            </h5>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                    <a class="btn btn-primary mb-2" href="/admin/tambah" role="button">Tambah Data</a>
                    <br>
                    <br>
                    <table id="example" class="table table-striped table-bordered datatables" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                {{-- <th>Password</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$admin->isEmpty())
                                @foreach ($admin as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if (Auth::check() && Auth::user()->email == $item->email || Auth::user()->email == 'admin@gmail.com')
                                            <a class="btn btn-warning" href="/admin/edit/{{$item->id}}" role="button">Edit</a> 
                                            <a class="btn btn-danger" href="/admin/delete/{{$item->id}}" role="button">Delete</a>
                                        @endif 
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                {{-- <th>Password</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
    <script>
        $('.btn-danger').on('click', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');

            Swal.fire({
                title: "Are you sure?",
                text: "Yakin Hapus Data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
@endsection