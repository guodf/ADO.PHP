<?php

namespace UnitOfWork;

 /**
 * 工作单元抽象基类
 */
abstract class AbstractUnitOfWork
{
    private $_unitOfWorkItemArr=[];

    public function addWork($unitOfWorkItem)
    {
        $this->_unitOfWorkItemArr[]=$unitOfWorkItem;
    }

    abstract function begin();

    abstract function end($isOk);

    public function execWork()
    {
        try
        {
            $this->begin();
            foreach ($this->_unitOfWorkItemArr as $unitOfWorkItem) {
                $unitOfWorkItem->execWork();
            }
        }
        catch(\Exception $ex)
        {
            $this->end(false);
        }
        $this->end(true);
    }
}
