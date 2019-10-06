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
}
