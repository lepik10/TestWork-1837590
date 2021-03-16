<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PostTest extends TestCase
{

    use RefreshDatabase;

    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/');
        $response->assertSeeText('No posts');
    }

    public function testPostStore()
    {
        $image_name = 'avatar.jpg';

        $post = [
            'title' => 'test title',
            'theme' => 'test theme',
            'image' => UploadedFile::fake()->image($image_name),
            'content' => 'test content test content test content test content test content test content',
        ];

        $this->post('/posts', $post)->assertStatus(302)->assertSessionHas('success_create');
        $this->assertEquals(session('success_create'), __('messages.success_create'));
        Storage::disk('public')->assertExists("1/{$image_name}");

        $response = $this->get('/posts/1');
        $response->assertSeeText($post['title']);
        $response->assertSeeText($post['theme']);
        $response->assertSeeText($post['content']);
    }

    public function testTotalPosts()
    {
        Post::factory()->count(4)->create();

        $response = $this->get('/');

        $response->assertSeeText('Total posts: 4');
    }

    public function testPostUpdate()
    {
        $post = Post::factory()->count(1)->create()[0];

        $response = $this->get("/posts/{$post->id}/edit");

        $response->assertSeeText('Edit post');

        $image_name = 'avatar.jpg';

        $post_new = [
            'title' => 'test title',
            'theme' => 'test theme',
            'image' => UploadedFile::fake()->image($image_name),
            'content' => 'test content test content test content test content test content test content',
        ];

        $this->put("/posts/{$post->id}", $post_new)->assertStatus(302)->assertSessionHas('success_update');
        $this->assertEquals(session('success_update'), __('messages.success_update'));
    }

    public function testDelete()
    {
        $post = Post::factory()->count(1)->create()[0];

        $this->delete("/posts/{$post->id}")->assertStatus(302)->assertSessionHas('success_delete');

        $this->assertEquals(session('success_delete'), __('messages.success_delete'));
    }
}
