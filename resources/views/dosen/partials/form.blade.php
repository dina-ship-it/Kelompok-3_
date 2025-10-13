<div class="card p-4 shadow-sm">
    <div class="mb-3">
        <label>NIDN</label>
        <input type="text" name="nidn" class="form-control" value="{{ old('nidn', $dosen->nidn ?? '') }}">
        @error('nidn') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $dosen->nama ?? '') }}">
        @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $dosen->email ?? '') }}">
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Fakultas</label>
        <input type="text" name="fakultas" class="form-control" value="{{ old('fakultas', $dosen->fakultas ?? '') }}">
        @error('fakultas') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Prodi</label>
        <input type="text" name="prodi" class="form-control" value="{{ old('prodi', $dosen->prodi ?? '') }}">
        @error('prodi') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Jabatan</label>
        <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $dosen->jabatan ?? '') }}">
        @error('jabatan') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Tahun</label>
        <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $dosen->tahun ?? '') }}">
        @error('tahun') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-success">{{ $button }}</button>
    <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Kembali</a>
</div>
