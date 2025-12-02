<?php

namespace App\Http\Controllers;

use App\AttributeValidator;
use App\DTOs\CriteriaDTO;
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

    public function store(AddCriteriaRequest $request)
    {

            $dto = new CriteriaDTO($request->only(['name','description']));

            $this->ValidateWithAttribute($dto);

            dd($dto);

    }
}
