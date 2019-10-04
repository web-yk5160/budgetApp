      {{ csrf_field() }}
      <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
        <label for="descrition">内容</label>
          <input type="text" name="description" class="form-control" value="{{ old('description') ?: $transaction->description }}">
      </div>
      <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
        <label for="amount">総計</label>
          <input type="number" name="amount" class="form-control" value="{{ old('amount') ?: $transaction->amount }}">
      </div>
      <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
        <label for="category_id">カテゴリー</label>
          <select name="category_id" class="form-control">
            <option value=""></option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ $category->id == (old('category_id') ?: $transaction->category_id ) ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
      </div>
      <button class="btn btn-success" type="submit">{{ isset($buttonText) ? $buttonText : '作成' }}</button>