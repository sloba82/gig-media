<?php

namespace App\Services;

use App\Models\Comment;
use App\Services\AbstractService;

class CommentService extends AbstractService
{

    private $model;

    /**
     * __construct
     *
     * @param  mixed $model
     * @return void
     */
    public function __construct(Comment $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * getResourceWithPagination
     *
     * @param  array $filters
     * @return mixed
     */
    public function getResourceWithPagination(array $filters): mixed
    {
        $this->withRelation = isset($filters['with']) ? $filters['with'] : '';
        return $this->modelWithPagination($filters);
    }

    public function create(array $input)
    {
        $text = $input['content'];
        $this->model::create([
            'post_id' => $input['post_id'],
            'content' => $text,
            'abbreviation' => $text,
        ]);

        return $this->model->id;
    }
}
