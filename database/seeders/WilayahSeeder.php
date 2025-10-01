<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Galesong
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Boddia'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Bontoloe'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Bontomangape'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Campagaya'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Galesong Baru'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Galesong Kota'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Galesong Timur'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Kalenna Bontongape'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Kalukuang'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Kampung Beru'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Mappakalompo'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Pa’lalakkang'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Pa’rasangang Beru'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Parambambe'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Parangmata'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Pattinoang'],
            ['nama_kecamatan' => 'Galesong', 'nama_desa' => 'Tarembang'],
            // Galesong Selatan
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Barangmamase'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Bentang'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Bonto Kanang'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Bontokassi'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Bontomarannu'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Kadatong'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Kale Bentang'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Kalukubodo'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Kanaeng'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Mangindara'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Popo'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Sawakong'],
            ['nama_kecamatan' => 'Galesong Selatan', 'nama_desa' => 'Tarowang'],
            // Galesong Utara
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Bontolebang'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Aeng Batu Batu'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Aeng Towa'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Biring Kassi'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Bontokaddopepe'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Bontolanra'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Bontosunggu'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Kaballokang Pakkabba'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Maccini Sombala'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Pakkabba'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Sampulungan'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Sawatung Beba'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Tamalate'],
            ['nama_kecamatan' => 'Galesong Utara', 'nama_desa' => 'Tamasaju'],
            // Kepulauan Tanakeke
            ['nama_kecamatan' => 'Kepulauan Tanakeke', 'nama_desa' => 'Balangdatu'],
            ['nama_kecamatan' => 'Kepulauan Tanakeke', 'nama_desa' => 'Maccini Baji'],
            ['nama_kecamatan' => 'Kepulauan Tanakeke', 'nama_desa' => 'Mattiro Baji'],
            ['nama_kecamatan' => 'Kepulauan Tanakeke', 'nama_desa' => 'Minasa Baji'],
            ['nama_kecamatan' => 'Kepulauan Tanakeke', 'nama_desa' => 'Rewataya'],
            ['nama_kecamatan' => 'Kepulauan Tanakeke', 'nama_desa' => 'Tompotana'],
            // Laikang
            ['nama_kecamatan' => 'Laikang', 'nama_desa' => 'Bontoparang'],
            ['nama_kecamatan' => 'Laikang', 'nama_desa' => 'Cikoang'],
            ['nama_kecamatan' => 'Laikang', 'nama_desa' => 'Laikang'],
            ['nama_kecamatan' => 'Laikang', 'nama_desa' => 'Panyangkalang'],
            ['nama_kecamatan' => 'Laikang', 'nama_desa' => 'Pattopakang'],
            ['nama_kecamatan' => 'Laikang', 'nama_desa' => 'Punaga'],
            // Mangarabombang
            ['nama_kecamatan' => 'Mangarabombang', 'nama_desa' => 'Mangadu'],
            ['nama_kecamatan' => 'Mangarabombang', 'nama_desa' => 'Banggae'],
            ['nama_kecamatan' => 'Mangarabombang', 'nama_desa' => 'Bontomanai'],
            ['nama_kecamatan' => 'Mangarabombang', 'nama_desa' => 'Lakatong'],
            ['nama_kecamatan' => 'Mangarabombang', 'nama_desa' => 'Lengkese'],
            ['nama_kecamatan' => 'Mangarabombang', 'nama_desa' => 'Topejawa'],
            // Mappakasunggu
            ['nama_kecamatan' => 'Mappakasunggu', 'nama_desa' => 'Takalar'],
            ['nama_kecamatan' => 'Mappakasunggu', 'nama_desa' => 'Pa’batangan'],
            ['nama_kecamatan' => 'Mappakasunggu', 'nama_desa' => 'Patani'],
            ['nama_kecamatan' => 'Mappakasunggu', 'nama_desa' => 'Soreang'],
            // Pattallassang
            ['nama_kecamatan' => 'Pattallassang', 'nama_desa' => 'Bajeng'],
            ['nama_kecamatan' => 'Pattallassang', 'nama_desa' => 'Kalabbirang'],
            ['nama_kecamatan' => 'Pattallassang', 'nama_desa' => 'Mardekaya'],
            ['nama_kecamatan' => 'Pattallassang', 'nama_desa' => 'Pallantikang'],
            ['nama_kecamatan' => 'Pattallassang', 'nama_desa' => 'Pappa'],
            ['nama_kecamatan' => 'Pattallassang', 'nama_desa' => 'Pattallassang'],
            ['nama_kecamatan' => 'Pattallassang', 'nama_desa' => 'Sabintang'],
            ['nama_kecamatan' => 'Pattallassang', 'nama_desa' => 'Salaka'],
            ['nama_kecamatan' => 'Pattallassang', 'nama_desa' => 'Sombalabella'],
            // Polongbangkeng Selatan
            ['nama_kecamatan' => 'Polongbangkeng Selatan', 'nama_desa' => 'Bonto Kadatto'],
            ['nama_kecamatan' => 'Polongbangkeng Selatan', 'nama_desa' => 'Bulukunyi'],
            ['nama_kecamatan' => 'Polongbangkeng Selatan', 'nama_desa' => 'Canrego'],
            ['nama_kecamatan' => 'Polongbangkeng Selatan', 'nama_desa' => 'Pa’bundukang'],
            ['nama_kecamatan' => 'Polongbangkeng Selatan', 'nama_desa' => 'Pattene'],
            ['nama_kecamatan' => 'Polongbangkeng Selatan', 'nama_desa' => 'Rajaya'],
            ['nama_kecamatan' => 'Polongbangkeng Selatan', 'nama_desa' => 'Cakura'],
            ['nama_kecamatan' => 'Polongbangkeng Selatan', 'nama_desa' => 'Kale Lantang'],
            ['nama_kecamatan' => 'Polongbangkeng Selatan', 'nama_desa' => 'Lantang'],
            ['nama_kecamatan' => 'Polongbangkeng Selatan', 'nama_desa' => 'Moncongkomba'],
            ['nama_kecamatan' => 'Polongbangkeng Selatan', 'nama_desa' => 'Su’rulangi'],
            // Polongbangkeng Timur
            ['nama_kecamatan' => 'Polongbangkeng Timur', 'nama_desa' => 'Balangtanaya'],
            ['nama_kecamatan' => 'Polongbangkeng Timur', 'nama_desa' => 'Barugaya'],
            ['nama_kecamatan' => 'Polongbangkeng Timur', 'nama_desa' => 'Kale Ko’mara'],
            ['nama_kecamatan' => 'Polongbangkeng Timur', 'nama_desa' => 'Kampung Beru'],
            ['nama_kecamatan' => 'Polongbangkeng Timur', 'nama_desa' => 'Ko’mara'],
            ['nama_kecamatan' => 'Polongbangkeng Timur', 'nama_desa' => 'Massamaturu'],
            ['nama_kecamatan' => 'Polongbangkeng Timur', 'nama_desa' => 'Parang Baddo'],
            ['nama_kecamatan' => 'Polongbangkeng Timur', 'nama_desa' => 'Timbuseng'],
            // Polongbangkeng Utara
            ['nama_kecamatan' => 'Polongbangkeng Utara', 'nama_desa' => 'Lassang'],
            ['nama_kecamatan' => 'Polongbangkeng Utara', 'nama_desa' => 'Lassang Barat'],
            ['nama_kecamatan' => 'Polongbangkeng Utara', 'nama_desa' => 'Pa’rappunganta'],
            ['nama_kecamatan' => 'Polongbangkeng Utara', 'nama_desa' => 'Towata'],
            // Sanrobone
            ['nama_kecamatan' => 'Sanrobone', 'nama_desa' => 'Banyuanyara'],
            ['nama_kecamatan' => 'Sanrobone', 'nama_desa' => 'Laguruda'],
            ['nama_kecamatan' => 'Sanrobone', 'nama_desa' => 'Paddinging'],
            ['nama_kecamatan' => 'Sanrobone', 'nama_desa' => 'Sanrobone'],
            ['nama_kecamatan' => 'Sanrobone', 'nama_desa' => 'Tonasa'],
            ['nama_kecamatan' => 'Sanrobone', 'nama_desa' => 'Ujung Baji'],
        ];

        foreach ($data as $item) {
            DB::table('wilayah')->insert([
                'nama_kabupaten' => 'Takalar',
                'nama_kecamatan' => $item['nama_kecamatan'],
                'nama_desa' => $item['nama_desa'],

            ]);
        }
    }
}
