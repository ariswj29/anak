<?php

namespace App\Http\Controllers\Pjub;

use Illuminate\Http\Request;
use App\Models\Pjub;
use App\Models\Mitra;
use App\Models\Farm;
use App\Models\Siklus;
use App\Models\User;
use App\Models\Berat;
use App\Models\Pakan;
use App\Models\Kematian;
use App\Models\Vitamin;
use App\Models\Minum;
use App\Models\Kas;
use App\Models\Satuan;
use App\Models\Kategori;
use App\Models\Opex;
use App\DataTables\Pjub\KasDataTable;
use App\Exports\Pjub\KasExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use DB;

class KasController extends \app\Http\Controllers\Controller
{   
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // echo Auth::user()->hak_akses;
        // var_dump(Auth::user());
        // die;
        if (Auth::check() && Auth::user()->hak_akses == 'administrator') {
            $pjub = Pjub::first();
            $mitras = Mitra::all();
            $farms = Farm::all();
            $siklus = Siklus::all();
            $berat = Berat::all();
            $pakan = Pakan::all();
            $kematian = Kematian::all();
            $minum = Minum::all();
            $vitamin = Vitamin::all();
        }elseif (Auth::check() && Auth::user()->hak_akses == 'mitra'){
            // $pjub = Pjub::first();
            // $mitras = Mitra::where('email', Auth::user()->email )->first();
            // $farms = Farm::where('mitra_id', $mitras->mitra_id)->get();
            $siklus = Siklus::all();
            $berat = Berat::all();
            $pakan = Pakan::all();
            $kematian = Kematian::all();
        }
        
        $summary = \DB::select(\DB::raw(" 
    SELECT
    ROW_NUMBER ( ) OVER ( ORDER BY siklus.siklus_id DESC ),
        mitra.mitra_id,
        siklus.nama_siklus,
        farm.nama_farm,
        farm.farm_id,
        siklus.siklus_id,
        farm.mata_uang,
        farm.alamat_farm,
        kas.jumlah,
        pjub.nama
    FROM
        siklus
        LEFT JOIN opex ON ( siklus.siklus_id = opex.siklus_id )  
        JOIN farm ON farm.farm_id = siklus.farm_id 
        LEFT JOIN mitra ON ( mitra.mitra_id = farm.mitra_id )
        LEFT JOIN pjub ON ( pjub.pjub_id = mitra.pjub_id )  
        LEFT JOIN kas ON kas.kas_id = kas.siklus_id
        LEFT JOIN jenis_transaksi ON jenis_transaksi.jenis_transaksi_id = kas.jenis_transaksi_id
    WHERE pjub.email =  '".Auth::user()->email."' AND siklus.deleted_at IS NULL
    GROUP BY 
        mitra.mitra_id,
        pjub.nama,
        farm.farm_id,
        farm.nama_farm,
        farm.alamat_farm,
        siklus.nama_siklus,
        siklus.siklus_id,
        kas.jumlah,
        farm.mata_uang"
        ));


