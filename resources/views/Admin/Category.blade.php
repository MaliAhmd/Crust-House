@extends('Components.Admin')
@section('title', 'Crust - House | Admin - Category')
@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Admin/category.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
<style>
    #categoryTable_paginate,
    #categoryTable_filter,
    .dataTables_length,
    .dataTables_info {
        margin: 0.5vw 7vw !important;
        font-size: 0.8rem !important;
    }

    #categoryTable_next,
    #categoryTable_previous,
    #categoryTable_paginate span a {
        margin: 0.5vw !important;
        padding: 0 !important;
        font-size: 0.8rem
    }

    table.dataTable {
        border-collapse: collapse !important;
    }
</style>
@section('main')
    <main id="category">
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
        @php
            $id = session('id');
            $branch_id = session('branch_id');
        @endphp

        <div class="addnewCategory">
            <button onclick="addCategory()">Add New Category</button>
        </div>

        @php
            $categories = $categories;
        @endphp

        <table id="categoryTable">
            <thead>
                <tr>
                    <th>Category Image</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $value)
                    <tr>
                        <td><img src={{ asset('Images/CategoryImages/' . $value->categoryImage) }} alt="Image"></td>
                        <td>{{ $value->categoryName }}</td>
                        <td>
                            <a onclick="editcategory('{{ $value->categoryName }}', '{{ $value->id }}')"><i
                                    class='bx bxs-edit-alt'></i>
                            </a>
                            <a onclick="showConfirmDelete('{{ route('deleteCategory', $value->id) }}')"><i
                                    class='bx bxs-trash-alt'></i>
                            </a>
                        </td>
                    </tr>
                    @php
                        $name = $value->categoryName;
                        $id = $value->id;
                    @endphp
                @endforeach
            </tbody>
        </table>

        {{--  
            |---------------------------------------------------------------|
            |================ Add new Category Overlay =====================|
            |---------------------------------------------------------------|
        --}}

        <div id="overlay"></div>
        <form class="newcategory" id="newCategory" action="{{ route('createCategory') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <h3>Add New Category</h3>
            <hr>

            <input type="hidden" name="admin_id" value="{{ $id }}">
            <input type="hidden" name="branch_id" value="{{ $branch_id }}">

            <div class="inputdivs">
                <label for="upload-file" class="choose-file-btn">
                    <span>Choose File</span>
                    <input type="file" id="upload-file" name="CategoryImage" accept=".jpg,.jpeg,.png" required>
                    <p id="filename"></p>
                </label>
            </div>
            @error('CategoryImage')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <div class="inputdivs">
                <label for="categoryname">Category Name</label>
                <input type="text" id="categoryname" name="categoryName" placeholder="Category Name" required>
            </div>
            @error('categoryName')
                <span class="error-message">{{ $message }}</span>
            @enderror
            <div class="btns">
                <button type="button" id="cancel" onclick="closeAddCatogry()">Cancel</button>
                <input type="submit" value="Add">
            </div>
        </form>


        {{--   
            |---------------------------------------------------------------|
            |================== Edit Category Overlay ======================|
            |---------------------------------------------------------------|
        --}}

        <div id="editOverlay"></div>
        <form class="updateCategory" id="updateCategory" action="{{ route('updateCategory') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <h3>Update Category</h3>
            <hr>

            <div class="inputdivs">
                <label for="upload-update-file" class="choose-file-btn">
                    <span>Choose File</span>
                    <input type="hidden" id="upid" name="id">
                    <input type="file" id="upload-update-file" name="CategoryImage" accept=".jpg,.jpeg,.png">
                    <p id="filenam"></p>
                </label>
            </div>
            @error('CategoryImage')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <div class="inputdivs">
                <label for="categorynam">Category Name</label>
                <input type="text" id="categorynam" name="categoryName"placeholder="Category Name" required>
            </div>
            @error('categoryName')
                <span class="error-message">{{ $message }}</span>
            @enderror
            <div class="btns">
                <button type="button" id="cancel" onclick="closeEditCatogry()">Cancel</button>
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
            <h3 id="message-text">Are you sure you want to delete this category</h3>
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
            $('#categoryTable').DataTable({
                "paging": true,
                "lengthMenu": [5, 10, 25, 50, 100]
            });
        });

        function addCategory() {
            let overlay = document.getElementById('overlay');
            let popup = document.getElementById('newCategory');
            overlay.style.display = 'block';
            popup.style.display = 'flex';
        }

        function closeAddCatogry() {
            let overlay = document.getElementById('overlay');
            let popup = document.getElementById('newCategory');
            overlay.style.display = 'none';
            popup.style.display = 'none';
        }

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

        const uploadFile = document.getElementById('upload-file');
        const filenameSpan = document.getElementById('filename');
        uploadFile.addEventListener('change', function(e) {
            const fileName = this.value.split('\\').pop();
            filenameSpan.textContent = fileName ? fileName : 'No file chosen';
        });

        function editcategory(categoryName, id) {
            let overlay = document.getElementById('editOverlay');
            let popup = document.getElementById('updateCategory');
            overlay.style.display = 'block';
            popup.style.display = 'flex';
            document.getElementById('categorynam').value = categoryName;
            document.getElementById('upid').value = id;
        }

        function closeEditCatogry() {
            let overlay = document.getElementById('editOverlay');
            let popup = document.getElementById('updateCategory');
            overlay.style.display = 'none';
            popup.style.display = 'none';
        }

        const uploadUpdatedFile = document.getElementById('upload-update-file');
        const filenamSpan = document.getElementById('filenam');
        uploadUpdatedFile.addEventListener('change', function(e) {
            const fileNam = this.value.split('\\').pop();
            filenamSpan.textContent = fileNam ? fileNam : 'No file chosen';
        });
    </script>
@endsection
