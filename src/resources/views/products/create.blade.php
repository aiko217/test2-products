@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css')}}">
@endsection

@section('content')
<div class="product-form">
    <h2 class="product-form__heading">商品登録</h2>
    
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data"
    class="product-form__inner">
    @csrf
       
        <div class="product-form__group">
            <label class="product-form__label" for="name">商品名
                <span class="product-form__required">必須</span>
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
                <span class="product-form__required">必須</span>
            </label>
                <input class="product-form__input  "type="text" name="price" id="price" value="{{ old('price')}}" placeholder="値段を入力" />
                <p class="product-form__error-message">
                    @error('price')
                    {{ $message }}
                    @enderror
                </p>
        </div>
        <div class="product-form__group">
            <label class="product-form__label" for="image">商品画像
                <span class="product-form__required">必須</span>
            </label>

            <label for="image" class="custom-file-upload btn btn-primary">
            ファイルを選択
            </label>
        <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)" style="display: none;">

        <img id="imagePreview" src="#" alt="選択された画像" style="display:none; max-width: 200px; margin-top: 10px;">

        <p class="product-form__error-message">
        @error('image')
            {{ $message }}
        @enderror
        </p>
        </div>


        <div class="product-form__group">
            <label class="product-form__label" for="seasons">季節
                <span class="product-form__required">必須</span>
                <span class="product-form__note-multi">複数選択可</span>
            </label>
                <div class="form__group-content form__input--checkboxes">
                    @foreach($seasons as $season)
                    <label class="checkbox-label">
                        <input type="checkbox"
                        name="seasons[]"
                        value="{{ $season->id }}"
                        {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }} />
                        {{ $season->name }}
                    </label>
                    @endforeach
                </div>
                <p class="product-form__error-message">
                @error('seasons')
                    {{ $message }}
                @enderror
                </p>
        </div>
                <div class="product-form__group">
            <label class="product-form__label" for="description">商品説明
                <span class="product-form__required">必須</span>
            </label>
            <textarea class="product-form__textarea" name="description" id="description" 
            placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                <p class="product-form__error-message">
                    @error('description')
                    {{ $message }}
                    @enderror
                </p>
        </div>
        <div class="product-form__btn-inner">
        <input class="product-form__back-btn btn" type="submit" value="戻る" name="back">
        <input class="product-form__register-btn" type="submit" value="登録" name="register">
        </div>
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