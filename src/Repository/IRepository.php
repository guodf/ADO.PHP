<?php

namespace Repository;

/**
 * 仓储功能接口
 */
interface  IRepository
{
    function add($obj);

    function update($obj);

    function where($obj);

    function frist($obj);

    function del($id);

    function count($obj);
}