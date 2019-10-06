<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateTransactionsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_can_update_transactions()
    {
        $category = $this->create('App\Category');
        $transaction = $this->create('App\Transaction');
        $newTransaction = $this->make('App\Transaction', ['category_id' => $category->id]);

        $this->put("/transactions/{$transaction->id}",  $newTransaction->toArray())
            ->assertRedirect('/transactions');

        $this->get('/transactions')
            ->assertSee($newTransaction->description);
    }

    /**
     * @test
     */
    public function it_cannot_update_transactions_without_a_description()
    {
      $this->updateTransaction(['description' => null])
        ->assertSessionHasErrors('description');
    }

    /**
   * @test
   */
  public function it_cannot_update_transactions_without_a_category()
  {
    $this->updateTransaction(['category_id' => null])
      ->assertSessionHasErrors('category_id');
  }


  /**
 * @test
 */
public function it_cannot_update_transactions_without_an_amount()
{
  $this->updateTransaction(['amount' => null])
    ->assertSessionHasErrors('amount');
}

  /**
 * @test
 */
public function it_cannot_update_transactions_without_a_valid_amount()
{
  $this->updateTransaction(['amount' => 'abc'])
    ->assertSessionHasErrors('amount');
}


    public function updateTransaction($overrides = [])
    {
        $transaction = $this->create('App\Transaction');
        $newTransaction = $this->make('App\Transaction', $overrides);

        return $this->withExceptionHandling()
            ->put("/transactions/{$transaction->id}",  $newTransaction->toArray());
    }
}