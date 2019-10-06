{{ csrf_field() }}
  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="descrition">名前</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') ?: $category->name }}">
  </div>
  <button class="btn btn-success" type="submit">{{ isset($buttonText) ? $buttonText : '作成' }}</button>