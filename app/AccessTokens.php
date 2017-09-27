<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessTokens extends Model
{
    protected $fillable = ['token','auth_code', 'expires_at','user_id','app_id'];
    static public function rules($id=NULL)
    {
        return [
            'user_id' => 'required',
            'token' => 'required|unique:access_tokens,token,'.$id,
            'auth_code' => 'required',
        ];
    }
}
?>