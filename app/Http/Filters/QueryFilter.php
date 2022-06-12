<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class QueryFilter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var String
     */
    protected $delimiter = ',';

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $field => $value) {
            // $method = camel_case($field);
            if (method_exists($this, $field)) {
                call_user_func_array([$this, $field], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->query();
    }

    protected function paramToArray($param)
    {
        return explode($this->delimiter, $param);
    }
}
