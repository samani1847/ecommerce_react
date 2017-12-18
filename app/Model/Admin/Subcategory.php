<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use SoftDeletes;
    
    protected $table = 'subcategory';
    protected $fillable = ['name', 'status', 'category_id'];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo('App\Model\Admin\Category',  'category_id');
    }

    public static function getDatatable($requestArray)
    {

        $sort_by = $requestArray['order']['column'];
        $sort_dir = $requestArray['order']['dir'];
        $keyword = $requestArray['search']['value'];
        $start = $requestArray['start'];
        $length = $requestArray['length'];
        
        if($keyword){
            $query = static::where('category.name', 'like',"%$keyword%");
        }
        
        // id
        if($sort_by == 0){
            $query = $query->orderBy('id', $sort_dir);
        
        } elseif($sort_by == 1){ //name
            $query = $query->orderBy('name', $sort_dir);
        
        } elseif($sort_by == 2){//status
            $query = $query->orderBy('status', $sort_dir);

        } 

        $query = $query->offset($start)->limit($length);

        return $query->get();        

    }
}
