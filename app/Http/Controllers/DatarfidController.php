<?php

namespace App\Http\Controllers;

use App\Models\Datarfid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DatarfidController extends Controller
{
    public function index(Request $request)
    {
        // $data = DB::connection('mysql2')->select('select * from wp_posts ');
        return view('frontend.index');
    }

    public function pencarian_simpkbdb(Request $request)
    {
        $messages = [
            'kode_plat.required'         => 'Kode plat harus diisi.',
            'kode_plat.string'           => 'Kode plat harus berupa text.',
            'kode_plat.max'              => 'Kode plat maximal 3 huruf.',
            'nomor_plat.required'        => 'Nomor plat harus diisi.',
            'nomor_plat.numeric'         => 'Nomor plat harus format nomor.',
            'nomor_plat.min'             => 'Nomor plat minimal 1 huruf.',
            'kode_wilayah.required'      => 'Kode wilayah harus diisi.',
            'kode_wilayah.max'           => 'Kode wilayah maximal 3 huruf.',
            'captcha.required'           => 'Captcha harus diisi.',
            'captcha.captcha'            => 'Captcha salah coba lagi.'
        ];

        $validator = Validator::make($request->all(), [
            'kode_plat'         => 'required|string|max:3',
            'nomor_plat'        => 'required|numeric|min:1',
            'kode_wilayah'      => 'required|max:3',
            'captcha'           => 'required|captcha',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors'        => $validator->errors()
            ], 422);
        }

        try {
            $query                          = DB::table('datarfid')->select('nouji', 'nama', 'alamat', 'merek', 'tipe', 'jbb', 'nomesin', 'norangka', 'jenis');
            $kode_plat                      = $request->kode_plat;
            $nomor_plat                     = $request->nomor_plat;
            $kode_wilayah                   = $request->kode_wilayah;
            $nomor_registrasi_kendaraan     = $kode_plat . ' ' . $nomor_plat . ' ' . $kode_wilayah;


            if (request()->expectsJson()) {
                $query->when($request->kode_plat, function ($query) use ($nomor_registrasi_kendaraan) {
                    $query->where('datarfid.noregistrasikendaraan', 'LIKE', $nomor_registrasi_kendaraan . '%');
                });

                $data = $query->orderBy('nama', 'DESC')->limit(10)->get();

                return response()->json([
                    'status'    => 'success',
                    'data'      => $data,
                ], 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

        return view('frontend.index');
    }

    // RELOAD CAPTCHA
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
