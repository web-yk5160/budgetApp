<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreateBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_create_budgets()
    {
      $category = $this->create('App\Category');
      $budget = $this->make('App\Budget', ['category_id' => $category->id]);

      $this->post('/budgets', $budget->toArray())
        ->assertRedirect('/budgets');

      $this->get('/budgets')
        ->assertSee((string) $budget->amount);
    }

/**
 * @test
 */
public function it_cannot_create_budgets_without_a_category ()
{
    $this->postBudget(['category_id' => null])
        ->assertSessionHasErrors('category_id');
}

/**
 * @test
 */
public function it_cannot_create_budgets_without_an_amount ()
{
    $this->postBudget(['amount' => null])
        ->assertSessionHasErrors('amount');
}

/**
 * @test
 */
public function it_cannot_create_budgets_without_a_budget_date ()
{
    $this->postBudget(['budget_date' => null])
        ->assertSessionHasErrors('budget_date');
}

    public function postBudget($overrides = [])
    {
        $budget = make('App\Budget', $overrides);

        return $this->withExceptionHandling()->post('/budgets', $budget->toArray());
    }
}
