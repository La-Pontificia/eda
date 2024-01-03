<?php

namespace App\Http\Controllers;

use App\Models\Acceso;
use App\Models\Area;
use App\Models\Colaboradore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AreaController
 * @package App\Http\Controllers
 */
class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $areas = Area::paginate();
        $area = new Area();
        return view('area.index', compact('areas', 'area'))
            ->with('i', (request()->input('page', 1) - 1) * $areas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area = new Area();
        return view('area.create', compact('area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */









    public function store(Request $request)
    {
        // obtenemos el ultimo codigo de area
        $codeUltimate = Area::max('codigo');

        // creamos el nuevo codigo
        $numero = (int)substr($codeUltimate, 1) + 1;
        $newCode = 'A' . str_pad($numero, 3, '0', STR_PAD_LEFT);

        $validatedData = $request->validate(Area::$rules);

        // creamos el area
        $data = array_merge($validatedData, [
            'codigo' => $newCode,
        ]);

        Area::create($data);

        return redirect()->route('areas.index')
            ->with('success', 'Area created successfully.');
    }












    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = Area::find($id);

        return view('area.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::find($id);

        return view('area.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Area $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        request()->validate(Area::$rules);

        $area->update($request->all());

        return redirect()->route('areas.index')
            ->with('success', 'Area updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $area = Area::find($id)->delete();

        return redirect()->route('areas.index')
            ->with('success', 'Area deleted successfully');
    }
}
