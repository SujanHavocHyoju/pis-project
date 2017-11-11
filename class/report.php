<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 11/7/2017
 * Time: 9:13 PM
 */

class Report
{
    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getActivityName()
    {
        return $this->activityName;
    }

    /**
     * @param mixed $activityName
     */
    public function setActivityName($activityName)
    {
        $this->activityName = $activityName;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return mixed
     */
    public function getYearlyAllocCost()
    {
        return $this->yearlyAllocCost;
    }

    /**
     * @param mixed $yearlyAllocCost
     */
    public function setYearlyAllocCost($yearlyAllocCost)
    {
        $this->yearlyAllocCost = $yearlyAllocCost;
    }

    /**
     * @return mixed
     */
    public function getYearlyAllocQty()
    {
        return $this->yearlyAllocQty;
    }

    /**
     * @param mixed $yearlyAllocQty
     */
    public function setYearlyAllocQty($yearlyAllocQty)
    {
        $this->yearlyAllocQty = $yearlyAllocQty;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getYearlyAllocBudget()
    {
        return $this->yearlyAllocBudget;
    }

    /**
     * @param mixed $yearlyAllocBudget
     */
    public function setYearlyAllocBudget($yearlyAllocBudget)
    {
        $this->yearlyAllocBudget = $yearlyAllocBudget;
    }

    /**
     * @return mixed
     */
    public function getYearlyAllocProgressQtyExp()
    {
        return $this->yearlyAllocProgressQtyExp;
    }

    /**
     * @param mixed $yearlyAllocProgressQtyExp
     */
    public function setYearlyAllocProgressQtyExp($yearlyAllocProgressQtyExp)
    {
        $this->yearlyAllocProgressQtyExp = $yearlyAllocProgressQtyExp;
    }

    /**
     * @return mixed
     */
    public function getYearlyAllocProgressQtyExpPer()
    {
        return $this->yearlyAllocProgressQtyExpPer;
    }

    /**
     * @param mixed $yearlyAllocProgressQtyExpPer
     */
    public function setYearlyAllocProgressQtyExpPer($yearlyAllocProgressQtyExpPer)
    {
        $this->yearlyAllocProgressQtyExpPer = $yearlyAllocProgressQtyExpPer;
    }

    /**
     * @return mixed
     */
    public function getYearlyProgressExp()
    {
        return $this->yearlyProgressExp;
    }

    /**
     * @param mixed $yearlyProgressExp
     */
    public function setYearlyProgressExp($yearlyProgressExp)
    {
        $this->yearlyProgressExp = $yearlyProgressExp;
    }

    /**
     * @return mixed
     */
    public function getYearlyProgressExpPer()
    {
        return $this->yearlyProgressExpPer;
    }

    /**
     * @param mixed $yearlyProgressExpPer
     */
    public function setYearlyProgressExpPer($yearlyProgressExpPer)
    {
        $this->yearlyProgressExpPer = $yearlyProgressExpPer;
    }

    /**
     * @return mixed
     */
    public function getWeighted()
    {
        return $this->weighted;
    }

    /**
     * @param mixed $weighted
     */
    public function setWeighted($weighted)
    {
        $this->weighted = $weighted;
    }

    /**
     * @return mixed
     */
    public function getCurrentQtrAllocQty()
    {
        return $this->currentQtrAllocQty;
    }

    /**
     * @param mixed $currentQtrAllocQty
     */
    public function setCurrentQtrAllocQty($currentQtrAllocQty)
    {
        $this->currentQtrAllocQty = $currentQtrAllocQty;
    }

    /**
     * @return mixed
     */
    public function getCurrentQtrAllocBudget()
    {
        return $this->currentQtrAllocBudget;
    }

    /**
     * @param mixed $currentQtrAllocBudget
     */
    public function setCurrentQtrAllocBudget($currentQtrAllocBudget)
    {
        $this->currentQtrAllocBudget = $currentQtrAllocBudget;
    }

    /**
     * @return mixed
     */
    public function getCurrentAllocProgressQtyExp()
    {
        return $this->currentAllocProgressQtyExp;
    }

    /**
     * @param mixed $currentAllocProgressQtyExp
     */
    public function setCurrentAllocProgressQtyExp($currentAllocProgressQtyExp)
    {
        $this->currentAllocProgressQtyExp = $currentAllocProgressQtyExp;
    }

    /**
     * @return mixed
     */
    public function getCurrentQtrProgressExp()
    {
        return $this->currentQtrProgressExp;
    }

    /**
     * @param mixed $currentQtrProgressExp
     */
    public function setCurrentQtrProgressExp($currentQtrProgressExp)
    {
        $this->currentQtrProgressExp = $currentQtrProgressExp;
    }

    /**
     * @return mixed
     */
    public function getCurrentQtrProgressExpPer()
    {
        return $this->currentQtrProgressExpPer;
    }

    /**
     * @param mixed $currentQtrProgressExpPer
     */
    public function setCurrentQtrProgressExpPer($currentQtrProgressExpPer)
    {
        $this->currentQtrProgressExpPer = $currentQtrProgressExpPer;
    }
    public $code;
    public $activityName;
    public $unit="";
    public $yearlyAllocCost;
    public $yearlyAllocQty;
    public $weight=0;
    public $yearlyAllocBudget;

    public $yearlyAllocProgressQtyExp;
    public $yearlyAllocProgressQtyExpPer;
    public $yearlyProgressExp;
    public $yearlyProgressExpPer;

    public $weighted=0;

    public $currentQtrAllocQty;
    public $currentQtrAllocBudget;
    public $currentAllocProgressQtyExp;
    public $currentQtrProgressExp;
    public $currentQtrProgressExpPer;

    /**
     * Report constructor.
     * @param $code
     * @param $activityName
     * @param string $unit
     * @param $yearlyAllocCost
     * @param $yearlyAllocQty
     * @param $weight
     * @param $yearlyAllocBudget
     * @param $yearlyAllocProgressQtyExp
     * @param $yearlyAllocProgressQtyExpPer
     * @param $yearlyProgressExp
     * @param $yearlyProgressExpPer
     * @param $weighted
     * @param $currentQtrAllocQty
     * @param $currentQtrAllocBudget
     * @param $currentAllocProgressQtyExp
     * @param $currentQtrProgressExp
     * @param $currentQtrProgressExpPer
     */
    // public function __construct($code, $activityName, $unit, $yearlyAllocCost, $yearlyAllocQty, $weight, $yearlyAllocBudget, $yearlyAllocProgressQtyExp, $yearlyAllocProgressQtyExpPer, $yearlyProgressExp, $yearlyProgressExpPer, $weighted, $currentQtrAllocQty, $currentQtrAllocBudget, $currentAllocProgressQtyExp, $currentQtrProgressExp, $currentQtrProgressExpPer)
    // {
    //     $this->code = $code;
    //     $this->activityName = $activityName;
    //     $this->unit = $unit;
    //     $this->yearlyAllocCost = $yearlyAllocCost;
    //     $this->yearlyAllocQty = $yearlyAllocQty;
    //     $this->weight = $weight;
    //     $this->yearlyAllocBudget = $yearlyAllocBudget;
    //     $this->yearlyAllocProgressQtyExp = $yearlyAllocProgressQtyExp;
    //     $this->yearlyAllocProgressQtyExpPer = $yearlyAllocProgressQtyExpPer;
    //     $this->yearlyProgressExp = $yearlyProgressExp;
    //     $this->yearlyProgressExpPer = $yearlyProgressExpPer;
    //     $this->weighted = $weighted;
    //     $this->currentQtrAllocQty = $currentQtrAllocQty;
    //     $this->currentQtrAllocBudget = $currentQtrAllocBudget;
    //     $this->currentAllocProgressQtyExp = $currentAllocProgressQtyExp;
    //     $this->currentQtrProgressExp = $currentQtrProgressExp;
    //     $this->currentQtrProgressExpPer = $currentQtrProgressExpPer;
    // }
    // public function __construct(){

    // }

}