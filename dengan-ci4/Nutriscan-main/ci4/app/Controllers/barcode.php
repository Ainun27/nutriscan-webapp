<?php

namespace App\Controllers;
use App\Models\BarcodeModel;
use CodeIgniter\API\ResponseTrait;

class Barcode extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('kamera_view');
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getJSON(true);
            $session = session();
            $userId = $session->get('user_id');

            if (!$userId) {
                return $this->fail("User belum login.");
            }

            $model = new BarcodeModel();

            $saveData = [
                'user_id'      => $userId,
                'barcode'      => $data['barcode'],
                'product_name' => $data['product_name'],
                'sugars'       => $data['sugars'],
                'calories'     => $data['calories'],
            ];

            if ($id = $model->insert($saveData)) {
                return $this->respond(['success' => true, 'redirect' => base_url('hasilmanual/' . $id)]);
            } else {
                return $this->fail("Gagal menyimpan data.");
            }
        }

        return $this->fail("Permintaan tidak valid.");
    }
    public function hasilmanual($id)
    {
        $model = new BarcodeModel();
        $data = $model->find($id);

        if (!$data) {
            return redirect()->to('/barcode')->with('error', 'Data tidak ditemukan.');
        }

        return view('hasilbarcode', ['data' => $data]);
    }


}
    