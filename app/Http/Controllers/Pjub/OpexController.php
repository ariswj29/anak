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
use App\Models\Opex;
use Auth;
// user DB;

class OpexController extends \app\Http\Controllers\Controller
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
        }elseif (Auth::check() && Auth::user()->hak_akses == 'pjub'){
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
        mitra.mitra_id,
        siklus.nama_siklus,
        farm.nama_farm,
        farm.farm_id,
        siklus.siklus_id,
        farm.mata_uang,
        farm.alamat_farm,
        mitra.nama,
        SUM ( opex.harga * opex.jumlah ) jml_subtotal
    FROM
        siklus
        LEFT JOIN opex ON ( siklus.siklus_id = opex.siklus_id )  
        JOIN farm ON farm.farm_id = siklus.farm_id 
        LEFT JOIN mitra ON ( mitra.mitra_id = farm.mitra_id )
        LEFT JOIN pjub ON ( pjub.pjub_id = mitra.pjub_id )  
    WHERE pjub.email =  '".Auth::user()->email."'
        AND siklus.deleted_at is NULL
        AND opex.deleted_at IS NULL
    GROUP BY 
        mitra.mitra_id,
        mitra.nama,
        farm.farm_id,
        farm.nama_farm,
        farm.alamat_farm,
        siklus.nama_siklus,
        siklus.siklus_id,
        farm.mata_uang"
        ));

        return view('pjub/opex')->with('summary', $summary);
    }

    public function detail($siklus_id)
    {
        $sikluses = \DB::select(\DB::raw(" 
    SELECT
        siklus.siklus_id,
        siklus.nama_siklus,
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
        ( ) OVER ( ORDER BY opex.opex_id ASC ) AS NO,
        siklus.siklus_id,
        opex.opex_id,
        opex.opex,
        opex.jumlah,
        opex.harga,
        opex.satuan,
        ( jumlah * harga ) AS subtotal,
        opex.keterangan
    FROM
        opex
        JOIN siklus ON siklus.siklus_id = opex.siklus_id
    WHERE
        opex.siklus_id =  $siklus_id AND opex.deleted_at IS NULL"));

        $pjub = Pjub::where('pjub_id')->first();
        $mitras = Mitra::all();
        // $siklus = Siklus::where('siklus_id', $siklus_id)->first();
       
       
        // $berat = Berat::where('siklus_id', $siklus_id)->first();
        // $pakan = Pakan::where('siklus_id', $siklus_id)->first();
        // $kematian = Kematian::where('siklus_id', $siklus_id)->first();
        // $minum = Minum::where('siklus_id', $siklus_id)->first();
        // $vitamin = Vitamin::where('siklus_id', $siklus_id)->first();

        return view('pjub/detail_opex')->with('pjub', $pjub)->with('mitras', $mitras)->with('recording', $recording)->with('sikluses', $sikluses);
    }

    public function create($siklus_id)
    {            
        $sikluses = \DB::select(\DB::raw("
    SELECT
        siklus.siklus_id,
        siklus.nama_siklus,
        opex.opex_id,
        farm.farm_id	 
    FROM
        siklus
        LEFT JOIN opex ON opex.opex_id = opex.siklus_id
        JOIN farm ON farm.farm_id = siklus.farm_id
        LEFT JOIN mitra ON farm.mitra_id = mitra.mitra_id 
        LEFT JOIN pjub ON mitra.pjub_id = pjub.pjub_id
    WHERE
        siklus.siklus_id = $siklus_id"));

        return view('pjub/tambah_opex')->with('sikluses', $sikluses);
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $siklus_id = request('siklus_id');
        $pjubs = Pjub::all();
        $currentDateTime = \Carbon\Carbon::now();
        $data['jumlah'] = request()->get('jumlah') ?  request()->get('jumlah') : '0' ;  
        $data['harga'] = request()->get('harga') ?  request()->get('harga') : '0' ;  
        $data['keterangan'] = request()->get('keterangan') ?  request()->get('keterangan') : 'Tidak ada' ;  
        $data['satuan'] = request()->get('satuan') ?  request()->get('satuan') : '-' ;  
        $data['created_at'] = request()->get('created_at') ?  request()->get('created_at') : $currentDateTime ;  
        $data['updated_at'] = request()->get('updated_at') ?  request()->get('updated_at') : $currentDateTime ;  

        $this->validate(request(),[
            'siklus_id' => 'required',
            'opex' => 'required',
            'harga' => '',
            'jumlah' => '',
            'satuan' => '',
            'keterangan' => '',
        ]);

        $data = request()->all();

        $opex = new Opex();
        $opex->siklus_id = $data['siklus_id'];
        $opex->opex = $data['opex'];
        $opex->harga = $data['harga'];
        $opex->jumlah = $data['jumlah'];
        $opex->satuan = $data['satuan'];
        $opex->keterangan = $data['keterangan'];

        $opex->save();
        
        session()->flash('success', 'Data Harian Berhasil Ditambah');
        
        return redirect('pjub/opex/'. $siklus_id .'/detail');
    }
    
    public function edit($opex_id)
    {
        $pjubs = Pjub::all();
        $mitras = Mitra::all();
        $farms = Farm::all();
        $opexs = opex::find($opex_id);
        $sikluses = \DB::select(\DB::raw("
        SELECT
            siklus.siklus_id,
            siklus.nama_siklus,
            opex.opex_id 
        FROM
            opex
            JOIN siklus ON siklus.siklus_id = opex.siklus_id
        WHERE
            opex.opex_id = $opex_id"));

            return view('pjub/edit_opex')->with('pjubs', $pjubs)->with('mitras', $mitras)->with('farms', $farms)->with('sikluses', $sikluses)->with('opexs', $opexs);
    }
    
    public function update(Request $request, $opex_id)
    {
        $siklus_id = request('siklus_id');
        $this->validate(request(),[
            'siklus_id' => 'required',
            'opex' => 'required',
            'harga' => '',
            'jumlah' => '',
            'satuan' => '',
            'keterangan' => '',
        ]);

        $data = request()->all();

        $opex = Opex::find($opex_id);
        $opex->siklus_id = $data['siklus_id'];
        $opex->opex = $data['opex'];
        $opex->harga = $data['harga'];
        $opex->jumlah = $data['jumlah'];
        $opex->satuan = $data['satuan'];
        $opex->keterangan = $data['keterangan'];

        $opex->save();
        
        session()->flash('success', 'Data Harian Berhasil Diubah');
        
        return redirect('pjub/opex/'. $siklus_id .'/detail');
    }

    public function show()
    {
    //   // Jumlah Farm Di Dasbor
    // $pjub = Pjub::where('pjub_id',$pjub_id)->first();
    // $pjub = Pjub::where('pjub_id',$pjub_id)->first();
    //   return view ('home', compact('farms'));
    }

    public function destroy($opex_id, $siklus_id)
    {
        //
        $opex = Opex::find($opex_id);

        $opex->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/pjub/opex/'. $siklus_id .'/detail');
    }
}

