<?php

namespace App\Http\Controllers;

use App\AttributeValidator;
use App\Http\Requests\AddCriteriaRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CriteriaController extends Controller
{
    use AttributeValidator;

    public function index()
    {
        return \view('reflection.index');
    }

    public function store(AddCriteriaRequest $request){

        try {
            $this->ValidateWithAttribute($request);

            return response()->json(["message" => "Kriteria berhasil ditambahkan!"]);
        }catch (\Exception $e){
            return response()->json(["error" => $e->getMessage()], 422);
        }
    }
}
