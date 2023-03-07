<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

abstract class AbstractService
{

    protected $model;

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

        if (isset($filters['with'])) {
             $model->with($filters['with']);
        }

        if (in_array($sortable, $columns)) {
             $model->orderBy($sortable, $direction);
        }

        return $model->paginate($limit);
    }
}
