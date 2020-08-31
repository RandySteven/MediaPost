<div class="form-group">
    <label for="">File Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control" id="">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Title</label>
    <input type="text" class="form-control" name="title" value="{{ old('title') ?? $post->title }}">
</div>

<div class="form-group">
    <label for="exampleFormControlSelect1">Category</label>
    <select class="form-control" id="exampleFormControlSelect1" name="category">
      <option selected disabled>Choose One</option>
      @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
      @endforeach
    </select>
</div>
<div class="form-group">
    <label for="exampleFormControlSelect2">Tag</label>
    <select multiple class="form-control" name="tag[]">
      @foreach ($tags as $tag)
          <option value="{{ $tag->id }}">{{ $tag->name }}</option>
      @endforeach

      @foreach ($post->tags as $tag)
          <option value="{{ $tag->id }}">{{ $tag->name }}</option>
      @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Text</label>
    <textarea class="form-control" name="body" rows="10">{{ old('body') ?? $post->body }}</textarea>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
