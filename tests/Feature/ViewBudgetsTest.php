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
    public function it_allows_only_authenticated_users_to_the_budgets_list()
    {
        $this->signOut()
            ->withExceptionHandling()
            ->get('/budgets')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function it_only_displays_budgets_that_belongs_to_the_currently_logged_in_users()
    {
        $category = $this->create('App\Category');
        $otherUser = create('App\User');
        $budget = $this->create('App\Budget', ['category_id' => $category->id]);
        $otherBudget = create('App\Budget', ['category_id' => $category->id, 'user_id' => $otherUser->id]);

        $this->get('/budgets')
            ->assertSee((string) $budget->amount)
            ->assertDontSee((string) $otherBudget->amount);
    }

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
