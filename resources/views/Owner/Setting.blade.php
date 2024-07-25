@extends('Components.Owner')

@section('title', 'Crust - House | Owner - Setting')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Owner/setting.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush

@section('main')

    @php
        $id = session('id');
        $branch_id = session('branch_id');
    @endphp

    <main id="settings">
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

        <h2 id="heading">Settings</h2>
        <div id="options">

            {{--  
            |---------------------------------------------------------------|
            |======================== Update Settings ======================|
            |---------------------------------------------------------------|
            --}}

            <button onclick="UpdateOwnerOverlay()">Update Logo/Color</button>
            <div id="updateOwnerSettingOverlay"></div>
            <form action="" class="updateOwnerSetting" id="updateOwnerSetting" method="post"
                enctype="multipart/form-data">
                @csrf
                <h3>Update Logo and Theme</h3>
                <hr>
                <div class="inputdivs">
                    <div id="logoDiv">
                        <div class="image" id="imagePreview">
                            <img src="{{ asset('Images/fbrLogo.jpg') }}">
                        </div>
                        <label id="addImg" for="logoPic">Update Logo</label>
                        <input style="display: none;" type="file" id="logoPic" name="logoPic" accept="image/*"
                        onchange="displayImage()">
                    </div>
                </div>
                
                <div class="inputdivs">
                    <label for="primaryColor">Primery Color</label>
                    <input type="color" name="primery_color" id="primaryColor">
                </div>

                <div class="inputdivs">
                    <label for="secondaryColor">Secondary Color</label>
                    <input type="color" name="secondary_color" id="secondaryColor">
                </div>

                <div class="form_btns">
                    <button >Close</button>
                    <button >Update</button>
                </div>
            </form>
        </div>

        {{--      
            |---------------------------------------------------------------|
            |==================== Confirm Delete Overlay ===================|
            |---------------------------------------------------------------|
        --}}

        <div id="confirmDeletionOverlay"></div>
        <div class="confirmDeletion" id="confirmDeletion">
            <h3 id="message-text">Are you sure you want to delete.</h3>
            <div class="box-btns">
                <button id="confirm">Delete</button>
                <button id="close" onclick="closeConfirmDelete()">Close</button>
            </div>
        </div>

    </main>

    <script>
        function UpdateOwnerOverlay() {
            document.getElementById('updateOwnerSettingOverlay').style.display = 'block';
            document.getElementById('updateOwnerSetting').style.display = 'flex';
        }

        function closeUpdateOwnerSetting() {
            document.getElementById('updateOwnerSettingOverlay').style.display = 'none';
            document.getElementById('updateOwnerSetting').style.display = 'none';
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

        function displayImage() {
            const input = document.getElementById('logoPic');
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Logo Picture">';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
