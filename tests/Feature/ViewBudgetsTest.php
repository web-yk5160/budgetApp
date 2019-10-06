<?php

namespace Tests\Feature;

use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;



class ViewBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_should_display_budgets_for_the_current_month_by_default()
    {
      $category = $this->create('App\Category');
      $budgetForThisMonth = $this->create('App\Budget', ['category_id' => $category->id]);
      $budgetForLastMonth = $this->create('App\Budget', ['category_id' => $category->id, 'budget_date' => Carbon::now()->subMonth()]);

      $this->get('/budgets')
        ->assertSee( (string) $budgetForThisMonth->amount)
        ->assertSee((string) $budgetForThisMonth->balance())
        ->assertDontSee( (string) $budgetForLastMonth->amount)
        ->assertDontSee( (string) $budgetForLastMonth->balance());
    }
}
