@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
  <h1 class="title">商品一覧</h1>

  <div class="product-page">
    <!-- 左サイドバー -->
    <aside class="sidebar">
      <form action="{{ route('products.index') }}" method="GET">
        <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
        <button type="submit">検索</button>

        <div class="sort-box">
          <label for="sort">価格順で表示</label>
          <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="">選択してください</option>
            <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>高い順に表示</option>
            <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>安い順に表示</option>
          </select>
        </div>
      </form>
    </aside>

    
    <div class="product-grid">
      @foreach ($products as $product)
        <div class="product-card">
          <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
          <div class="product-info">
            <p class="product-name">{{ $product->name }}</p>
            <p class="product-price">¥{{ number_format($product->price) }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ページネーション -->
  <div class="pagination">
    {{ $products->appends(request()->query())->links() }}
  </div>

  
  <div class="add-button">
    <a href="{{ route('products.create') }}" class="btn btn-primary">+ 商品を追加</a>
  </div>
</div>
@endsection
