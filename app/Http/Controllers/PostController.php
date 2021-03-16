<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('index')->with([
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $inputs_fields = $request->except('image');
        $image = $request->file('image');

        $post = Post::create($inputs_fields);

        $this->storageImage($post, $image);

        return redirect()->route('posts.index')->with('success_create', __('messages.success_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('show')->with([
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('edit')->with([
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $inputs_fields = $request->except('image');
        $image = $request->file('image');

        $inputs_fields = $this->setImageField($post, $inputs_fields);

        $post->update($inputs_fields);

        $this->storageImage($post, $image, true);

        return back()->with('success_update', __('messages.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success_delete', __('messages.success_delete'));
    }

    private function storageImage($post, $image, $update = false)
    {
        // Обрабатываем файл
        if ($image) {
            // удаляем старый файл
            if ($update) {
                Storage::delete($post->image);
            }

            $path = $image->storeAs($post->id . "/", $image->getClientOriginalName(), 'public');
            $post->update(['image' => $path]);
            return true;
        }
        return false;
    }

    private function setImageField($post, $inputs_fields)
    {
        // Удаляем изображение и очищаем поле, если поставлена галочка
        if (isset($inputs_fields['delete_image'])) {
            unset($inputs_fields['delete_image']);
            Storage::delete($post->image);
            $inputs_fields['image'] = '';
        }
        return $inputs_fields;
    }
}
