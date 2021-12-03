<?php

namespace App\Http\Controllers\Mitra;

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
use Auth;
// user DB;

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
        CASE 
            WHEN jenis_transaksi.jenis_transaksi = 'Pemasukan' THEN
            saldo ELSE 0 
        END as pemasukan,

        CASE
            WHEN jenis_transaksi.jenis_transaksi = 'Pengeluaran' THEN
            saldo ELSE 0 
        END  as pengeluaran,
        pjub.nama
    FROM
        siklus
        LEFT JOIN opex ON ( siklus.siklus_id = opex.siklus_id )  
        JOIN farm ON farm.farm_id = siklus.farm_id 
        LEFT JOIN mitra ON ( mitra.mitra_id = farm.mitra_id )
        LEFT JOIN pjub ON ( pjub.pjub_id = mitra.pjub_id )  
        LEFT JOIN kas ON kas.id = kas.siklus_id
        LEFT JOIN jenis_transaksi ON jenis_transaksi.jenis_transaksi_id = kas.jenis_transaksi_id
    WHERE mitra.email =  '".Auth::user()->email."' AND opex.deleted_at IS NULL
    GROUP BY 
        mitra.mitra_id,
        pjub.nama,
        farm.farm_id,
        farm.nama_farm,
        farm.alamat_farm,
        siklus.nama_siklus,
        siklus.siklus_id,
        CASE 
            WHEN jenis_transaksi.jenis_transaksi = 'Pemasukan' THEN
            saldo ELSE 0 
        END,
        CASE
            WHEN jenis_transaksi.jenis_transaksi = 'Pengeluaran' THEN
            saldo ELSE 0 
        END ,
        farm.mata_uang"
        ));

        $summarys=[]; 
        $i=0;
        // $a=0;
        // $saldoPrevTest = $summarys[0]->saldo;    
        $saldoPrev=0;
        foreach ($summary as $s ) {
            if($i!==0){
                $saldoPrev = $summarys[($i-1)]->saldo;    
                // $saldoPrevTest = $summarys[0]->saldo;    
            }
            $sTmp = json_decode(json_encode($s), true);
            $sTmp['saldo']=$sTmp['pemasukan']-$sTmp['pengeluaran']+$saldoPrev; 
            $summarys[]=(object)$sTmp; 
            $i++;
        }

        return view('mitra/kas')->with('summary', $summarys);
    }

    public function detail($siklus_id)
    {
        $sikluses = \DB::select(\DB::raw(" 
    SELECT
        siklus.siklus_id,
        siklus.nama_siklus,
        siklus.kode,
        mitra.nama,
        farm.nama_farm	
    FROM
        siklus 
        LEFT JOIN farm ON ( farm.farm_id = siklus.farm_id )
        LEFT JOIN mitra ON ( mitra.mitra_id = farm.mitra_id )
    WHERE
        siklus.siklus_id = $siklus_id"));

        $recording = \DB::select(\DB::raw(" 
    SELECT ROW_NUMBER
        ( ) OVER ( ORDER BY kas.ID ASC ) AS NO,
        siklus.siklus_id,
        kas.ID,
        kas.tanggal,
        kas.nama,
        kas.vol,
        satuan.satuan,
        kas.harga_satuan,
        kategori.kategori,
    --         jenis_transaksi.jenis_transaksi,
        CASE 
            WHEN jenis_transaksi.jenis_transaksi = 'Pemasukan' THEN
            saldo ELSE 0 
        END as pemasukan,

        CASE
            WHEN jenis_transaksi.jenis_transaksi = 'Pengeluaran' THEN
            saldo ELSE 0 
        END  as pengeluaran,
        -- ( saldo - (kas.vol * kas.harga_satuan ) + (kas.vol * kas.harga_satuan ) ) as jml_saldo,
        kas.keterangan 
    FROM
        kas
        JOIN siklus ON siklus.siklus_id = kas.siklus_id
        JOIN satuan ON satuan.satuan_id = kas.satuan_id
        JOIN kategori ON kategori.kategori_id = kas.kategori_id
        JOIN jenis_transaksi ON jenis_transaksi.jenis_transaksi_id = kas.jenis_transaksi_id 
    WHERE
        kas.siklus_id = $siklus_id 
        AND kas.deleted_at IS NULL"));

        $pjub = Pjub::where('pjub_id')->first();
        $mitras = Mitra::all();
        // $siklus = Siklus::where('siklus_id', $siklus_id)->first();
       
       
        // $berat = Berat::where('siklus_id', $siklus_id)->first();
        // $pakan = Pakan::where('siklus_id', $siklus_id)->first();
        // $kematian = Kematian::where('siklus_id', $siklus_id)->first();
        // $minum = Minum::where('siklus_id', $siklus_id)->first();
        // $vitamin = Vitamin::where('siklus_id', $siklus_id)->first();
        // var_dump($recording[0]);
        // die;
        $recordings=[]; 
        $i=0;
        // $a=0;
        // $saldoPrevTest = $recordings[0]->saldo;    
        $saldoPrev=0;
        foreach ($recording as $r ) {
            if($i!==0){
                $saldoPrev = $recordings[($i-1)]->saldo;    
                // $saldoPrevTest = $recordings[0]->saldo;    
            }
            $rTmp = json_decode(json_encode($r), true);
            $rTmp['saldo']=$rTmp['pemasukan']-$rTmp['pengeluaran']+$saldoPrev; 
            $recordings[]=(object)$rTmp; 
            $i++;
        }
        // var_dump($recordings);
        // die;
        return view('mitra/detail_kas')->with('pjub', $pjub)->with('mitras', $mitras)->with('recording', $recordings)->with('sikluses', $sikluses);
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
    //     ( ) OVER ( ORDER BY kas.ID ASC ) AS NO,
    //     siklus.siklus_id,
    //     kas.ID,
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

    //     return view('mitra/lpj_kas')->with('recording', $recording)->with('sikluses', $sikluses);
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


        

        return view('mitra/tambah_kas')->with('sikluses', $sikluses)->with('satuanes', $satuanes)->with('kategories', $kategories)->with('transaksies', $transaksies);
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $siklus_id = request('siklus_id');
        $currentDateTime = \Carbon\Carbon::now();
        $data['created_at'] = request()->get('created_at') ?  request()->get('created_at') : $currentDateTime ;  
        $data['updated_at'] = request()->get('updated_at') ?  request()->get('updated_at') : $currentDateTime ;  

        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => '',
            'nama' => '',
            'vol' => '',
            'satuan_id' => '',
            'harga_satuan' => '',
            'kategori_id' => '',
            'jenis_transaksi_id' => '',
            'saldo' => '',
            'keterangan' => '',
        ]);

        $data = request()->all();

        $kas = new Kas();
        $kas->siklus_id = $data['siklus_id'];
        $kas->tanggal = $data['tanggal'];
        $kas->nama = $data['nama'];
        $kas->vol = $data['vol'];
        $kas->satuan_id = $data['satuan_id'];
        $kas->harga_satuan = $data['harga_satuan'];
        $kas->kategori_id = $data['kategori_id'];
        $kas->jenis_transaksi_id = $data['jenis_transaksi_id'];
        $kas->saldo = $data['saldo'];
        $kas->keterangan = $data['keterangan'];

        $kas->save();
        
        session()->flash('success', 'Data Harian Berhasil Ditambah');
        
        return redirect('mitra/kas/'. $siklus_id .'/detail');
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
            kas.id 
        FROM
            kas
            JOIN siklus ON siklus.siklus_id = kas.siklus_id
        WHERE
            kas.id = $kas_id"));
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

        return view('mitra/edit_kas')->with('pjubs', $pjubs)->with('mitras', $mitras)->with('farms', $farms)->with('sikluses', $sikluses)->with('kases', $kases)->with('satuanes', $satuanes)->with('kategories', $kategories)->with('transaksies', $transaksies);
    }
    
    public function update(Request $request, $kas_id)
    {
        $siklus_id = request('siklus_id');
        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => '',
            'nama' => '',
            'vol' => '',
            'satuan_id' => '',
            'harga_satuan' => '',
            'kategori_id' => '',
            'jenis_transaksi_id' => '',
            'saldo' => '',
            'keterangan' => '',
        ]);

        $data = request()->all();

        $kas = Kas::find($kas_id);
        $kas->siklus_id = $data['siklus_id'];
        $kas->tanggal = $data['tanggal'];
        $kas->nama = $data['nama'];
        $kas->vol = $data['vol'];
        $kas->satuan_id = $data['satuan_id'];
        $kas->harga_satuan = $data['harga_satuan'];
        $kas->kategori_id = $data['kategori_id'];
        $kas->jenis_transaksi_id = $data['jenis_transaksi_id'];
        $kas->saldo = $data['saldo'];
        $kas->keterangan = $data['keterangan'];

        $kas->save();
        
        session()->flash('success', 'Data Harian Berhasil Diubah');
        
        return redirect('mitra/kas/'. $siklus_id .'/detail');
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

        return redirect('/mitra/kas/'. $siklus_id .'/detail');
    }
}

