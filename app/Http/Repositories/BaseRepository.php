<?php   

namespace App\Http\Repositories;   

use App\Http\Repositories\Contracts\BaseRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

class BaseRepository implements BaseRepositoryInterface 
{     
    /**      
     * @var Model      
     */     
     protected $model;       

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }
 
    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
    * @return Array
    */
    public function all()
    {
        return $this->model->all();
    }

    /**
    * @return Boolean
    */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function findInList($ids)
    {
        return $this->model->whereIn("id" ,$ids)->get();
    }
    
}