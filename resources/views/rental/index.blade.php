<!DOCTYPE html>
<html>
<head>
    <title>Data Armada</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="table-container" style="width: 750px;">
        <h2>Data Armada</h2>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @php $isAdmin = auth()->user()->role === 'admin'; @endphp

        <table>
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Merk</th>
                    <th>Tahun</th>
                    <th>Transmisi</th>
                    @if ($isAdmin)
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($rentals as $d)
                    <tr>
                        <td>{{ $d->plat_nomor }}</td>
                        <td>{{ $d->merk }}</td>
                        <td>{{ $d->tahun }}</td>
                        <td>{{ $d->transmisi }}</td>
                        @if ($isAdmin)
                            <td style="text-align: center;">
                                <a href="{{ route('rental.edit', $d) }}" class="btn-aksi btn-edit">Edit</a>

                                <form action="{{ route('rental.destroy', $d) }}" method="POST" style="display:inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-aksi btn-hapus">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $isAdmin ? 5 : 4 }}" style="text-align:center;">Belum ada data armada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($isAdmin)
            <a href="{{ route('rental.create') }}" class="btn btn-secondary">Tambah Armada Baru</a>
        @endif

        <p style="text-align:center; font-size:13px;">
            Login sebagai <b>{{ auth()->user()->name }}</b> ({{ auth()->user()->role }})
        </p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
    </div>
</body>
</html>