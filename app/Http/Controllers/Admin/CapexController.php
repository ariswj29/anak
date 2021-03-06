<?php

namespace App\Http\Controllers\Admin;

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
use DataTables;
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
        farm.farm_id,
        farm.nama_farm,
        farm.alamat_farm,
        mitra.nama as nama_mitra,
	    pjub.nama as nama,
        farm.mata_uang,
        SUM ( capex.harga * capex.jumlah ) jml_subtotal 
    FROM
        farm
        LEFT JOIN capex ON farm.farm_id = capex.farm_id
        LEFT JOIN mitra ON farm.mitra_id = mitra.mitra_id
        LEFT JOIN pjub ON mitra.pjub_id = pjub.pjub_id 
    WHERE
        farm.deleted_at IS NULL 
        AND capex.deleted_at IS NULL 
    GROUP BY
        farm.farm_id,
        farm.nama_farm,
        farm.alamat_farm,
        mitra.nama,
        pjub.nama,
        farm.mata_uang"
        ));

        return view('admin/capex')->with('summary', $summary)->with('farms', $farms);
    }

    public function detail($farm_id)
    {
        $pjub = Pjub::where('pjub_id')->first();
        $mitras = Mitra::all();
        $farms = Farm::where('farm_id', $farm_id)->get();

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

        // $data = Capex::select('*')
        //         ->join('farm', 'capex.farm_id', '=', 'farm.farm_id')
        //         ->where('capex.farm_id', $farm_id)
        //         ->limit(100)
        //         ->get();
        // return DataTables::of($data)->make(true);

        return view('admin/detail_capex')->with('pjub', $pjub)->with('mitras', $mitras)->with('farms', $farms)->with('farm_id', $farm_id)->with('farming', $farming)->with('recording', $recording) ;
    }

    public function json($farm_id){
        // echo $farm_id;
        // die;
        $data = Capex::select('*')
                ->join('farm', 'capex.farm_id', '=', 'farm.farm_id')
                ->where('capex.farm_id', $farm_id)
                ->limit(100)
                ->get();
        return DataTables::of($data)->make(true);

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

        return view('admin/tambah_capex')->with('pjubs', $pjubs)->with('mitras', $mitras)->with('pakans', $pakans)->with('berats', $berats)->with('farms', $farms)->with('sikluses', $sikluses)->with('kematians', $kematians)->with('minums', $minums)->with('vitamins', $vitamins);
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
        
        return redirect('admin/capex/'. $farm_id .'/detail');
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
            farm.nama_farm
        FROM
            capex
            JOIN farm ON farm.farm_id = capex.farm_id
        WHERE    
            capex.capex_id = $capex_id"));

        return view('admin/edit_capex')->with('pjubs', $pjubs)->with('mitras', $mitras)->with('farms', $farms)->with('sikluses', $sikluses)->with('capexs', $capexs);
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

        return redirect('/admin/capex/'. $farm_id .'/detail')->with('status', 'Data pakan berhasil ditambahkan');
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

        return redirect('/admin/capex/'. $farm_id .'/detail');
    }

}

