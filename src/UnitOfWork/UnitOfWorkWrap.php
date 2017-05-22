<?php

namespace UnitOfWork;

/**
 * 工作单元项，工作单元组成原子
 */
class UnitOfWorkItem
{
    private $_instance;
    private $_cb;
    private $_args;
    private $_name;
    private $_argLen=0;
    private $_unitOfWorkItemArr=[];

    /**
     * Undocumented function
     *
     * @param string $name 工作单元项的名称
     * @param callable $cb 工作单元项需要执行的函数
     * @param array $args 工作单元项所需参数
     */
    function __construct()
    {
        $args=func_get_args();
        $name=$args[0];
        if(is_string($name)){
            $this->_name=array_shift($args);

        }
        $this->_instance=array_shift($args);
        $this->__constructNoName($args);
    }

    function __constructNoName($args){
        $cb=array_shift($args);
        // if(!is_callable($cb)){
        //     throw new Exception('$cb must be a callable', 1);
        // }
        $count=count($args);
        $this->_cb=$cb;
        $this->_args=$count>0? $args : [null];
    }

    /**
     * 执行工作单元
     *
     * @return void
     */
    function exec()
    {
        return call_user_func_array([$this->_instance,$this->_cb],$this->_args);
    }

    /**
     * 执行工作单元
     *
     * @param mixed $args
     * @return mixed
     */
    public function execWork($args=null)
    {
        $this->_args = $args==null? $this->_args : $args;

        foreach ($this->_unitOfWorkItemArr as $unitOfWorkItem) {
            $result = $unitOfWorkItem->execWork();
            if(!empty($unitOfWorkItem->_name)){
                if(array_key_exists($unitOfWorkItem->_name,$this->_args))
                {
                    $this->_args[$unitOfWorkItem->_name][]=$result;
                    continue;
                }
                $this->_args[$unitOfWorkItem->_name] =  $result;
                continue;
            }
            array_push($this->_args,$result);
        }
        return $this->exec();
    }

    /**
     * 该工作单元依赖其它的工作单元项
     *
     * @param UnitOfWorkItem|UnitofWorkItem[] $unitOfWorkItems
     * @return $this
     */
    public function dependWorkItem()
    {
        if( func_num_args () > 0){
            $args=func_get_args();
            foreach ($args as $unitOfWorkItem) {
                if(get_class($unitOfWorkItem)===get_class($this)){
                    $this->_unitOfWorkItemArr[]=$unitOfWorkItem;
                }
            }
        }
        return $this;
    }
}