<?php

/**
 * 仓储抽象基类
 */
abstract class AbstractDBRepository implements IRepository
{
    abstract function add($obj);

    abstract function update($obj);

    abstract function where($obj);

    abstract function frist($obj);

    abstract function del($id);

    abstract function count($obj);
}