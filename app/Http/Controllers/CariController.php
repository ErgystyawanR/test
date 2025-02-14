<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CariController extends Controller
{
    protected $apiUrl = 'https://bit.ly/48ejMhW';

    private function fetchData()
    {
        try {
            $response = Http::timeout(10)->get($this->apiUrl);

            if ($response->failed()) {
                return [];
            }

            $data = $response->json();

            if (!isset($data['DATA']) || !is_string($data['DATA'])) {
                return [];
            }

            $rows = explode("\n", trim($data['DATA']));
            $result = [];

            foreach ($rows as $row) {
                if (!str_contains($row, '|')) {
                    continue;
                }

                $columns = explode('|', $row);
                if (count($columns) < 3) {
                    continue;
                }

                $result[] = [
                    'nama' => trim($columns[0]),
                    'nim'  => trim($columns[1]),
                    'ymd'  => trim($columns[2]),
                ];
            }

            return $result;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function cariNama(Request $request)
    {
        $nama = trim($request->query('nama', 'Turner Mia'));

        $data = $this->fetchData();

        $filteredData = array_filter($data, function ($item) use ($nama) {
            return stripos(strtolower(trim($item['nama'])), strtolower(trim($nama))) !== false;
        });

        return response()->json([
            'RC' => 200,
            'RCM' => 'OK',
            'DATA' => array_values($filteredData)
        ]);
    }

    public function cariNim(Request $request)
    {
        $nim = trim($request->query('nim', '9352078461'));

        $data = $this->fetchData();

        $filteredData = array_filter($data, function ($item) use ($nim) {
            return stripos(trim($item['nim']), trim($nim)) !== false;
        });

        return response()->json([
            'RC' => 200,
            'RCM' => 'OK',
            'DATA' => array_values($filteredData)
        ]);
    }

    public function cariYmd(Request $request)
    {
        $ymd = trim($request->query('ymd', '20230405'));

        $data = $this->fetchData();

        $filteredData = array_filter($data, function ($item) use ($ymd) {
            return stripos(trim($item['ymd']), trim($ymd)) !== false;
        });

        return response()->json([
            'RC' => 200,
            'RCM' => 'OK',
            'DATA' => array_values($filteredData)
        ]);
    }
}
