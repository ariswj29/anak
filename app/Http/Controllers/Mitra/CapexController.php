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
use App\Models\Capex;
use Auth;
// user DB;

class CapexController extends \app\Http\Controllers\Controller
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
            // $siklus = Siklus::all();
            $berat = Berat::all();
            $pakan = Pakan::all();
            $kematian = Kematian::all();
        }
        
        $summary = \DB::select(\DB::raw(" 
    SELECT
        mitra.mitra_id,
        farm.farm_id,
        farm.nama_farm,
        farm.alamat_farm,
        pjub.nama,
        farm.mata_uang,
        SUM ( capex.harga * capex.jumlah ) jml_subtotal
    FROM
        farm
        LEFT JOIN capex ON farm.farm_id = capex.farm_id
        LEFT JOIN mitra ON ( mitra.mitra_id = farm.mitra_id )
        LEFT JOIN pjub ON ( pjub.pjub_id = mitra.pjub_id )
    WHERE
        mitra.email = '".Auth::user()->email."' AND capex.deleted_at is NULL
    GROUP BY
        mitra.mitra_id,
        pjub.nama,
        farm.farm_id,
        farm.nama_farm,
        farm.alamat_farm,
        farm.mata_uang"
        ));

        return view('mitra/capex')->with('summary', $summary);
    }

    public function detail($farm_id)
    {
        $farming = \DB::select(\DB::raw(" 
    SELECT
        farm.farm_id,
        farm.nama_farm,
        mitra.nama	
    FROM
        farm 
        LEFT JOIN mitra ON ( mitra.mitra_id = farm.mitra_id )
    WHERE
        farm.farm_id = $farm_id"));

        $recording = \DB::select(\DB::raw(" 
    SELECT ROW_NUMBER
        ( ) OVER ( ORDER BY capex.capex_id ASC ) AS no,
        farm.farm_id,
        capex.capex_id,
        capex.capex,
        capex.jumlah,
        capex.harga,
        capex.satuan,
        (jumlah * harga)subtotal,
        capex.keterangan,
        farm.nama_farm,
        mitra.nama	
    FROM
        capex
        JOIN farm ON farm.farm_id = capex.farm_id 
        LEFT JOIN mitra ON ( mitra.mitra_id = farm.mitra_id )
    WHERE
        capex.farm_id = $farm_id AND capex.deleted_at IS NULL"));

        $pjub = Pjub::where('pjub_id')->first();
        $mitras = Mitra::all();
        $farms = Farm::where('farm_id', $farm_id)->get();
        // $siklus = Siklus::where('siklus_id', $siklus_id)->first();
       
       
        // $berat = Berat::where('siklus_id', $siklus_id)->first();
        // $pakan = Pakan::where('siklus_id', $siklus_id)->first();
        // $kematian = Kematian::where('siklus_id', $siklus_id)->first();
        // $minum = Minum::where('siklus_id', $siklus_id)->first();
        // $vitamin = Vitamin::where('siklus_id', $siklus_id)->first();

        return view('mitra/detail_capex')->with('pjub', $pjub)->with('mitras', $mitras)->with('farms', $farms)->with('farming', $farming)->with('recording', $recording);
    }

    public function create($farm_id)
    {            
        $pjubs = Pjub::all();
        $mitras = Mitra::all();
        $farms = Farm::all();
        $berats = Berat::all();
        $pakans = Pakan::all();
        $kematians = Kematian::all();
        $minums = Minum::all();
        $vitamins = Vitamin::all();
        $sikluses = \DB::select(\DB::raw("
        SELECT
            farm.farm_id,
            farm.nama_farm
        FROM
            farm
            JOIN mitra ON farm.mitra_id = mitra.mitra_id
        WHERE    
            farm.farm_id = $farm_id"));

        return view('mitra/tambah_capex')->with('pjubs', $pjubs)->with('mitras', $mitras)->with('pakans', $pakans)->with('berats', $berats)->with('farms', $farms)->with('sikluses', $sikluses)->with('kematians', $kematians)->with('minums', $minums)->with('vitamins', $vitamins);
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $farm_id = request('farm_id');
        $pjubs = Pjub::all();
        $currentDateTime = \Carbon\Carbon::now();
        $data['jumlah'] = request()->get('jumlah') ?  request()->get('jumlah') : '0' ;  
        $data['harga'] = request()->get('harga') ?  request()->get('harga') : '0' ;  
        $data['satuan'] = request()->get('satuan') ?  request()->get('satuan') : '-' ;  
        $data['keterangan'] = request()->get('keterangan') ?  request()->get('keterangan') : 'Insyaallah tidak ada' ;  
        $data['subtotal'] = request()->get('subtotal') ?  request()->get('subtotal') : 'jumlah * harga' ; 
        $data['created_at'] = request()->get('created_at') ?  request()->get('created_at') : $currentDateTime ;  
        $data['updated_at'] = request()->get('updated_at') ?  request()->get('updated_at') : $currentDateTime ;  

        $this->validate(request(),[
            'farm_id' => 'required',
            'capex' => 'required',
            'harga' => '',
            'jumlah' => '',
            'satuan' => '',
            'keterangan' => '',
        ]);

        $data = request()->all();

        $capex = new Capex();
        $capex->farm_id = $data['farm_id'];
        $capex->capex = $data['capex'];
        $capex->harga = $data['harga'];
        $capex->jumlah = $data['jumlah'];
        $capex->satuan = $data['satuan'];
        $capex->keterangan = $data['keterangan'];

        $capex->save();
        
        session()->flash('success', 'Data Harian Berhasil Ditambah');
        
        return redirect('mitra/capex/'. $farm_id .'/detail');
    }
    
    public function edit($capex_id)
    {
        $pjubs = Pjub::all();
        $mitras = Mitra::all();
        $farms = Farm::all();
        $capexs = capex::find($capex_id);
        $sikluses = \DB::select(\DB::raw("
        SELECT
            farm.farm_id,
            farm.nama_farm,
            capex.capex_id 
        FROM
            capex
            JOIN farm ON farm.farm_id = capex.farm_id
        WHERE
            capex.capex_id = $capex_id"));

        return view('mitra/edit_capex')->with('pjubs', $pjubs)->with('mitras', $mitras)->with('farms', $farms)->with('sikluses', $sikluses)->with('capexs', $capexs);
    }
    
    public function update(Request $request, $capex_id)
    {
        $farm_id = request('farm_id');
        $this->validate(request(),[
            'farm_id' => 'required',
            'capex' => 'required',
            'harga' => '',
            'jumlah' => '',
            'satuan' => '',
            'keterangan' => '',
            ]);
    
        $data = request()->all();
    
        $capex = Capex::find($capex_id);
        $capex->farm_id = $data['farm_id'];
        $capex->capex = $data['capex'];
        $capex->harga = $data['harga'];
        $capex->jumlah = $data['jumlah'];
        $capex->satuan = $data['satuan'];
        $capex->keterangan = $data['keterangan'];

        $capex->save();

        session()->flash('success', 'Data Berhasil Diubah');

        return redirect('/mitra/capex/'. $farm_id .'/detail')->with('status', 'Data pakan berhasil ditambahkan');
    }

    public function show()
    {
    //   // Jumlah Farm Di Dasbor
    // $pjub = Pjub::where('pjub_id',$pjub_id)->first();
    // $pjub = Pjub::where('pjub_id',$pjub_id)->first();
    //   return view ('home', compact('farms'));
    }

    public function destroy($capex_id, $farm_id)
    {
        //
        $capex = Capex::find($capex_id);

        $capex->delete();

        session()->flash('success', 'Data Berhasil Dihapus');

        return redirect('/mitra/capex/'. $farm_id .'/detail');
    }

}

