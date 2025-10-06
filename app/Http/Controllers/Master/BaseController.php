<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    protected $model;
    protected $viewPath;

    protected function sendResponse($result, $message = 'Success')
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $result
        ]);
    }

    protected function sendError($error, $errorMessages = [], $code = 404)
    {
        return response()->json([
            'success' => false,
            'message' => $error,
            'data'    => $errorMessages
        ], $code);
    }

    public function index(Request $request)
    {
        $query = ($this->model)::query();

        // Filter
        foreach ($request->query() as $key => $value) {
            if (in_array($key, ['search', 'sort', 'limit', 'page'])) continue;
            $query->where($key, 'LIKE', "%$value%");
        }

        // Search global
        if ($request->has('search')) {
            $search = $request->get('search');
            $columns = Schema::getColumnListing((new $this->model)->getTable());
            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $col) {
                    $q->orWhere($col, 'LIKE', "%$search%");
                }
            });
        }

        // Sorting
        if ($request->has('sort')) {
            [$col, $dir] = explode(',', $request->get('sort')) + [null, 'asc'];
            $query->orderBy($col ?? 'created_at', $dir);
        }

        // Pagination
        $limit = $request->get('limit', 20);
        $data = $query->paginate($limit);

        return $this->sendResponse($data, 'Data retrieved successfully');
    }

    public function store(Request $request)
    {
        $modelInstance = new $this->model;

        // Validasi required berdasarkan $fillable
        $validator = Validator::make($request->all(), $this->getValidationRules());
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors(), 422);
        }

        $data = $request->only($modelInstance->getFillable());
        $item = $modelInstance::create($data);

        return $this->sendResponse($item, 'Created successfully');
    }

    public function show($id)
    {
        $item = ($this->model)::find($id);
        if (!$item) {
            return $this->sendError('Record not found', [], 404);
        }
        return $this->sendResponse($item, 'Data retrieved successfully');
    }

    public function update(Request $request, $id)
    {
        $item = ($this->model)::find($id);
        if (!$item) {
            return $this->sendError('Record not found', [], 404);
        }

        // Validasi required berdasarkan $fillable
        $validator = Validator::make($request->all(), $this->getValidationRules());
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors(), 422);
        }

        $data = $request->only($item->getFillable());
        $item->update($data);

        return $this->sendResponse($item, 'Updated successfully');
    }

    public function destroy($id)
    {
        $item = ($this->model)::find($id);
        if (!$item) {
            return $this->sendError('Record not found', [], 404);
        }

        $item->delete();
        return $this->sendResponse([], 'Deleted successfully');
    }

    protected function getValidationRules()
    {
        $modelInstance = new $this->model;
        $rules = [];
        foreach ($modelInstance->getFillable() as $field) {
            $rules[$field] = 'required';
        }
        return $rules;
    }
}
