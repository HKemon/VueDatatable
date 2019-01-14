<?php

namespace LaravelEnso\VueDatatable\app\Classes;

use LaravelEnso\Helpers\app\Classes\Obj;

class Fetcher
{
    private $class;
    private $request;
    private $builder;
    private $data;
    private $page = 0;

    public function __construct(string $class, array $request)
    {
        $this->builder = (new $class($request))
            ->fetcher();

        $this->request = new Obj($request);
    }

    public function name()
    {
        $this->request->get('name');
    }

    public function data()
    {
        return $this->data;
    }

    public function chunkSize()
    {
        return $this->data->count();
    }

    public function next()
    {
        $this->data = $this->builder
            ->fetch($this->page++);
    }

    public function valid()
    {
        return $this->data->isNotEmpty();
    }

    public function request()
    {
        return $this->request;
    }
}
