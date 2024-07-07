@extends('layouts.user.app', ['title' => 'Kegiatan '])

@section('content')
    @push('styles')
    @endpush

	<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="text-primary"><u>Data Pegawai</u></h1>
        </div>

        <p>Cari Data Pegawai:</p>
        <form action="{{ route('user.cari') }}" method="GET">
            <input type="number" name="cari" placeholder="Cari Pegawai .." value="{{ old('cari') }}">
            <input type="submit" value="CARI">
        </form>
        <br/>
        
        <div class="table-responsive">
            <table class="table table-striped table-internal" id="table-internal-1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Status Keikutpesertaan</th>
                        <th>Instansi</th>
                        <th>Golongan</th>
                        <th>Jenis Kelamin</th>
                        <th colspan="2">Kelengkapan Peserta</th>
                        <th>Nomor Handphone</th>
                        <th>Nomor WhatsApp</th>
                        <th>Kabupaten</th>
                        <th>Tanda Tangan</th> <!-- Kolom untuk gambar tanda tangan -->
                    </tr>
                </thead>
                <tbody>
                    @if(isset($data) && $data->isNotEmpty())
                        @foreach ($data as $p => $peserta)
                            <tr data-type="penugasan-pegawai">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $peserta->no_ktp }}</td>
                                <td>{{ $peserta->status_keikutpesertaan }}</td>
                                <td>{{ $peserta->instansi }}</td>
                                <td>{{ $peserta->golongan }}</td>
                                <td>{{ $peserta->jkl }}</td>
                                <td>{{ $peserta->kelengkapan_peserta_transport }}</td>
                                <td>{{ $peserta->kelengkapan_peserta_biodata }}</td>
                                <td>{{ $peserta->no_hp }}</td>
                                <td>{{ $peserta->no_wa }}</td>
                                <td>{{ $peserta->kabupaten }}</td>
                                <td>
                                    @if($peserta->signature)
                                        <img src="{{ asset($peserta->signature) }}" alt="Signature" style="width: 100px; height: auto;">
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">{{ $message ?? 'No data found' }}</td>
                        </tr>
                        <tr>
                            <td colspan="11">
                                <a href="{{ route('user.kegiatan_regist') }}" class="badge badge-success">Silahkan Registrasi</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>
</div>



    @push('scripts')
    @endpush
@endsection