<?php

namespace Tests\Feature\Article;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function can_subscribe_to_newsletter_with_valid_email(): void
    {
        $this->followingRedirects()
            ->getSubscribeRoute(['email' => $this->faker->email])
            ->assertSessionHasNoErrors()
            ->assertOk();
    }

    /** @test */
    public function email_is_required(): void
    {
        $this->getSubscribeRoute()
            ->assertRedirect()
            ->assertSessionHasErrorsIn('newsletter', 'email');
    }

    /** @test */
    public function valid_email_is_required(): void
    {
        $data = ['email' => $this->faker->sentence];

        $this->getSubscribeRoute($data)
            ->assertRedirect()
            ->assertSessionHasErrorsIn('newsletter', 'email')
            ->assertSessionHasInput($data);
    }

    protected function getSubscribeRoute(array $data = []): TestResponse
    {
        return $this->post(route('newsletter.subscribe'), $data);
    }
}
