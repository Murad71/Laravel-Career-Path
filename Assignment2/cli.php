<?php

require 'vendor/autoload.php';

use ExpenseTracker\Root;

$root = new Root();

function showMenu() {
    echo "\n========== Expense Tracker ==========\n";
    echo "1. Add Income\n";
    echo "2. Add Expense\n";
    echo "3. View Income List\n";
    echo "4. View Expense List\n";
    echo "5. View Total Income\n";
    echo "6. View Total Expense\n";
    echo "7. View Savings\n";
    echo "8. Exit\n";
    echo "Choose an option: ";
}

while (true) {
    showMenu();
    $option = trim(fgets(STDIN));

    switch ($option) {

        case 1:
            echo "\nEnter amount for Income: ";
            $amount = trim(fgets(STDIN));
            echo "\nEnter category for Income: ";
            $category = trim(fgets(STDIN));
            $root->addIncome($amount, $category);
            echo "Income added successfully!\n";
            break;

        case 2:
            echo "\nEnter amount for Expense: ";
            $amount = trim(fgets(STDIN));
            echo "\nEnter category for Expense: ";
            $category = trim(fgets(STDIN));
            $root->addExpense($amount, $category);
            echo "Expense added successfully!\n";
            break;

        case 3:
            echo "\n=====================================";
            echo "\nIncome List:\n";
            $incomes = $root->getIncomes();
            if (empty($incomes)) {
                echo "No incomes recorded.\n";
            } else {
                foreach ($incomes as $income) {
                    echo $income . "\n";
                }
            }
            echo "=====================================\n";
            break;

        case 4:
            echo "\n=====================================\n";
            echo "\nExpense List:\n";
            $expenses = $root->getExpenses();
            if (empty($expenses)) {
                echo "No expenses recorded.\n";
            } else {
                foreach ($expenses as $expense) {
                    echo $expense . "\n";
                }
            }
            echo "\n=====================================\n";
            break;

        case 5:
            echo "\n=====================================\n";
            echo "\nTotal Income: " . $root->getTotalIncome() . "\n";
            echo "\n=====================================\n";
            break;

        case 6:
            
            echo "\n=====================================\n";
            echo "\nTotal Expense: " . $root->getTotalExpense() . "\n";
            echo "\n=====================================\n";
            break;

        case 7:
            echo "\n=====================================\n";
            echo "\nSavings: " . $root->getSavings() . "\n";
            echo "\n=====================================\n";
            break;

        case 8:
            echo "\nExiting...\n";
            exit;

        default:
            echo "\nInvalid option! Please choose a valid option.\n";
            break;

    }
}




?>
