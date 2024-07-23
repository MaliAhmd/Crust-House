@extends('Components.Admin')
@section('title', 'Crust - House | Admin - Products')
@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Admin/product.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
@push('scripts')
    <script src="{{ asset('JavaScript\product.js') }}"></script>
@endpush
<style>
    #productTable_paginate,
    #productTable_filter,
    .dataTables_length,
    .dataTables_info {
        margin: 0.5vw 5vw !important;
        font-size: 0.8rem !important;
    }

    #productTable_next,
    #productTable_previous,
    #productTable_paginate span a {
        margin: 0.5vw !important;
        padding: 0 !important;
        font-size: 0.8rem
    }

    table.dataTable {
        border-collapse: collapse !important;
    }
</style>

@section('main')
    <main id="product">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="newCategory">
            <button onclick="addProduct()">Add New Product</button>
        </div>

        @php
            $productsData = $productsData;
            $branch_id = session('branch_id');
        @endphp

        <table id="productTable">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Variations</th>
                    <th>Product Prices</th>
                    <th>Product Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $renderedProducts = [];
                @endphp
                @foreach ($productsData as $product)
                    @php
                        if (isset($renderedProducts[$product->productName])) {
                            continue;
                        }

                        $variations = [];
                        $prices = [];
                        foreach ($productsData as $variation) {
                            if ($variation->productName === $product->productName) {
                                $variations[] = $variation->productVariation;
                                $prices[] = $variation->productPrice;
                            }
                        }

                        $renderedProducts[$product->productName] = true;
                    @endphp
                    <tr style="border-bottom: 1px solid #000;">
                        <td><img src="{{ asset('Images/ProductImages/' . $product->productImage) }}" alt="Image"></td>
                        <td>{{ $product->productName }}</td>
                        <td>
                            <div style="display: flex; flex-direction:column;">
                                @foreach ($variations as $variation)
                                    <p>{{ $variation }}</p>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction:column;">
                                @foreach ($prices as $price)
                                    <p>Rs. {{ $price }} </p>
                                @endforeach
                            </div>
                        <td>{{ $product->category_name }}</td>
                        <td>
                            <a onclick="editProduct({{ json_encode($product) }}, {{ json_encode($productsData) }})"><i
                                    class='bx bxs-edit-alt'></i></a>
                            <a onclick="showConfirmDelete('{{ route('deleteProduct', $product->id) }}')"><i
                                    class='bx bxs-trash-alt'></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{--  
            |---------------------------------------------------------------|
            |================ Add new Product Overlay ======================|
            |---------------------------------------------------------------|
        --}}

        <div id="overlay"></div>
        <form class="newproduct" id="newProduct" action="{{ route('createProduct') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <h3>Add New Product</h3>
            <hr>
            <input type="hidden" name="branch_id" value="{{ $branch_id }}">
            <div class="inputdivs">
                <label for="category">Select category</label>
                <select name="categoryId" id="category" required>
                    <option value="" selected disabled>Select Product Category</option>
                    @foreach ($categoryData as $category)
                        <option value="{{ $category->id }},{{ $category->categoryName }}">{{ $category->categoryName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="inputdivs inputProductName">
                <div class="ProductName">
                    <label for="productName">Product Name</label>
                    <input type="text" id="productName" name="productName" placeholder="Product Name" required>
                </div>
                <div class="ProductVariation">
                    <label for="noOfVariations">Variations</label>
                    <input type="number" id="noOfVariations" min="0" name="noOfVariations"
                        oninput="updateVariationFields(this.value)" placeholder="Ex 4 etc">
                </div>
            </div>
            <p id="msg"></p>
            <div id="variationsGroup"></div>

            <div class="inputdivs">
                <label for="upload-file" class="choose-file-btn">
                    <span>Choose File</span>
                    <input type="file" id="upload-file" name="productImage" accept=".jpg,.jpeg,.png" required>
                    <p id="filename"></p>
                </label>
            </div>
            <div class="btns">
                <button id="cancel" onclick="closeAddProduct()">Cancel</button>
                <input type="submit" value="Add">
            </div>

        </form>

        {{--  
            |---------------------------------------------------------------|
            |=================== Edit Product Overlay ======================|
            |---------------------------------------------------------------|
        --}}

        <div id="editOverlay"></div>
        <form class="editproduct" id="editProduct" action="{{ route('updateProduct') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <h3>Edit Product</h3>
            <hr>

            <input type="hidden" id="pId" name="pId">

            <div class="inputdivs">
                <label for="pName">Product Name</label>
                <input type="text" id="pName" name="productName" placeholder="Product Name" required>
            </div>

            <div class="inputdivs inputProductName" id="editVariationsGroup"></div>

            <div class="inputdivs">
                <label for="upload-update-file" class="choose-file-btn">
                    <span>Choose File</span>
                    <input type="file" id="upload-update-file" name="productImage" accept=".jpg,.jpeg,.png">
                    <p id="namefile"></p>
                </label>
            </div>

            <div class="btns">
                <button type="button" id="cancel" onclick="closeEditProduct()">Cancel</button>
                <input type="submit" value="Update">
            </div>
        </form>
        {{--   
            |---------------------------------------------------------------|
            |===================== Confirm deletion ========================|
            |---------------------------------------------------------------|
        --}}

        <div id="confirmDeletionOverlay"></div>
        <div class="confirmDeletion" id="confirmDeletion">
            <h3 id="message-text">Are you sure you want to delete this product</h3>
            <div class="box-btns">
                <button id="confirm">Delete</button>
                <button id="close" onclick="closeConfirmDelete()">Close</button>
            </div>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#productTable').DataTable({
                "paging": true,
                "lengthMenu": [5, 10, 25, 50, 100]
            });
        });

        function showConfirmDelete(deleteUrl) {
            let confirmDeletionOverlay = document.getElementById('confirmDeletionOverlay');
            let confirmDeletionPopup = document.getElementById('confirmDeletion');
            confirmDeletionOverlay.style.display = 'block';
            confirmDeletionPopup.style.display = 'block';

            let confirmButton = document.getElementById('confirm');
            confirmButton.onclick = function() {
                window.location.href = deleteUrl;
            };
        }

        function closeConfirmDelete() {
            let confirmDeletionOverlay = document.getElementById('confirmDeletionOverlay');
            let confirmDeletionPopup = document.getElementById('confirmDeletion');
            confirmDeletionOverlay.style.display = 'none';
            confirmDeletionPopup.style.display = 'none';
        }
    </script>
@endsection
