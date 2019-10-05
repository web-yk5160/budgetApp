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

    /**
     * @test
     */
    public function it_allows_only_authenticated_users_to_the_categories_list()
    {
        $this->signOut()
            ->withExceptionHandling()
            ->get('/categories')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function it_only_displays_categories_that_belongs_to_the_currently_logged_in_users()
    {
        $otherUser = create('App\User');
        $category = create('App\Category', ['user_id' => $this->user->id]);
        $otherCategory = create('App\Category', ['user_id' => $otherUser->id]);

        $this->get('/categories')
            ->assertSee($category->name)
            ->assertDontSee($otherCategory->name);
    }
}