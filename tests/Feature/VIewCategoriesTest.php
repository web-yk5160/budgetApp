<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;



class ViewCategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_display_all_categories()
    {
      $category = $this->create('App\Category');

      $this->get('/categories')
        ->assertSee($category->name);
    }
}