@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css')}}">
@endsection

@section('content')
    <div class="container">
        <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')


        <div class="product-form__group">
            <label class="product-form__label" for="name">商品名
            </label>
                <input class="product-form__input  "type="text" name="name" id="name" value="{{ old('name')}}" placeholder="商品名を入力" />
                <p class="product-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
        </div>
        <div class="product-form__group">
            <label class="product-form__label" for="price">値段
            </label>
                <input class="product-form__input  "type="text" name="price" id="price" value="{{ old('price')}}" placeholder="値段を入力" />
                <p class="product-form__error-message">
                    @error('price')
                    {{ $message }}
                    @enderror
                </p>
            <div class="edit-form__group">
            <label class="edit-form__label" for="image">商品画像
            </label>

            <label for="image" class="custom-file-upload">
            ファイルを選択
            </label>
        <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)" style="display: none;">

        <img id="imagePreview" src="#" alt="選択された画像" style="display:none; max-width: 200px; margin-top: 10px;">

        <p class="edit-form__error-message">
        @error('image')
            {{ $message }}
        @enderror
        </p>
        </div>
            <div>
                <label>値段</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}">
                <p class="edit-form__error-message">
                    @error('price')
                    {{ $message }}
                    @enderror
            </div>

            <div>
                <label>季節</label><br>
                @foreach(['春', '夏', '秋', '冬'] as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season }}"
                    {{ in_array($season, old('seasons', explode(',', $product->season))) ? 'checked' : '' }}>
                    {{ $season }}
                </label>
                @endforeach
                <p class="edit-form__error-message">
                    @error('seasons')
                    {{ $message }}
                    @enderror
            </div>

            <div>
                <label>商品説明</label><br>
                <textarea name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                <p class="edit-form__error-message">
                    @error('description')
                    {{ $message }}
                    @enderror
            </div>

            <div class="edit-form__btn-inner">
            <input class="edit-form__back-btn" type="submit" value="戻る" name="back">
            <input class="edit-form__send-btn btn" type="submit" value="変更を保存" name="send">
            </div>

        <form method="post" action="{{ route('products.destroy', $product->id )}}" >
            @csrf
            @method('DELETE')
        </form>
        </form>
    </div>

    <script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection