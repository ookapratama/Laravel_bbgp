@extends('layouts.app', ['title' => 'Edit Kuitansi'])

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Kuitansi</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Form Edit Kuitansi -->
                                <form action="{{ route('kuitansi.update', $kuitansi->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="no_bukti">Nomor Bukti</label>
                                        <input type="text" class="form-control" id="no_bukti" name="no_bukti" value="{{ old('no_bukti', $kuitansi->no_bukti) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tahun_anggaran">Tahun Anggaran</label>
                                        <input type="number" class="form-control" id="tahun_anggaran" name="tahun_anggaran" value="{{ old('tahun_anggaran', $kuitansi->tahun_anggaran) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="no_MAK">Nomor MAK</label>
                                        <input type="text" class="form-control" id="no_MAK" name="no_MAK" value="{{ old('no_MAK', $kuitansi->no_MAK) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="biaya_penginapan">Biaya Penginapan</label>
                                        <input type="number" class="form-control" id="biaya_penginapan" name="biaya_penginapan" value="{{ old('biaya_penginapan', $kuitansi->biaya_penginapan) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="biaya_uang_harian">Biaya Uang Harian</label>
                                        <input type="number" class="form-control" id="biaya_uang_harian" name="biaya_uang_harian" value="{{ old('biaya_uang_harian', $kuitansi->biaya_uang_harian) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="durasi_penginapan">Durasi Penginapan</label>
                                        <input type="number" class="form-control" id="durasi_penginapan" name="durasi_penginapan" value="{{ old('durasi_penginapan', $kuitansi->durasi_penginapan) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="durasi_uang_harian">Durasi Uang Harian</label>
                                        <input type="number" class="form-control" id="durasi_uang_harian" name="durasi_uang_harian" value="{{ old('durasi_uang_harian', $kuitansi->durasi_uang_harian) }}" required>
                                    </div>

                                    <hr>

                                    <h5>Data Transportasi</h5>
                                    <div id="transportasiContainer">
                                        @foreach ($transportasis as $index => $transportasi)
                                        <div class="transportasi-item">
                                            <h6>Transportasi {{ $index + 1 }}</h6>

                                            <div class="form-group">
                                                <label for="transportasi_{{ $index }}_nama_transportasi">Nama Transportasi</label>
                                                <input type="text" class="form-control" id="transportasi_{{ $index }}_nama_transportasi" name="transportasis[{{ $index }}][nama_transportasi]" value="{{ old("transportasis.$index.nama_transportasi", $transportasi->nama_transportasi) }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="transportasi_{{ $index }}_asal">Asal</label>
                                                <input type="text" class="form-control" id="transportasi_{{ $index }}_asal" name="transportasis[{{ $index }}][asal]" value="{{ old("transportasis.$index.asal", $transportasi->asal) }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="transportasi_{{ $index }}_tujuan">Tujuan</label>
                                                <input type="text" class="form-control" id="transportasi_{{ $index }}_tujuan" name="transportasis[{{ $index }}][tujuan]" value="{{ old("transportasis.$index.tujuan", $transportasi->tujuan) }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="transportasi_{{ $index }}_biaya">Biaya</label>
                                                <input type="number" class="form-control" id="transportasi_{{ $index }}_biaya" name="transportasis[{{ $index }}][biaya_transport]" value="{{ old("transportasis.$index.biaya_transport", $transportasi->biaya_transport) }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="transportasi_{{ $index }}_keterangan">Keterangan</label>
                                                <input type="text" class="form-control" id="transportasi_{{ $index }}_keterangan" name="transportasis[{{ $index }}][keterangan]" value="{{ old("transportasis.$index.keterangan", $transportasi->keterangan) }}">
                                            </div>

                                            <button type="button" class="btn btn-danger remove-transportasi">Hapus Transportasi</button>

                                            <hr>
                                        </div>
                                        @endforeach
                                </div>


                                    <button type="button" class="btn btn-success" id="addTransportasi">Tambah Transportasi</button>

                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="{{ route('kuitansi.index') }}" class="btn btn-secondary">Batal</a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let transportasiIndex = {{ count($transportasis) }};

                document.getElementById('addTransportasi').addEventListener('click', function () {
                    const transportasiContainer = document.getElementById('transportasiContainer');
                    const transportasiItem = document.createElement('div');
                    transportasiItem.classList.add('transportasi-item');

                    transportasiItem.innerHTML = `
                        <h6>Transportasi ${transportasiIndex + 1}</h6>

                        <div class="form-group">
                            <label for="transportasi_${transportasiIndex}_nama_transportasi">Nama Transportasi</label>
                            <input type="text" class="form-control" id="transportasi_${transportasiIndex}_nama_transportasi" name="transportasi[${transportasiIndex}][nama_transportasi]" required>
                        </div>

                        <div class="form-group">
                            <label for="transportasi_${transportasiIndex}_asal">Asal</label>
                            <input type="text" class="form-control" id="transportasi_${transportasiIndex}_asal" name="transportasi[${transportasiIndex}][asal]" required>
                        </div>

                        <div class="form-group">
                            <label for="transportasi_${transportasiIndex}_tujuan">Tujuan</label>
                            <input type="text" class="form-control" id="transportasi_${transportasiIndex}_tujuan" name="transportasi[${transportasiIndex}][tujuan]" required>
                        </div>

                        <div class="form-group">
                            <label for="transportasi_${transportasiIndex}_biaya">Biaya</label>
                            <input type="number" class="form-control" id="transportasi_${transportasiIndex}_biaya" name="transportasi[${transportasiIndex}][biaya]" required>
                        </div>

                        <div class="form-group">
                            <label for="transportasi_${transportasiIndex}_keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="transportasi_${transportasiIndex}_keterangan" name="transportasi[${transportasiIndex}][keterangan]">
                        </div>

                        <button type="button" class="btn btn-danger remove-transportasi">Hapus Transportasi</button>
                        <hr>
                    `;

                    transportasiContainer.appendChild(transportasiItem);
                    transportasiIndex++;
                });

                document.getElementById('transportasiContainer').addEventListener('click', function (e) {
                    if (e.target.classList.contains('remove-transportasi')) {
                        e.target.closest('.transportasi-item').remove();
                    }
                });
            });
        </script>
    @endpush
@endsection
