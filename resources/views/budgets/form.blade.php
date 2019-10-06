      {{ csrf_field() }}
      <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
        <label for="category_id">カテゴリー</label>
          <select name="category_id" class="form-control">
            <option value=""></option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ $category->id == (old('category_id') ?: $budget ->category_id ) ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
      </div>
      <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
        <label for="amount">総計</label>
          <input type="number" name="amount" class="form-control" value="{{ old('amount') ?: $budget ->amount }}">
      </div>
      <div class="form-group {{ $errors->has('budget_date') ? 'has-error' : '' }}">
        <label for="budget_date">予算日</label>
          <select name="budget_date" class="form-control">
            <option value=""></option>
            @foreach($months as $month)
              <option value="{{ $month }}" {{ $month == $budget->getMonth() ? 'selected' : '' }}>
                {{ $month }}
              </option>
            @endforeach
          </select>
      </div>
      <button class="btn btn-success" type="submit">{{ isset($buttonText) ? $buttonText : '作成' }}</button>