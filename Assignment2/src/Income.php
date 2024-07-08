<?php

namespace ExpenseTracker;

class Income 
{
    private $amount;
    private $category;

    public function __construct($amount, $category) 
    {
        $this->amount = $amount;
        $this->category = $category;
    }

    public function getAmount()
     {
        return $this->amount;
    }

    public function getCategory() 
    {
        return $this->category;
    }

    public function __toString() 
    {
        return "Income: {$this->amount}, Category: {$this->category}";
    }
}
?>
