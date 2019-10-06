<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateCategoriesTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_can_update_categories()
    {
      $category = $this->create('App\Category');
      $newCategory = $this->make('App\Category');

        $this->put("/categories/{$category->slug}",  $newCategory->toArray())
            ->assertRedirect('/categories');

        $this->get('/categories')
            ->assertSee($newCategory->name );
    }

    /**
     * @test
     */
    public function it_cannot_update_categories_without_a_name()
    {
      $this->updateCategory(['name' => null])
        ->assertSessionHasErrors('name');
    }

    public function updateCategory($overrides = [])
    {
      $category = $this->create('App\Category');
      $newCategory = $this->make('App\Category', $overrides);

      return $this->withExceptionHandling()->put("/categories/{$category->slug}",  $newCategory->toArray());
    }
}