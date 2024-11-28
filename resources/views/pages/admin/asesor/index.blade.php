@extends('layouts.admin.app')

@section('title', 'Data Asesor')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Manajemen Asesor</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between mb-3">

                                    <a href="{{ route('asesor.create') }}" class="btn btn-primary">Tambah Data</a>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-striped" id="table-1">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Asesor</th>
                                                <th>Alamat</th>
                                                <th>Telepon</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($asesores as $asesor)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $asesor->nama }}</td>
                                                    <td>{{ $asesor->alamat }}</td>
                                                    <td>{{ $asesor->no_hp }}</td>
                                                    <td>
                                                        <a href="{{ route('asesor.edit', $asesor->id) }}"
                                                            class="btn btn-sm btn-primary">Edit</a>
                                                        <form action="{{ route('asesor.destroy', $asesor->id) }}"
                                                            method="POST" class="delete-form" style="display:inline;">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger btn-delete">Hapus</button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Tidak Ada Data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    {{-- <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script> --}}
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset() }}"></script> --}}
    {{-- <script src="{{ asset() }}"></script> --}}
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Tutup'
            });
        @endif
    </script>
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the form from submitting
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if confirmed
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
@endpush
