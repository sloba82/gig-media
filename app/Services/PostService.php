<?php
namespace App\Services;

use App\Models\Post;
use App\Services\AbstractService;

class PostService extends AbstractService {


    /**
     * __construct
     *
     * @param  mixed $model
     * @return void
     */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    /**
     * getResourceWithPagination
     *
     * @param  array $filters
     * @return mixed
     */
    public function getResourceWithPagination(array $filters)
    {
        if((isset($filters['with']) && $filters['with'] == 'comments') || isset($filters['comment'])) {
            $this->withRelation = 'comments';
        }

        $this->withRelationFilter = isset($filters['comment']) ? $filters['comment'] : '';
        return $this->modelWithPagination($filters);
    }

}
