<?php
namespace App\Services;

use App\Models\Comment;
use App\Services\AbstractService;

class CommentService extends AbstractService {


    private $model;
    /**
     * __construct
     *
     * @param  mixed $model
     * @return void
     */
    public function __construct(Comment $model)
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
        $this->withRelation = isset($filters['with']) ? $filters['with'] : '';
        return $this->modelWithPagination($filters);
    }



}
