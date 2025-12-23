<?php

namespace App\Controllers;

class ScanController extends BaseController
{
    public function index()
    {
        return view('pindai');
    }

    public function proses()
    {
        return view('proses');
    }

        public function manual()
    {
        return view('manual');
    }

    public function hasilManual()
{
    $session = session();
    $barcode = $this->request->getGet('barcode');

    // Validasi barcode: minimal 8 digit dan hanya angka
    if (!$barcode || !preg_match('/^\d{8,}$/', $barcode)) {
        return redirect()->to('/pindai')->with('error', 'Barcode tidak valid atau tidak diberikan.');
    }

    $url = "https://world.openfoodfacts.org/api/v0/product/$barcode.json";
    $json = file_get_contents($url);
    $result = json_decode($json, true);

    // Validasi hasil dari API
    if (
        isset($result['status']) && $result['status'] === 1 &&
        isset($result['product']) &&
        !empty($result['product']['product_name'])
    ) {
        $product = $result['product'];
        $product_name = $product['product_name'];
        $sugars = $product['nutriments']['sugars'] ?? 0;
        $calories = $product['nutriments']['energy_kcal'] ?? 0;

        // Simpan ke database kalau user login
        $user_id = $session->get('user_id');
        if ($user_id) {
            $db = \Config\Database::connect();
            $builder = $db->table('scan_history');
            $builder->insert([
                'user_id' => $user_id,
                'barcode' => $barcode,
                'product_name' => $product_name,
                'sugars' => $sugars,
                'calories' => $calories,
                'scanned_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $data = [
            'product_name' => $product_name,
            'sugars' => $sugars,
            'calories' => $calories,
            'found' => true,
        ];
    } else {
        $data = [
            'product_name' => 'Produk tidak ditemukan atau barcode tidak valid.',
            'sugars' => 'N/A',
            'calories' => 'N/A',
            'found' => false,
        ];
    }

    return view('hasilManual', $data);
}


    

public function history()
    {
        $session = session();
        $user_id = $session->get('user_id'); // pastikan session login

        $db = \Config\Database::connect();
        $builder = $db->table('scan_history');

        // Hapus data jika ada request POST
        if ($this->request->getMethod() === 'post' && $this->request->getPost('id')) {
            $id = $this->request->getPost('id');

            // Hapus data sesuai user & id
            $builder->where('id', $id)->where('user_id', $user_id)->delete();

            return redirect()->to('/history');
        }

        // Ambil data history user
        $history = $builder->where('user_id', $user_id)->orderBy('scanned_at', 'DESC')->get()->getResultArray();
        return view('history', ['history' => $history]);
    }

    public function delete($id)
{
    $session = session();
    $user_id = $session->get('user_id');

    $db = \Config\Database::connect();
    $builder = $db->table('scan_history');

    // Cek apakah data milik user yang sedang login
    $deleted = $builder
        ->where('id', $id)
        ->where('user_id', $user_id)
        ->delete();

    if ($deleted) {
        return redirect()->to('/history')->with('success', 'Data berhasil dihapus.');
    } else {
        return redirect()->to('/history')->with('error', 'Data gagal dihapus atau tidak ditemukan.');
    }
}


}
