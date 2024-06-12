<h4>Soal Ke 1</h4>
<h4>NEGIE1</h4>
<p>REVERSE HURUF -> {{ $reversword }}</p>

<h4>Soal Ke 2</h4>
<h4>G Translator dapat menterjemahkan berbagai macam bahasa</h4>
<p>KATA PALING PANJANG -> {{ $longestWord }} ({{ $length }} karakter)</p>

<h4>Soal Ke 3</h4>
<table>
    <thead>
        <tr>
            <th>Jenis</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hasil as $hasils)
        <tr>
            <td>{{ $hasils->jenis }}</td>
            <td>{{ $hasils->jml }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<h4>Soal Ke 4</h4>
<h4>Pengurangan diagonal</h4>
<p>Hasil -> {{ $hasilarray }}</p>
