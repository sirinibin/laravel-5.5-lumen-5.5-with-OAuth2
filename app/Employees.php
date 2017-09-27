<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = ['name', 'email'];
    static public function rules($id=NULL)
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,'.$id,
        ];
    }

    static public function search($request)
    {

        $page = $request->input('page');
        $limit = $request->input('limit');
        $order = $request->input('order');

        $search = $request->input('search');

        if(isset($search)){
            $params=$search;
        }

        $limit = isset($limit) ? $limit : 10;
        $page = isset($page) ? $page : 1;


        $offset = ($page - 1) * $limit;

        $query = Employees::select(['id', 'name', 'email', 'created_at', 'updated_at'])
            ->limit($limit)
            ->offset($offset);

        if(isset($params['id'])) {
            $query->where(['id' => $params['id']]);
        }

        if(isset($params['created_at'])) {
            $query->where(['created_at' => $params['created_at']]);
        }
        if(isset($params['updated_at'])) {
            $query->where(['updated_at' => $params['updated_at']]);
        }
        if(isset($params['name'])) {
            $query->where('name','like',$params['name']);
        }
        if(isset($params['email'])){
            $query->where('email','like',$params['email']);
        }


        if(isset($order)){
            $query->orderBy($order);
        }

        $data=$query->get();


        return [
            'status'=>1,
            'data' => $data,
            'page' => (int)$page,
            'size' => $limit,
            'totalCount' => (int)$data->count()
        ];
    }
}
?>