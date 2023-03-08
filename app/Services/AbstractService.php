<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

abstract class AbstractService
{

    protected $withRelation;

    protected $withRelationFilter;

    private $model;

    /**
     * AbstractCrudService constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * modelWithPagination
     *
     * @param  array $filters
     * @return mixed
     */
    public function modelWithPagination(array $filters)
    {
        $limit = isset($filters['limit']) ? (int) $filters['limit'] : 10;
        $sortable = isset($filters['sort']) ?  $filters['sort'] : '';
        $direction = isset($filters['direction']) ?  $filters['direction'] : 'asc';

        $model = $this->model;
        $tableName = $model->getTable();
        $columns = Schema::getColumnListing($tableName);

        $tableFilters = [];
        if (isset($filters['id'])) {
            $tableFilters['id'] = (int) $filters['id'];
        } else {
            foreach ($columns as $column) {
                if (isset($filters[$column])) {
                    $tableFilters[] =  [$column, 'like', '%' . $filters[$column] . '%'];
                }
            }
        }

        $model = $this->model::where($tableFilters);

        if ($this->withRelation && !$this->withRelationFilter) {
             $model->with($this->withRelation);
            // $model->with($this->withRelation, function($query) {
            //     $query->query(DB:raw(' limit 10'));
            // });
        }

        if($this->withRelationFilter){
            $filter = $this->withRelationFilter;
            $model->whereHas($this->withRelation, function($query) use( $filter) {
                $query->where('content', 'like', '%'. $filter .'%');
            });
        }

        if (in_array($sortable, $columns)) {
             $model->orderBy($sortable, $direction);
        }

        return $model->paginate($limit);
    }
}
