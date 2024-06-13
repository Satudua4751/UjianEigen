<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Trxpinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $book = Book::All();
        $member = Member::All();
        $trxpinjam = Trxpinjam::All();

        /* Soal 1 */
        $text1 = "NEGIE1";
        $pjchr = strlen($text1);
        $txtgab = "";
        $txtgab1 = "";

        for ($x = $pjchr - 1; $x >= 0; $x--) {
            $c1 = substr($text1, $x, 1);
            $cn1 = intval($c1);

            if ($cn1 == 0) {
                $txtgab .= $c1;
            } else {
                $txtgab1 .= $c1;
            }
        }
        $reversword = $txtgab . $txtgab1;

        /* Soal 2 */
        $text2 = strtoupper("Gg Translator dapat menterjemahkan berbagai macam bahasa");
        $pjchr = strlen($text2);
        $mulai = 0;
        $sampai = 0;
        $caritext1 = "";
        $caritext2 = "";
        for ($z = 0; $z < $pjchr; $z++) {
            $carispasi = substr($text2, $z, 1);
            if ($carispasi == " ") {
                $sampai = $z;
                $caritext1 = substr($text2, $mulai, $sampai - $mulai);
                $mulai = $sampai + 1;
                if (strlen($caritext1) > strlen($caritext2)) {
                    $caritext2 = $caritext1;
                }
            }
        }
        // periksa kata terakhir
        $caritext1 = substr($text2, $mulai, $pjchr - $mulai);
        if (strlen($caritext1) > strlen($caritext2)) {
            $caritext2 = $caritext1;
        }


        /* Soal 3 */
        $hasil = DB::table('inputs')
            ->select('jenis', DB::raw('count(*) as jml'))
            ->groupBy('jenis')
            ->get();


        /* Soal 4 */
        // Langkah 1: Definisi Arrays dan Variabel
        $satu = $dua = $nilai = array_fill(0, 3, 0);

        $nilai[0] = "120";
        $nilai[1] = "456";
        $nilai[2] = "789";

        $jumlah1 = $jumlah2 = 0;

        // Langkah 2: Loop pertama menghitung jumlah1
        for ($t1 = 0; $t1 < 3; $t1++) {
            $satu[$t1] = substr($nilai[$t1], $t1, 1);
            $jumlah1 += (int) $satu[$t1];
        }

        // Langkah 3: Loop kedua menghitung jumlah2
        $rev = 2; // rev mulai dari 2 karena PHP arrays adalah 0- basis
        for ($t2 = 0; $t2 < 3; $t2++) {
            $dua[$t2] = substr($nilai[$rev], $t2, 1);
            $jumlah2 += (int) $dua[$t2];
            $rev--;
        }
        // Langkah 4: hasil penghitungan
        $hasilarray = $jumlah1 - $jumlah2;
        //echo $hasilarray;

        return view('dashboard.index', compact('trxpinjam', 'book'), ['reversword' => $reversword, 'longestWord' => $caritext2, 'length' => strlen($caritext2), 'hasil' => $hasil, 'hasilarray' => $hasilarray]);
    }
}
