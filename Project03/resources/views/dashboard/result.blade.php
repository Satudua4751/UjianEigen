<h4>Soal Ke 1</h4>
<h4>Urutkan huruf dengan angka tetap di akhir - NEGIE1 - </h4>
<img src="{{ asset('assets') }}/img/SOAL1.PNG">

   <p> REVERSE HURUF -> <span class="font-weight-bolder" style="color: red;">{{ $reversword }}</span></p>


<h4>Soal Ke 2</h4>
<h4>G Translator dapat menterjemahkan berbagai macam bahasa</h4>
<img src="{{ asset('assets') }}/img/SOAL2.PNG">
<p>KATA PALING PANJANG -> <span class="font-weight-bolder" style="color: red;">{{ $longestWord }} ({{ $length }} karakter)</span></p>

<h4>Soal Ke 3</h4>
<img src="{{ asset('assets') }}/img/SOAL3.PNG">
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
<img src="{{ asset('assets') }}/img/SOAL4.PNG">
<h4>Pengurangan diagonal</h4>
<p>HASIL PENGURANGAN DIAGONAL -> <span class="font-weight-bolder" style="color: red;">{{ $hasilarray }}</span></p>

