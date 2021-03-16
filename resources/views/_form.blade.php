@csrf
<label class="form__label form__label_inline">
    <p class="form__annotation">Image</p>
    <input type="file" name="image" accept="image/*" class="form__file">
    <div class="form__file-wrap {{ isset($post) && $post->image ? 'form__file-wrap_active' : null }} ">
        <img class="form__file-annotation" src="{{ $post->image_path ?? null }}">
    </div>
</label>
@error('image')
<div class="message message_error">{{ $message }}</div>
@enderror
@if(isset($post) && $post->image)
    <label class="form__label">
        <input type="checkbox" name="delete_image" value="true"> Delete image
    </label>
@endif
<label class="form__label">
    <p class="form__annotation">Title <span class="form__red">*</span></p>
    <input type="text" name="title" class="form__input" value="{{ $post->title ?? old('title') }}">
</label>
@error('title')
<div class="message message_error">{{ $message }}</div>
@enderror
<label class="form__label">
    <p class="form__annotation">Title <span class="form__red">*</span></p>
    <input type="text" name="theme" class="form__input" value="{{ $post->theme ?? old('theme') }}">
</label>
@error('theme')
<div class="message message_error">{{ $message }}</div>
@enderror
<label class="form__label">
    <p class="form__annotation">Text <span class="form__red">*</span></p>
    <textarea name="content" class="form__textarea">{{ $post->content ?? old('content') }}</textarea>
</label>
@error('content')
<div class="message message_error">{{ $message }}</div>
@enderror
