@extends('template')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tambah Data Kecamatan</h4>
        </div>

        <div class="card-body">
            <form action="{{url('/kecamatan/tambah')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basicInput">Kode</label>
                            <input type="text" class="form-control" id="basicInput" name="kode"
                            value="{{ old('kode') }}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Nama Kecamatan</label>
                            <input type="text" class="form-control" id="basicInput" name="nama"
                            value="{{ old('nama') }}">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <button class="btn btn-success" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            @if (session('errors'))
                var errors = @json(session('errors')->all());
                var errorMessage = errors;
                var indonesianMessages = {
                    'The kode has already been taken.' : 'Kode Sudah Terdaftar',
                    'The kode field is required.': 'Kolom Kode Harus Di Isi',
                    'The nama field is required.': 'Kolom Nama Kecamatan Harus Di Isi',
                    'The nama field format is invalid.' : 'Nama Kecamatan Harus Huruf'
                };
                for (var key in indonesianMessages) {
                    if (indonesianMessages.hasOwnProperty(key) && errorMessage.includes(key)) {
                        errorMessage = indonesianMessages[key];
                        break;
                    }
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            @endif
        });
    </script>
@endsection