<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_update_budgets()
    {
        $category = $this->create('App\Category');
        $budget = $this->create('App\Budget', ['category_id' => $category->id]);
        $newBudget = $this->make('App\Budget', ['category_id' => $category->id]);

        $this->put("/budgets/{$budget->id}", $newBudget->toArray())
            ->assertRedirect('/budgets');

        $this->get('/budgets')
            ->assertSee((string) $newBudget->amount);
    }

    /**
     * @test
     */
    public function it_cannot_update_budgets_without_a_category ()
    {
        $this->updateBudget(['category_id' => null])
            ->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     */
    public function it_cannot_update_budgets_without_an_amount ()
    {
        $this->updateBudget(['amount' => null])
            ->assertSessionHasErrors('amount');
    }

    /**
     * @test
     */
    public function it_cannot_update_budgets_without_a_budget_date ()
    {
        $this->updateBudget(['budget_date' => null])
            ->assertSessionHasErrors('budget_date');
    }

    public function updateBudget($overrides = [])
    {
        $category = $this->create('App\Category');
        $budget = $this->create('App\Budget', ['category_id' => $category->id]);
        $newBudget = $this->make('App\Budget', array_merge(['category_id' => $category->id], $overrides));

        return $this->withExceptionHandling()->put("/budgets/{$budget->id}", $newBudget->toArray());
    }

}