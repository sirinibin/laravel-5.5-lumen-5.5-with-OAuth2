<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorizationCodes extends Model
{
    protected $fillable = ['code', 'expires_at','user_id','app_id'];
    static public function rules($id=NULL)
    {
        return [
            'user_id' => 'required',
            'code' => 'required|unique:authorization_codes,code,'.$id,
        ];
    }

    public static function isValid($code)
    {
        $model=AuthorizationCodes::where(['code'=>$code])->first();

        if(!$model||$model->expires_at<time())
        {
            return(false);
        }
        else
            return($model);
    }
}
?>