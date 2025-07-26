@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<div class="container">
  <h2 class="title">商品一覧</h2>
  <div class="add-button">
    <form action="{{ route('products.create') }}" method="get">
       <input type="submit" value="+ 商品を追加" class="btn btn-primary">
    </form>
  </div>

  <div class="product-page">
  <!-- 左サイドバー -->
  <aside class="sidebar">
      <form action="{{ route('products.index') }}" method="get">
        <input type="text" name="keyword"
        class="search-input" placeholder="商品名で検索" value="{{ request('keyword') }}">
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

        <div class="active-filters">
      @if(request('keyword'))
        <span class="filter-tag">
        検索: {{request('keyword') }}
        <a href="{{ route('products.index', array_merge(request()->except('keyword'))) }}" class="filter-tag__remove">×</a>
        </span>
      @endif
      
      @if(request('sort') === 'high')
   <span class="filter-tag">
    高い順に表示
    <a href="{{ route('products.index', request()->except('sort')) }}" class="filter-tag__remove">×</a>
   </span>
      @elseif(request('sort') === 'low')
   <span class="filter-tag">
    安い順に表示
    <a href="{{ route('products.index', request()->except('sort')) }}" class="filter-tag__remove">×</a>
   </span>
      @endif
  </div>
  </aside>

    <div class="product-grid">
      @foreach ($products as $product)
      <a href="{{ route('products.edit', $product) }}" class="product-card-link">
        <div class="product-card">
          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
          <div class="product-info">
            <p class="product-name">{{ $product->name }}</p>
            <p class="product-price">¥{{ number_format($product->price) }}</p>
          </div>
        </div>
      </a>
      @endforeach
    </div>

  </div>

  <!-- ページネーション -->
  <div class="pagination">
    {{ $products->appends(request()->query())->links() }}
  </div>
</div>
@endsection

