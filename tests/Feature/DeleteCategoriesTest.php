<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class DeleteCategoriesTest extends TestCase
{
  use DatabaseMigrations;
  /**
   * @test
   */
  public function it_can_delete_categories()
  {
    $category = $this->create('App\Category');

    $this->delete("/categories/{$category->slug}")
      ->assertRedirect('/categories');

    $this->get('/categories')
      ->assertDontSee($category->name);
  }
}