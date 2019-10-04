<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class DeleteTransactionsTest extends TestCase
{
  use DatabaseMigrations;
  /**
   * @test
   */
  public function it_can_delete_transactions()
  {
    $transaction = $this->create('App\Transaction');

    $this->delete("/transactions/{$transaction->id}")
      ->assertRedirect('/transactions');

    $this->get('/transactions')
      ->assertDontSee($transaction->description);
  }
}