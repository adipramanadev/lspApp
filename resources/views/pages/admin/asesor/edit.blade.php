@extends('layouts.admin.app')

@section('title', 'Edit Data Asesor')

@push('style')
    <!-- Add any custom styles here -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Asesor</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Data</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('asesor.update', $asesor->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" value="{{ $asesor->nik }}"
                                            class="form-control" value="{{ $asesor->nama }}" maxlength="50" required>
                                        @error('nik')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" value="{{ $asesor->nama }}"
                                            class="form-control" maxlength="75" required>
                                        @error('nama')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" value="{{ $asesor->alamat }}" name="alamat"
                                            class="form-control" maxlength="50" required>
                                        @error('alamat')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="sex">Jenis Kelamin</label>
                                        <select name="sex" class="form-control" required>
                                            <option value="Laki-laki" {{ $asesor->sex === 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="Perempuan" {{ $asesor->sex === 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('sex')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" value="{{ $asesor->email }}"
                                            class="form-control" maxlength="50" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" name="status" value="{{ $asesor->status }}"
                                            class="form-control" maxlength="50">
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp">Nomor HP</label>
                                        <input type="text" name="no_hp" value="{{ $asesor->no_hp }}"
                                            class="form-control" maxlength="20">
                                        @error('no_hp')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="skema">Skema</label>
                                        <input type="text" name="skema" value="{{ $asesor->skema }}"
                                            class="form-control" maxlength="50">
                                        @error('skema')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
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
                title: 'Error',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
@endpush
