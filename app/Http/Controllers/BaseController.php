<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    protected Model $model;

    public function index(Request $request)
    {
        $filters = $request->all();

        $query = $this->model::query();

        if (method_exists($this->model, 'scopeFilter')) {
            $query->filter($filters);
        }

        if ($request->has('sort_by')) {
            $sortBy = $request->get('sort_by');
            $sortDir = $request->get('sort_dir', 'asc');
            $query->orderBy($sortBy, $sortDir);
        }

        $data = $query->paginate($request->get('per_page', 10));

        return response()->json($data);
    }

    public function show($id)
    {
        $data = $this->model::findOrFail($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $this->model::create($request->all());
        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $this->model::findOrFail($id);
        $data->update($request->all());

        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = $this->model::findOrFail($id);
        $data->delete();

        return response()->json(null, 204);
    }
}
