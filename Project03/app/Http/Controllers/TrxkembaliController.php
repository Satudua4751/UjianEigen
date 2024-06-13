<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Trxkembali;
use App\Models\Trxkembalidetail;
use App\Models\Trxpinjam;
use App\Models\Trxpinjamdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TrxkembaliController extends Controller
{
    public function index()
    {
        $trxkembali = DB::table('Trxkembali')
            ->join('member', 'trxkembali.codem', '=', 'member.codem')
            ->select('trxkembali.*', 'member.name')
            ->orderBy('trxkembali.tgltrx', 'ASC')
            ->get();

        $member = Member::orderBy('codem', 'asc')->get();

        $book1 = DB::table('book')
            ->leftJoin(DB::raw('(SELECT codeb, SUM(jmlkembali) as total_jmlkembali FROM trxkembalidetail GROUP BY codeb) as trx_kmb'), 'book.codeb', '=', 'trx_kmb.codeb')
            ->leftJoin(DB::raw('(SELECT codeb, SUM(jmlpinjam) as total_jmlpinjam FROM trxpinjamdetail GROUP BY codeb) as trx_pjm'), 'book.codeb', '=', 'trx_pjm.codeb')
            ->select(
                'book.*',
                DB::raw('IFNULL(trx_kmb.total_jmlkembali, 0) as masuk'),
                DB::raw('IFNULL(trx_pjm.total_jmlpinjam, 0) as keluar')
            )
            ->orderBy('book.codeb', 'ASC')
            ->get();

        $member1 = DB::table('member')
            ->leftjoin('trxkembali', 'member.codem', '=', 'trxkembali.codem')
            ->leftjoin('trxkembalidetail', 'trxkembali.idtrx', '=', 'trxkembalidetail.idtrx')
            ->select(
                'member.codem',
                'member.name',
                'member.stts',
                DB::raw('COALESCE(SUM(trxkembalidetail.jmlkembali),0) as total_jmlkembali')
            )
            ->groupBy('member.codem', 'member.name', 'member.stts')
            ->get();


        return view('trxkembali.index', compact('trxkembali', 'book1', 'member1'));
    }

    public function create(Request $request)
    {
        $idtrx = $request->input('idtrx');

        $book = DB::table('trxpinjamdetail')
            ->join('book', 'trxpinjamdetail.codeb', '=', 'book.codeb')
            ->select('trxpinjamdetail.*', 'book.title', 'book.author')
            ->orderBy('trxpinjamdetail.idtrx', 'ASC')
            ->get();

        $member = DB::table('trxpinjam')
            ->join('member', 'trxpinjam.codem', '=', 'member.codem')
            ->select('trxpinjam.*', 'member.name')
            ->orderBy('trxpinjam.tgltrx', 'ASC')
            ->get();

        return view('trxkembali.create', compact('member', 'book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idtrx' => 'required|string|max:20',
            'tgltrx' => 'required|date',
            'codem' => 'required|string',
            'idtrx1' => 'required|string',
            'items' => 'required|json'
        ]);

        DB::transaction(function () use ($request) {
            $Trxkembali = Trxkembali::create([
                'idtrx' => $request->idtrx,
                'tgltrx' => $request->tgltrx,
                'codem' => $request->codem,
                'idtrx1' => $request->idtrx1
            ]);
            $this->saveTrxKmbDetails($Trxkembali, $request->input('items'));
            $Trxkembali->save();
        });


        return redirect()->route('trxkembali.index')->with('success', 'Transaction has been added');
    }

    public function edit($idtrx)
    {
        $Trxkembali = Trxkembali::findOrFail($idtrx);
        $Trxkembalidetails = $this->getTrxKmbDetails($idtrx);
        $Member = Member::orderBy('name', 'asc')->get();
        $Book = Book::all();

        return view('trxkembali.edit', compact('Trxkembali', 'trxkembalidetails', 'member', 'book'));
    }

    public function update(Request $request, $idtrx)
    {
        $request->validate([
            'idtrx' => 'required|string|max:20',
            'tgltrx' => 'required|date',
            'codem' => 'required|string',
            'idtrx1' => 'required|string',
            'items' => 'required|json'
        ]);
        try {
            DB::transaction(function () use ($request, $idtrx) {
                $Trxkembali = Trxkembali::findOrFail($idtrx);
                $Trxkembali->update($request->only(['tgltrx', 'codem', 'idtrx1']));

                Trxkembalidetail::where('idtrx', $idtrx)->delete();
                $this->saveTrxPjmDetails($Trxkembali, $request->input('items'));
                $Trxkembali->save();
            });

            return redirect()->route('trxkembali.index')->with('success', 'Transaction has been updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update transaction: ' . $e->getMessage());
        }
    }

    public function destroy($idtrx)
    {
        $Trxkembali = Trxkembali::findOrFail($idtrx);
        Trxkembalidetail::where('idtrx', $idtrx)->delete();
        $Trxkembali->delete();

        return redirect()->route('trxkembali.index')->with('success', 'Deleted successfully.');
    }

    public function show()
    {
    }

    public function getMember(Request $request)
    {
        $idtrx = $request->input('idtrx1');
        $tglkmb = Carbon::parse($request->input('tglkmb')); // Menggunakan Carbon untuk parsing tanggal

        $trxpinjam = DB::table('trxpinjam')
            ->join('member', 'trxpinjam.codem', '=', 'member.codem')
            ->select('trxpinjam.*', 'member.name', 'member.stts')
            ->where('idtrx', 'LIKE', '%' . $idtrx . '%')
            ->orderBy('trxpinjam.idtrx', 'ASC')
            ->first();

        if ($trxpinjam) {
            $tgltrx = Carbon::parse($trxpinjam->tgltrx); // Parsing tanggal pinjam
            $selisihHari = $tglkmb->diffInDays($tgltrx); // Menghitung selisih hari

            if ($selisihHari >= 7) {
                $infodll = 'Penalti 3 Hari Tidak boleh pinjam';
            } else {
                $infodll = 'tidak ada';
            }
            return response()->json([
                'codem' => $trxpinjam->codem,
                'name' => $trxpinjam->name,
                'stts' => $trxpinjam->stts,
                'tglpjm' => $trxpinjam->tgltrx,
                'infodll' => $infodll
            ]);
        }

        return response()->json(['error' => 'Member tidak ditemukan'], 404);
    }


    public function getBooksByMember(Request $request)
    {
        $idtrx1 = $request->input('idtrx1');
        if (!$idtrx1) {
            return response()->json(['error' => 'ID Transaksi tidak ditemukan']);
        }

        // Ambil buku berdasarkan idtrx1
        $books = DB::table('trxpinjamdetail')
            ->join('book', 'trxpinjamdetail.codeb', '=', 'book.codeb')
            ->select('trxpinjamdetail.*', 'book.title', 'book.author')
            ->where('idtrx', 'LIKE', '%' . $idtrx1 . '%')
            ->orderBy('trxpinjamdetail.idtrx', 'ASC')->get();
        return response()->json(['books' => $books]);
    }


    public function getNameBook(Request $request)
    {
        $codeb = $request->input('codeb');

        $book = DB::table('trxpinjamdetail')
            ->join('book', 'trxpinjamdetail.codeb', '=', 'book.codeb')
            ->select('trxpinjamdetail.*', 'book.title', 'book.author')
            ->where('trxpinjamdetail.codeb', 'LIKE', '%' . $codeb . '%')
            ->orderBy('trxpinjamdetail.idtrx', 'ASC')
            ->first();

        if ($book) {
            return response()->json([
                'codeb' => $book->codeb,
                'title' => $book->title,
                'author' => $book->author,
                'jmlpinjam' => $book->jmlpinjam,
            ]);
        }
        return response()->json(['error' => 'data tidak ditemukan'], 404);
    }

    public function getNotaKmb(Request $request)
    {
        $tgltrx1 = $request->input('tgltrx1');
        $huruf = "KM" . str_replace('-', '', $tgltrx1);

        $data = DB::table('Trxkembali')
            ->select(DB::raw('MAX(idtrx) as kode1'))
            ->where('idtrx', 'LIKE', '%' . $huruf . '%')
            ->first();

        $urutan = (int) substr($data->kode1, 11, 4) + 1;
        $idtrx = $huruf . sprintf("%04s", $urutan);

        return response()->json(['idtrx' => $idtrx]);
    }

    private function saveTrxKmbDetails($trxkembali, $items)
    {
        $items = json_decode($items, true);
        foreach ($items as $item) {
            $detail = new Trxkembalidetail();
            $detail->fill([
                'idtrx' => $trxkembali->idtrx,
                'codeb' => $item['codeb'],
                'jmlkembali' => $item['jmlkembali']
            ]);
            $detail->save();
        }
    }

    private function getTrxKmbDetails($idtrx)
    {
        return DB::table('trxkembalidetail')
            ->join('book', 'trxkembalidetail.codeb', '=', 'book.codeb')
            ->select('trxkembalidetail.*', 'book.title', 'book.author')
            ->where('trxkembalidetail.idtrx', $idtrx)
            ->orderBy('trxkembalidetail.idtrx', 'ASC')
            ->get();
    }

    public function checkStock(Request $request)
    {
        $codeb = $request->input('codeb');
        $qtyout = $request->input('qty');

        /* Logika untuk memeriksa stok */
        $stock1 = Book::where('codeb', $codeb)->sum('stock'); // Contoh perhitungan stok

        if (($stock1) >= $qtyout && ($stock1) > 0) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false]);
        }
    }
}
