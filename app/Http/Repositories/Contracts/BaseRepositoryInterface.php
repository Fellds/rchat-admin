<?php

namespace App\Http\Repositories\Contracts;


use Illuminate\Database\Eloquent\Model;

/**
* Interface BaseRepositoryInterface
* @package App\Http\Repositories
*/
interface BaseRepositoryInterface
{
    
   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;


   /**
    * @param $id
    * @return Array
    */
    public function all();

    /**
    * @param $id
    * @return Boolean
    */
    public function destroy($id);

    function findInList($ids);

}