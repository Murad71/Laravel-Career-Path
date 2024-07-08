<?php

namespace ExpenseTracker;

class Root {
    private $incomes = [];
    private $expenses = [];
    private $dataFile = 'data.json';

    public function __construct() 
    {
        $this->loadData();
    }

    public function addIncome($amount, $category) 
    {
        $income = new Income($amount, $category);
        $this->incomes[] = $income;
        $this->saveData();
    }

    public function addExpense($amount, $category) 
    {
        $expense = new Expense($amount, $category);
        $this->expenses[] = $expense;
        $this->saveData();
    }

    public function getIncomes() 
    {
        return $this->incomes;
    }

    public function getExpenses() 
    {
        return $this->expenses;
    }

    public function getTotalIncome() 
    {
        return array_reduce($this->incomes, function($total, $income) {
            return $total + $income->getAmount();
        }, 0);
    }

    public function getTotalExpense() 
    {
        return array_reduce($this->expenses, function($total, $expense) {
            return $total + $expense->getAmount();
        }, 0);
    }

    public function getSavings() 
    {
        return $this->getTotalIncome() - $this->getTotalExpense();
    }

    private function saveData() 
    {
        $data = [
            'incomes' => array_map(function($income) {
                return [
                    'amount' => $income->getAmount(),
                    'category' => $income->getCategory()
                ];
            }, $this->incomes),
            'expenses' => array_map(function($expense) {
                return [
                    'amount' => $expense->getAmount(),
                    'category' => $expense->getCategory()
                ];
            }, $this->expenses)
        ];

        file_put_contents($this->dataFile, json_encode($data));
    }

    private function loadData() 
    {
        if (file_exists($this->dataFile)) {
            $data = json_decode(file_get_contents($this->dataFile), true);
    
            if (!empty($data['incomes'])) {
                foreach ($data['incomes'] as $incomeData) {
                    $amount = isset($incomeData['amount']) ? $incomeData['amount'] : null;
                    $category = isset($incomeData['category']) ? $incomeData['category'] : null;
                    $this->incomes[] = new Income($amount, $category);
                }
            }
    
            if (!empty($data['expenses'])) {
                foreach ($data['expenses'] as $expenseData) {
                    $amount = isset($expenseData['amount']) ? $expenseData['amount'] : null;
                    $category = isset($expenseData['category']) ? $expenseData['category'] : null;
                    $this->expenses[] = new Expense($amount, $category);
                }
            }
        }
    }
}


?>
