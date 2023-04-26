<?php

namespace App\Imports;

use App\Models\Balita;
use App\Models\DataGuru;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Propinsi;
use App\Models\Puskesmas;
use App\Models\Stunting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Validators\Failure;

class ExcelImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithUpserts
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        if ($row['prov'] != null) {

            $id_balita = $this->getBalita($row['nik']);
            // $id_kelurahan = $this->getKelurahan($row['desa_kel']);
            // dd($id_kelurahan);
            $exp = explode('-', $row['usia_saat_ukur']);
            // dd([
            //     'id_balita' => $id_balita,
            //     'tahun' => (int)$exp[0],
            //     'bulan' => (int)$exp[1],
            //     'hari' => (int)$exp[2],
            //     'tgl_pengukuran' => $row['tanggal_pengukuran'],
            //     'berat' => trim($row['berat']),
            //     'tinggi' => trim($row['tinggi']),
            //     'lila' => $row['lila'],
            //     'bb_per_u' => $row['bb_u'],
            //     'zs_bb_per_u' => $row['zs_bb_u'],
            //     'tb_per_u' => $row['tb_u'],
            //     'zs_tb_per_u' => $row['zs_tb_u'],
            //     'bb_per_tb' => $row['bb_tb'],
            //     'zs_bb_per_tb' => $row['zs_bb_tb'],
            //     'naik_berat_badan' => $row['naik_berat_badan'],
            //     'pmt_diterima' => $row['pmt_diterima_kg'],
            //     'jml_vit_a' => $row['jml_vit_a'],
            //     'kpsp' => $row['kpsp'],
            //     'kia' => $row['kia']
            // ]);
            if ($id_balita != null) {
                return new Stunting([
                    'id_balita' => $id_balita,
                    'tahun' => (int)$exp[0],
                    'bulan' => (int)$exp[1],
                    'hari' => (int)$exp[2],
                    'tgl_pengukuran' => $row['tanggal_pengukuran'],
                    'berat' => trim($row['berat']),
                    'tinggi' => trim($row['tinggi']),
                    'lila' => $row['lila'],
                    'bb_per_u' => $row['bb_u'],
                    'zs_bb_per_u' => $row['zs_bb_u'],
                    'tb_per_u' => $row['tb_u'],
                    'zs_tb_per_u' => $row['zs_tb_u'],
                    'bb_per_tb' => $row['bb_tb'],
                    'zs_bb_per_tb' => $row['zs_bb_tb'],
                    'naik_berat_badan' => $row['naik_berat_badan'],
                    'pmt_diterima' => $row['pmt_diterima_kg'],
                    'jml_vit_a' => $row['jml_vit_a'],
                    'kpsp' => $row['kpsp'],
                    'kia' => $row['kia']
                ]);

                if ($this->getBalita(trim($row['nik'])) == null) {
                    // dd('sini');

                    // dd([
                    //     'id_kelurahan' => $id_kelurahan,
                    //     'id_puskesmas' => $id_puskesmas,
                    //     'posyandu' => $row['posyandu'],
                    //     'rt' => $row['rt'],
                    //     'rw' => $row['rw'],
                    //     'alamat' => $row['alamat'],
                    //     'nik' => trim($row['nik']),
                    //     'nama' => trim($row['nama']),
                    //     'jk' => $row['jk'],
                    //     'tgl_lahir' => $row['tgl_lahir'],
                    //     'bb_lahir' => $row['bb_lahir'],
                    //     'tb_lahir' => $row['tb_lahir'],
                    //     'nama_orang_tua' => $row['nama_ortu']
                    // ]);

                    // Balita::create([
                    //     'id_kelurahan' => $id_kelurahan,
                    //     'id_puskesmas' => $id_puskesmas,
                    //     'posyandu' => $row['posyandu'],
                    //     'rt' => $row['rt'],
                    //     'rw' => $row['rw'],
                    //     'alamat' => $row['alamat'],
                    //     'nik' => trim($row['nik']),
                    //     'nama' => trim($row['nama']),
                    //     'jk' => $row['jk'],
                    //     'tgl_lahir' => $row['tgl_lahir'],
                    //     'bb_lahir' => $row['bb_lahir'],
                    //     'tb_lahir' => $row['tb_lahir'],
                    //     'nama_orang_tua' => $row['nama_ortu']
                    // ]);

                    // return;

                    // return new Balita([
                    //     'id_kelurahan' => $id_kelurahan,
                    //     'id_puskesmas' => $id_puskesmas,
                    //     'posyandu' => $row['posyandu'],
                    //     'rt' => $row['rt'],
                    //     'rw' => $row['rw'],
                    //     'alamat' => $row['alamat'],
                    //     'nik' => trim($row['nik']),
                    //     'nama' => trim($row['nama']),
                    //     'jk' => $row['jk'],
                    //     'tgl_lahir' => $row['tgl_lahir'],
                    //     'bb_lahir' => $row['bb_lahir'],
                    //     'tb_lahir' => $row['tb_lahir'],
                    //     'nama_orang_tua' => $row['nama_ortu']
                    // ]);
                }
            }
        }
    }

    public function getPropinsi($nama)
    {
        $cek = Propinsi::where('nama', 'like', '%' . $nama . '%')->first();
        // dd($cek);
        if (!$cek) {
            return null;
        } else {
            return $cek->id;
        }
    }

    public function getKabupaten($nama)
    {
        $cek = Kabupaten::where('nama', 'like', '%' . $nama . '%')->first();
        // dd($cek);
        if (!$cek) {
            return null;
        } else {
            return $cek->id;
        }
    }
    public function getKecamatan($nama)
    {
        $cek = Kecamatan::where('nama', 'like', '%' . $nama . '%')->first();
        // dd($cek);
        if (!$cek) {
            return null;
        } else {
            return $cek->id;
        }
    }
    public function getKelurahan($nama)
    {
        $cek = Kelurahan::where('nama', 'like', '%' . $nama . '%')->first();
        // dd($cek);
        if (!$cek) {
            return null;
        } else {
            return $cek->id;
        }
    }
    public function getPuskesmas($nama)
    {
        $cek = Puskesmas::where('nama', 'like', '%' . $nama . '%')->first();
        // dd($cek);
        if (!$cek) {
            return null;
        } else {
            return $cek->id;
        }
    }
    public function getBalita($nama)
    {
        $cek = Balita::where('nik', $nama)->first();
        // dd($cek);
        if (!$cek) {
            return null;
        } else {
            return $cek->id;
        }
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }

    public function uniqueBy()
    {
        // return 'nama';
    }
}
