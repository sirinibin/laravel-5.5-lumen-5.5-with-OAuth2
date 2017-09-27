<?php

namespace App\Http\Controllers;

use App\Employees;
use Illuminate\Http\Request;


class EmployeesController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth',['except'=>['index','view']]);

    }


    public function create(Request $request)
    {
        $this->validate($request, Employees::rules());

        $model = Employees::create($request->all());

        $response = [
            'status' => 1,
            'data' => $model
        ];

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);

    }

    public function view($id)
    {
        $model = $this->findModel($id);
        return response()->json($model, 200, [], JSON_PRETTY_PRINT);
    }

    public function update(Request $request, $id)
    {

        $model = $this->findModel($id);
        $this->validate($request, Employees::rules($id));

        $model->name = $request->input('name');
        $model->email = $request->input('email');
        $model->save();

        return response()->json($model, 200, [], JSON_PRETTY_PRINT);
    }

    public function deleteRecord($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        $response = [
            'status' => 1,
            'data' => $model,
            'message'=>'Removed successfully.'
        ];

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function index(Request $request)
    {
        $response = Employees::search($request);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);

    }

    public function findModel($id)
    {

        $model = Employees::find($id);
        if (!$model) {
            $response = [
                'status' => 0,
                'errors' => "Invalid Record"
            ];

            response()->json($response, 400, [], JSON_PRETTY_PRINT)->send();
            die;
        }
        return $model;
    }

    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {

        $validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            $response = [
                'status' => 0,
                'errors' => $validator->errors()
            ];

            response()->json($response, 400, [], JSON_PRETTY_PRINT)->send();
            die();

        }

        return true;
    }
}

?>