        return view('pjub/kas')->with('summary', $summary);
    }

    public function detail(KasDataTable $dataTable, $siklus_id)
    {
        // $siklus_id = Siklus::find('siklus_id');
        $sikluses = Siklus::all();

        $kases = \DB::select(\DB::raw(" 
    SELECT ROW_NUMBER
        ( ) OVER ( ORDER BY kas.tanggal ASC ) AS NO,
        siklus.siklus_id,
        siklus.nama_siklus,
        kas.kas_id,
        kas.tanggal,
        kas.uraian,
        kas.vol,
        satuan.satuan,
        kas.harga_satuan,
        kategori.kategori,
        jenis_transaksi.jenis_transaksi,
        kas.keterangan 
    FROM
        kas
        JOIN siklus ON siklus.siklus_id = kas.siklus_id
        JOIN satuan ON satuan.satuan_id = kas.satuan_id
        JOIN kategori ON kategori.kategori_id = kas.kategori_id
        JOIN jenis_transaksi ON jenis_transaksi.jenis_transaksi_id = kas.jenis_transaksi_id 
    WHERE
        kas.siklus_id = $siklus_id AND kas.deleted_at IS NULL"));

        $data = DB::table('kas')->select('siklus.siklus_id',
            'kas.kas_id',
            'kas.siklus_id',
            'kas.tanggal',
            'kas.uraian',
            'kas.vol',
            'kas.deleted_at',
            DB::raw('kas.vol*kas.harga_satuan as jumlah'),
            'satuan.satuan_id',
            'kas.harga_satuan',
            // 'kategori.kategori_id' 
            'jenis_transaksi.jenis_transaksi_id' )
        ->join('siklus','siklus.siklus_id', '=', 'kas.siklus_id')
        ->join('satuan','satuan.satuan_id', '=', 'kas.satuan_id')
        ->join('kategori','kategori.kategori_id', '=', 'kas.kategori_id')
        ->join('jenis_transaksi','jenis_transaksi.jenis_transaksi_id', '=', 'kas.jenis_transaksi_id')
        ->where('kas.siklus_id', '=', $siklus_id)
        ->whereNull('kas.deleted_at')
        // ->where('kas.siklus_id', '=', Siklus::get('siklus_id') )
        // ->where('kas.siklus_id', '=', $siklus_id )
        ->get();

        // $pjub = Pjub::where('pjub_id')->first();
        // $mitras = Mitra::all();
        // $siklus = Siklus::where('siklus_id', $siklus_id)->first();
       
       
        // $berat = Berat::where('siklus_id', $siklus_id)->first();
        // $pakan = Pakan::where('siklus_id', $siklus_id)->first();
        // $kematian = Kematian::where('siklus_id', $siklus_id)->first();
        // $minum = Minum::where('siklus_id', $siklus_id)->first();
        // $vitamin = Vitamin::where('siklus_id', $siklus_id)->first();
        
            // $recordings=[]; 
            // $i=0;
            // $saldoPrev=0;
            // foreach ($recording as $r ) {
            //     if($i!==0){
            //         $saldoPrev = $recordings[($i-1)]->saldo;      
            //     }
            //     $rTmp = json_decode(json_encode($r), true);
            //     $rTmp['saldo']=$rTmp['pemasukan']-$rTmp['pengeluaran']+$saldoPrev; 
            //     $recordings[]=(object)$rTmp; 
            //     $i++;
            // }

        return $dataTable->render('pjub/detail_kas',['kases'=>$kases],['siklus_id'=>$siklus_id],['sikluses'=>$sikluses]);
        
        return view('pjub/detail_kas',['siklus_id'=>$siklus_id]);
        
        

        // return view('pjub/detail_kas',['kas'=>$kas])->with('pjub', $pjub)->with('mitras', $mitras)->with('recording', $recordings)->with('sikluses', $sikluses);
    }

    public function get_data_kas($siklus_id)
    {
        // $data = KasDataTable::query();   
        // return (array)$datatable;
        $data = DB::table('kas')->select('siklus.siklus_id',
            'kas.kas_id',
            'kas.siklus_id',
            'kas.tanggal',
            'kas.uraian',
            'kas.vol',
            'jenis_transaksi.jenis_transaksi',
            'kas.deleted_at',
            DB::raw('kas.vol*kas.harga_satuan as jumlah'),
            'satuan.satuan_id',
            'kas.harga_satuan',
            // 'kategori.kategori_id' 
            'jenis_transaksi.jenis_transaksi_id' )
        ->join('siklus','siklus.siklus_id', '=', 'kas.siklus_id')
        ->join('satuan','satuan.satuan_id', '=', 'kas.satuan_id')
        ->join('kategori','kategori.kategori_id', '=', 'kas.kategori_id')
        ->join('jenis_transaksi','jenis_transaksi.jenis_transaksi_id', '=', 'kas.jenis_transaksi_id')
        ->where('kas.siklus_id', '=', $siklus_id)
        ->whereNull('kas.deleted_at')
        // ->where('kas.siklus_id', '=', Siklus::get('siklus_id') )
        // ->where('kas.siklus_id', '=', $siklus_id )
        ->get();

        return ['data' => $data,'recordsTotal'=>ceil(count($data)/10)]; 
    }

    public function export_excel(Request $request)
    {
        return Excel::download(new KasExport($request->siklus_id), 'Buku Kas.xlsx');
    }

    // public function lpj($siklus_id)
    // {
    //     $sikluses = \DB::select(\DB::raw(" 
    // SELECT
    //     siklus.siklus_id,
    //     siklus.nama_siklus,
    //     siklus.kode,
    //     mitra.nama,
    //     farm.nama_farm	
    // FROM
    //     siklus 
    //     LEFT JOIN farm ON ( farm.farm_id = siklus.farm_id )
    //     LEFT JOIN mitra ON ( mitra.mitra_id = farm.mitra_id )
    // WHERE
    //     siklus.siklus_id = $siklus_id"));

    //     $recording = \DB::select(\DB::raw(" 
    // SELECT ROW_NUMBER
    //     ( ) OVER ( ORDER BY kas.kas_ID ASC ) AS NO,
    //     siklus.siklus_id,
    //     kas.kas_ID,
    //     kas.tanggal,
    //     kas.nama,
    //     kas.vol,
    //     satuan.satuan,
    //     kas.harga_satuan,
    //     kategori.kategori,
    // --         jenis_transaksi.jenis_transaksi,
    //     CASE
    //         WHEN jenis_transaksi.jenis_transaksi = 'Pengeluaran' THEN
    //         saldo ELSE 0 
    //     END  as pengeluaran,
            
    //     CASE 
    //         WHEN jenis_transaksi.jenis_transaksi = 'Pemasukan' THEN
    //         saldo ELSE 0 
    //     END as pemasukan,
    //     kas.saldo,
    //     kas.keterangan 
    // FROM
    //     kas
    //     JOIN siklus ON siklus.siklus_id = kas.siklus_id
    //     JOIN satuan ON satuan.satuan_id = kas.satuan_id
    //     JOIN kategori ON kategori.kategori_id = kas.kategori_id
    //     JOIN jenis_transaksi ON jenis_transaksi.jenis_transaksi_id = kas.jenis_transaksi_id 
    // WHERE
    //     kas.siklus_id = $siklus_id 
    //     AND kas.deleted_at IS NULL"));

    //     return view('pjub/lpj_kas')->with('recording', $recording)->with('sikluses', $sikluses);
    // }

    public function create($siklus_id)
    {            
        $sikluses = \DB::select(\DB::raw("
    SELECT
        siklus.siklus_id,
        siklus.nama_siklus,
        opex.opex_id
    FROM
        siklus
        LEFT JOIN opex ON opex.opex_id = opex.siklus_id
    WHERE
        siklus.siklus_id = $siklus_id"));

        $kategories = \DB::select(\DB::raw("
    SELECT
        kategori.kategori_id,
        kategori.kategori
    FROM
        kategori"));
        $satuanes = \DB::select(\DB::raw("
    SELECT
        satuan.satuan_id,
        satuan.satuan
    FROM
        satuan"));
        $transaksies = \DB::select(\DB::raw("
    SELECT
        jenis_transaksi.jenis_transaksi_id,
        jenis_transaksi.jenis_transaksi
    FROM
        jenis_transaksi"));


        

        return view('pjub/tambah_kas')->with('sikluses', $sikluses)->with('satuanes', $satuanes)->with('kategories', $kategories)->with('transaksies', $transaksies);
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $siklus_id = request('siklus_id');
        $currentDateTime = \Carbon\Carbon::now();
        $data['created_at'] = request()->get('created_at') ?  request()->get('created_at') : $currentDateTime ;  
        $data['updated_at'] = request()->get('updated_at') ?  request()->get('updated_at') : $currentDateTime ; 
        
        $vol = $_POST['vol'];
        $harga_satuan = $_POST['harga_satuan'];
        $jumlah = $vol + $harga_satuan;

        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => '',
            'uraian' => '',
            'vol' => '',
            'satuan_id' => '',
            'harga_satuan' => '',
            'kategori_id' => '',
            'jenis_transaksi_id' => '',
            // 'jumlah' => '',
            'keterangan' => '',
        ]);

        $data = request()->all();

        $kas = new Kas();
        $kas->siklus_id = $data['siklus_id'];
        $kas->tanggal = $data['tanggal'];
        $kas->uraian = $data['uraian'];
        $kas->vol = $data['vol'];
        $kas->satuan_id = $data['satuan_id'];
        $kas->harga_satuan = $data['harga_satuan'];
        $kas->kategori_id = $data['kategori_id'];
        $kas->jenis_transaksi_id = $data['jenis_transaksi_id'];
        // $kas->jumlah = $data['jumlah'];
        $kas->keterangan = $data['keterangan'];

        $kas->save();
        
        session()->flash('success', 'Data Harian Berhasil Ditambah');
        
        return redirect('pjub/kas/'. $siklus_id .'/detail');
    }
    
    public function edit($kas_id)
    {
        $pjubs = Pjub::all();
        $mitras = Mitra::all();
        $farms = Farm::all();
        $kases = kas::find($kas_id);
        $sikluses = \DB::select(\DB::raw("
        SELECT
            siklus.siklus_id,
            siklus.nama_siklus,
            kas.kas_id 
        FROM
            kas
            JOIN siklus ON siklus.siklus_id = kas.siklus_id
        WHERE
            kas.kas_id = $kas_id"));
    $satuanes = \DB::select(\DB::raw("
        SELECT
            satuan.satuan_id,
            satuan.satuan
        FROM
            satuan"));
    $kategories = \DB::select(\DB::raw("
        SELECT
            kategori.kategori_id,
            kategori.kategori
        FROM
            kategori"));
    $transaksies = \DB::select(\DB::raw("
        SELECT
            jenis_transaksi.jenis_transaksi_id,
            jenis_transaksi.jenis_transaksi
        FROM
            jenis_transaksi"));

        return view('pjub/edit_kas')->with('pjubs', $pjubs)->with('mitras', $mitras)->with('farms', $farms)->with('sikluses', $sikluses)->with('kases', $kases)->with('satuanes', $satuanes)->with('kategories', $kategories)->with('transaksies', $transaksies);
    }
    
    public function update(Request $request, $kas_id)
    {
        $vol = $_POST['vol'];
        $harga_satuan = $_POST['harga_satuan'];
        $jumlah = $vol + $harga_satuan;

        $siklus_id = request('siklus_id');
        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => '',
            'uraian' => '',
            'vol' => '',
            'satuan_id' => '',
            'harga_satuan' => '',
            'kategori_id' => '',
            'jenis_transaksi_id' => '',
            // 'jumlah' => '',
            'keterangan' => '',
        ]);

        $data = request()->all();

        $kas = Kas::find($kas_id);
        $kas->siklus_id = $data['siklus_id'];
        $kas->tanggal = $data['tanggal'];
        $kas->uraian = $data['uraian'];
        $kas->vol = $data['vol'];
        $kas->satuan_id = $data['satuan_id'];
        $kas->harga_satuan = $data['harga_satuan'];
        $kas->kategori_id = $data['kategori_id'];
        $kas->jenis_transaksi_id = $data['jenis_transaksi_id'];
        // $kas->jumlah = $data['jumlah'];
        $kas->keterangan = $data['keterangan'];

        $kas->save();
        
        session()->flash('success', 'Data Harian Berhasil Diubah');
        
        return redirect('pjub/kas/'. $siklus_id .'/detail');
    }

    public function show()
    {
    //   // Jumlah Farm Di Dasbor
    // $pjub = Pjub::where('pjub_id',$pjub_id)->first();
    // $pjub = Pjub::where('pjub_id',$pjub_id)->first();
    //   return view ('home', compact('farms'));
    }

    public function destroy($kas_id, $siklus_id)
    {
        //
        $kas = kas::find($kas_id);

        $kas->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/pjub/kas/'. $siklus_id .'/detail');
    }
}

