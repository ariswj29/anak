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
use Auth;
// user DB;

class IndexController extends \app\Http\Controllers\Controller
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
        row_number() over(ORDER BY siklus.siklus_id DESC),
        mitra.mitra_id,
        farm.nama_farm,
        farm.alamat_farm,
        siklus.nama_siklus,
        pjub.nama pjub,
        mitra.nama mitra,
        siklus.siklus_id,
        siklus.jenis_ternak,
        siklus.jumlah_ternak,
        SUM ( pakan.jumlah_pakan ) jml_pakan,
        SUM ( kematian.jumlah_kematian ) jml_kematian,
        SUM ( pakan.pakan_digunakan ) jml_pakan_digunakan,
        SUM ( berat.rata_rata_berat ) jml_rata 
    FROM
        siklus
        LEFT JOIN pakan ON ( pakan.siklus_id = siklus.siklus_id AND pakan.tanggal = siklus.tanggal )
        LEFT JOIN kematian ON ( kematian.siklus_id = siklus.siklus_id AND kematian.tanggal = siklus.tanggal )
        LEFT JOIN berat ON ( berat.siklus_id = siklus.siklus_id AND berat.tanggal = siklus.tanggal )
        LEFT JOIN farm ON ( farm.farm_id = siklus.farm_id )
        LEFT JOIN mitra ON ( mitra.mitra_id = farm.mitra_id )
        LEFT JOIN pjub ON ( pjub.pjub_id = mitra.pjub_id )  
    WHERE pjub.email = '".Auth::user()->email."' AND siklus.deleted_at IS NULL
    GROUP BY
        mitra.mitra_id,
        farm.nama_farm,
        farm.alamat_farm,
        siklus.nama_siklus,
        siklus.siklus_id,
        mitra.nama,
        pjub.nama,
        siklus.jenis_ternak,
        siklus.jumlah_ternak"
        ));

        return view('pjub/index')->with('summary', $summary);
    }

    public function detail($siklus_id)
    {
        $summary = \DB::select(\DB::raw(" 
    SELECT
        mitra.mitra_id,
        pjub.nama pjub,
        mitra.nama,
        siklus.jenis_ternak,
        siklus.jumlah_ternak,
        sum(pakan.jumlah_pakan) jml_pakan,
        sum(kematian.jumlah_kematian) jml_kematian,
        sum(pakan.pakan_digunakan ) jml_pakan_digunakan,
        sum(berat.rata_rata_berat) jml_rata
    FROM
        pakan
        JOIN siklus ON ( pakan.siklus_id = siklus.siklus_id )
        LEFT JOIN kematian ON ( kematian.siklus_id = pakan.siklus_id and kematian.tanggal = pakan.tanggal )
        LEFT JOIN berat ON ( berat.siklus_id = pakan.siklus_id and berat.tanggal = pakan.tanggal ) 
        LEFT JOIN farm ON ( farm.farm_id = siklus.farm_id )
        LEFT JOIN mitra ON ( mitra.mitra_id = farm.mitra_id )
        LEFT JOIN pjub ON ( pjub.pjub_id = mitra.pjub_id)
    WHERE
        
        siklus.siklus_id = $siklus_id
        
        GROUP BY mitra.mitra_id,mitra.nama,pjub.nama, siklus.jenis_ternak,siklus.jumlah_ternak"
        ));

        $recording = \DB::select(\DB::raw(" 
    SELECT
        row_number() over(ORDER BY pakan.tanggal ASC) AS hari_ke,
        pakan.jumlah_pakan,
        pakan.pakan_digunakan,
        pakan.tanggal,
        berat.rata_rata_berat,
        kematian.jumlah_kematian,
        minum.jumlah_minum	 
    FROM
        pakan
        LEFT JOIN berat ON ( berat.siklus_id = pakan.siklus_id AND berat.tanggal = pakan.tanggal )
        LEFT JOIN minum ON ( minum.siklus_id = pakan.siklus_id AND minum.tanggal = pakan.tanggal )
        LEFT JOIN kematian ON ( kematian.siklus_id = pakan.siklus_id AND kematian.tanggal = pakan.tanggal ) 
        
    WHERE
        pakan.siklus_id = $siklus_id"
        ));

        $pjub = Pjub::where('pjub_id')->first();
        $mitras = Mitra::all();
        $farms = Farm::all();
        $siklus = Siklus::where('siklus_id', $siklus_id)->first();
       
       
        $berat = Berat::where('siklus_id', $siklus_id)->first();
        $pakan = Pakan::where('siklus_id', $siklus_id)->first();
        $kematian = Kematian::where('siklus_id', $siklus_id)->first();
        $minum = Minum::where('siklus_id', $siklus_id)->first();
        $vitamin = Vitamin::where('siklus_id', $siklus_id)->first();

        return view('pjub/detail')->with('pjub', $pjub)->with('mitras', $mitras)->with('pakan', $pakan)->with('berat', $berat)->with('farms', $farms)->with('siklus', $siklus)->with('kematian', $kematian)->with('recording', $recording)->with('summary', $summary);
    }

    public function create()
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
            siklus.nama_siklus,
            siklus.siklus_id,
            farm.nama_farm
        FROM
            siklus
            JOIN farm ON siklus.farm_id = farm.farm_id 
            JOIN mitra ON farm.mitra_id = mitra.mitra_id
            JOIN pjub ON mitra.pjub_id = pjub.pjub_id
        WHERE
            pjub.email = '".Auth::user()->email."' "));

        return view('pjub/perbarui')->with('pjubs', $pjubs)->with('mitras', $mitras)->with('pakans', $pakans)->with('berats', $berats)->with('farms', $farms)->with('sikluses', $sikluses)->with('kematians', $kematians)->with('minums', $minums)->with('vitamins', $vitamins);
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $siklus_id = request('siklus_id');
        $pjubs = Pjub::all();
        $siklus = Siklus::where('siklus_id', $siklus_id)->first();
        $berat = Berat::where('siklus_id', $siklus_id)->first();
        $pakan = Pakan::where('siklus_id', $siklus_id)->first();
        $kematian = Kematian::where('siklus_id', $siklus_id)->first();
        $minum = Minum::where('siklus_id', $siklus_id)->first();
        $vitamin = Vitamin::where('siklus_id', $siklus_id)->first();
        $currentDateTime = \Carbon\Carbon::now();
        $data['jenis_pakan'] = request()->get('jenis_pakan') ?  request()->get('jenis_pakan') : 'Grower' ;  
        $data['created_at'] = request()->get('created_at') ?  request()->get('created_at') : $currentDateTime ;  
        $data['updated_at'] = request()->get('updated_at') ?  request()->get('updated_at') : $currentDateTime ;  
        $recording = \DB::select(\DB::raw(" 
    SELECT
        row_number() over(ORDER BY pakan.tanggal ASC) AS hari_ke,
        pakan.jumlah_pakan,
        pakan.pakan_digunakan,
        pakan.tanggal,
        berat.rata_rata_berat,
        kematian.jumlah_kematian	 
    FROM
        pakan
        LEFT JOIN berat ON ( berat.siklus_id = pakan.siklus_id AND berat.tanggal = pakan.tanggal )
        LEFT JOIN kematian ON ( kematian.siklus_id = pakan.siklus_id AND kematian.tanggal = pakan.tanggal ) 
        
    WHERE
        pakan.siklus_id = $siklus_id"
        ));
        $summary = \DB::select(\DB::raw(" 
        SELECT
            mitra.mitra_id,
            pjub.nama pjub,
            mitra.nama mitra,
            siklus.jenis_ternak,
            siklus.jumlah_ternak,
            sum(pakan.jumlah_pakan) jml_pakan,
            sum(kematian.jumlah_kematian) jml_kematian,
            sum(pakan.pakan_digunakan ) jml_pakan_digunakan,
            sum(berat.rata_rata_berat) jml_rata
        FROM
            pakan
            JOIN siklus ON ( pakan.siklus_id = siklus.siklus_id )
            LEFT JOIN kematian ON ( kematian.siklus_id = pakan.siklus_id and kematian.tanggal = pakan.tanggal )
            LEFT JOIN berat ON ( berat.siklus_id = pakan.siklus_id and berat.tanggal = pakan.tanggal ) 
            LEFT JOIN farm ON ( farm.farm_id = siklus.farm_id )
            LEFT JOIN mitra ON ( mitra.mitra_id = farm.mitra_id )
            LEFT JOIN pjub ON ( pjub.pjub_id = mitra.pjub_id)
        WHERE
            
            siklus.siklus_id = $siklus_id
            
            GROUP BY mitra.mitra_id,mitra.nama,pjub.nama, siklus.jenis_ternak,siklus.jumlah_ternak"
            ));

        // pakan
        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => 'required',
            'jenis_pakan' => '',
            'jumlah_pakan' => '',
            'pakan_digunakan' => 'required',
            'created_at' => '',
            'updated_at' => '',  
            ]);

        // $pakan = new Pakan();
        // $pakan->siklus_id = $data['siklus_id'];
        // $pakan->jenis_pakan = $data['jenis_pakan'];
        // $pakan->jumlah_pakan = $data['jumlah_pakan'];
        // $pakan->pakan_digunakan = $data['pakan_digunakan'];
        // $pakan->tanggal = $data['tanggal'];
        // $pakan->save();

        \DB::table('pakan')->upsert([
            'siklus_id' => $data['siklus_id'],
            'tanggal' => $data['tanggal'],
            'jenis_pakan' => $data['jenis_pakan'],
            'jumlah_pakan' => $data['jumlah_pakan'],
            'pakan_digunakan' => $data['pakan_digunakan'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at']],
            ['tanggal','siklus_id']);

        // berat
        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => 'required',
            'rata_rata_berat' => 'required',
            'created_at' => '',
            'updated_at' => '',
            ]);

        // $berat = new Berat();
        // $berat->siklus_id = $data['siklus_id'];
        // $berat->rata_rata_berat = $data['rata_rata_berat'];
        // $berat->tanggal = $data['tanggal'];
        // $berat->save();
        

        \DB::table('berat')->upsert([
            'siklus_id' => $data['siklus_id'],
            'tanggal' => $data['tanggal'],
            'rata_rata_berat' => $data['rata_rata_berat'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at']],
            ['tanggal','siklus_id']);

        // kematian
        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => 'required',
            'jumlah_kematian' => '',
            'penyebab' => '',
            'created_at' => '',
            'updated_at' => '',
            ]);


        \DB::table('kematian')->upsert([
            'siklus_id' => $data['siklus_id'],
            'tanggal' => $data['tanggal'],
            'jumlah_kematian' => $data['jumlah_kematian'],
            'penyebab' => $data['penyebab'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at']],
            ['tanggal','siklus_id']);

        // minum
        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => 'required',
            'jumlah_minum' => '',
            'created_at' => '',
            'updated_at' => '',
            ]);


        \DB::table('minum')->upsert([
            'siklus_id' => $data['siklus_id'],
            'tanggal' => $data['tanggal'],
            'jumlah_minum' => $data['jumlah_minum'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at']],
            ['tanggal','siklus_id']);

        // vitamin
        $this->validate(request(),[
            'siklus_id' => 'required',
            'tanggal' => 'required',
            'jenis_vitamin' => '',
            'jumlah_vitamin' => '',
            'created_at' => '',
            'updated_at' => '',
            ]);


        \DB::table('vitamin')->upsert([
            'siklus_id' => $data['siklus_id'],
            'tanggal' => $data['tanggal'],
            'jenis_vitamin' => $data['jenis_vitamin'],
            'jumlah_vitamin' => $data['jumlah_vitamin'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at']],
            ['tanggal','siklus_id']);

        // $kematian = new Kematian();
        // $kematian->siklus_id = $data['siklus_id'];
        // $kematian->tanggal = $data['tanggal'];
        // $kematian->jumlah_kematian = $data['jumlah_kematian'];
        // $kematian->save();
        
        session()->flash('success', 'Data Harian Berhasil Ditambah');
        
        return redirect('pjub/'. $siklus_id .'/detail');
    }
    
    public function edit()
    {
        
    }
    
    public function update(Request $request)
    {
        
        // $request->validate([
        //     'current_password' => ['required', new MatchOldPassword],
        //     'new_password' => ['required'],
        //     'new_confirm_password' => ['same:new_password'],
        // ]);
   
        // User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
    }

    public function show()
    {
    //   // Jumlah Farm Di Dasbor
    // $pjub = Pjub::where('pjub_id',$pjub_id)->first();
    // $pjub = Pjub::where('pjub_id',$pjub_id)->first();
    //   return view ('home', compact('farms'));
    }
}

