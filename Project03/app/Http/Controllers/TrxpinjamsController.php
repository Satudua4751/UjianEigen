<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Trxpinjam;
use App\Models\Trxpinjamdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * @OA\Info(title="Pinjam Buku API", version="1.0")
 */
class TrxpinjamsController extends Controller
{
    public function index()
    {
        /**
         * @OA\Get(
         *     path="/api/trxpinjam",
         *     summary="Get list of pinjaman",
         *     @OA\Response(
         *         response=200,
         *         description="Successful operation",
         *         @OA\JsonContent(
         *             type="array",
         *             @OA\Items(ref="#/components/schemas/Trxpinjam")
         *         )
         *     )
         * )
         */
        $trxpinjam = DB::table('Trxpinjam')
            ->join('member', 'trxpinjam.codem', '=', 'member.codem')
            ->select('trxpinjam.*', 'member.name')
            ->orderBy('trxpinjam.tgltrx', 'ASC')
            ->get();

        return response()->json($trxpinjam, 201);
    }

    public function create(Request $request)
    {
        $idtrx = $request->input('idtrx');
        $book = Book::all();
        $member = Member::orderBy('codem', 'asc')->get();

        return view('trxpinjam.create', compact('member', 'book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgltrx' => 'required|date',
            'idtrx' => 'required|string|max:20',
            'codem' => 'required|string',
            'items' => 'required|json'
        ]);

        DB::transaction(function () use ($request) {
            $Trxpinjam = Trxpinjam::create([
                'idtrx' => $request->idtrx,
                'tgltrx' => $request->tgltrx,
                'codem' => $request->codem,
            ]);

            $this->saveTrxPjmDetails($Trxpinjam, $request->input('items'));
            $Trxpinjam->save();
        });

        return redirect()->route('trxpinjam.index')->with('success', 'Transaction has been added');
    }

    public function edit($idtrx)
    {
        $Trxpinjam = Trxpinjam::findOrFail($idtrx);
        $Trxpinjamdetails = $this->getTrxPjmDetails($idtrx);
        $Member = Member::orderBy('name', 'asc')->get();
        $Book = Book::all();

        return view('trxpinjam.edit', compact('Trxpinjam', 'trxpinjamdetails', 'member', 'book'));
    }

    public function update(Request $request, $idtrx)
    {
        $request->validate([
            'idtrx' => 'required|string|max:20',
            'tgltrx' => 'required|date',
            'codem' => 'required|string',
            'items' => 'required|json'
        ]);
        try {
            DB::transaction(function () use ($request, $idtrx) {
                $Trxpinjam = Trxpinjam::findOrFail($idtrx);
                $Trxpinjam->update($request->only(['tgltrx', 'codem']));

                Trxpinjamdetail::where('idtrx', $idtrx)->delete();
                $this->saveTrxPjmDetails($Trxpinjam, $request->input('items'));
                $Trxpinjam->save();
            });

            return redirect()->route('trxpinjam.index')->with('success', 'Transaction has been updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update transaction: ' . $e->getMessage());
        }
    }

    public function destroy($idtrx)
    {
        $Trxpinjam = Trxpinjam::findOrFail($idtrx);

        Trxpinjamdetail::where('idtrx', $idtrx)->delete();
        $Trxpinjam->delete();

        return redirect()->route('trxpinjam.index')->with('success', 'Deleted successfully.');
    }

    public function show()
    {
    }

    public function getMember(Request $request)
    {
        $codem = $request->input('codem');
        $member = Member::find($codem);

        if ($member) {
            return response()->json([
                'name' => $member->name,
                'stts' => $member->stts
            ]);
        }
        return response()->json(['error' => 'member name tidak ditemukan'], 404);
    }

    public function getNameBook(Request $request)
    {
        $codeb = $request->input('codeb');
        $book = Book::find($codeb);

        if ($book) {
            return response()->json([
                'title' => $book->title,
                'author' => $book->author
            ]);
        }
        return response()->json(['error' => 'title tidak ditemukan'], 404);
    }

    public function getNotaPjm(Request $request)
    {
        $tgltrx1 = $request->input('tgltrx1');
        $huruf = "PJ" . str_replace('-', '', $tgltrx1);

        $data = DB::table('Trxpinjam')
            ->select(DB::raw('MAX(idtrx) as kode1'))
            ->where('idtrx', 'LIKE', '%' . $huruf . '%')
            ->first();

        $urutan = (int) substr($data->kode1, 11, 4) + 1;
        $idtrx = $huruf . sprintf("%04s", $urutan);

        return response()->json(['idtrx' => $idtrx]);
    }

    private function saveTrxPjmDetails($trxpinjam, $items)
    {
        $items = json_decode($items, true);
        foreach ($items as $item) {
            $detail = new Trxpinjamdetail();
            $detail->fill([
                'idtrx' => $trxpinjam->idtrx,
                'codeb' => $item['codeb'],
                'jmlpinjam' => $item['jmlpinjam']
            ]);
            $detail->save();
        }
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
