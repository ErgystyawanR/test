<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CariController extends Controller
{
    protected $apiUrl = 'https://bit.ly/48ejMhW';

    private function fetchData()
    {
        $response = Http::get($this->apiUrl);

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
            $columns = explode('|', $row);
            if (count($columns) >= 3) {
                $result[] = [
                    'nama' => trim($columns[0]),
                    'nim' => trim($columns[1]),
                    'ymd' => trim($columns[2]),
                ];
            }
        }

        return $result;
    }

    public function cariNama(Request $request)
    {
        $nama = $request->query('nama', 'Turner Mia');
        $data = $this->fetchData();

        $filteredData = array_filter($data, function ($item) use ($nama) {
            return stripos($item['nama'], $nama) !== false;
        });

        return response()->json(['RC' => 200, 'RCM' => 'OK', 'DATA' => array_values($filteredData)]);
    }

    public function cariNim(Request $request)
    {
        $nim = $request->query('nim', '9352078461');
        $data = $this->fetchData();

        $filteredData = array_filter($data, function ($item) use ($nim) {
            return stripos($item['nim'], $nim) !== false;
        });

        return response()->json(['RC' => 200, 'RCM' => 'OK', 'DATA' => array_values($filteredData)]);
    }

    public function cariYmd(Request $request)
    {
        $ymd = $request->query('ymd', '20230405');
        $data = $this->fetchData();

        $filteredData = array_filter($data, function ($item) use ($ymd) {
            return stripos($item['ymd'], $ymd) !== false;
        });

        return response()->json(['RC' => 200, 'RCM' => 'OK', 'DATA' => array_values($filteredData)]);
    }
}
