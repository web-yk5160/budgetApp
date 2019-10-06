<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class BudgetTest extends TestCase
{
  use DatabaseMigrations;
  /**
   * @test
   */
  public function it_has_a_balance()
  {
    $category = $this->create('App\Category');
    $transactions = $this->create('App\Transaction', ['category_id' => $category->id], 3);
    $budget = $this->create('App\Budget', ['category_id' => $category->id]);

    $expectedBalance = $budget->amount - $transactions->sum('amount');

    $this->assertEquals($expectedBalance, $budget->balance());
  }

}