@extends('Components.Admin')
@section('title', 'Crust - House | Admin - Taxes')
@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Admin/discount.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
<style>
    #discountTable_paginate,
    #discountTable_filter,
    .dataTables_length,
    .dataTables_info {
        margin: 0.5vw 7vw !important;
        font-size: 0.8rem !important;
    }

    #discountTable_next,
    #discountTable_previous,
    #discountTable_paginate span a {
        margin: 0.5vw !important;
        padding: 0 !important;
        font-size: 0.8rem
    }

    table.dataTable {
        border-collapse: collapse !important;
    }
</style>

@section('main')
    <main id="discount">
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

        <div class="addnewDiscount">
            <button onclick="addDiscount()">Add New Discount</button>
        </div>

        <table id="discountTable">
            <thead>
                <tr>
                    <th>Tax Id</th>
                    <th>Tax Name</th>
                    <th>Tax Value %</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($taxes as $discount)
                    <tr>
                        <td>{{ $discount->id }}</td>
                        <td>{{ $discount->tax_name }}</td>
                        <td>{{ $discount->tax_value }}</td>
                        <td>
                            <a onclick="editTax('{{ json_encode($discount) }}')">
                                <i class='bx bxs-edit-alt'></i>
                            </a>
                            <a onclick="showConfirmDelete('{{ route('deleteTax', $discount->id) }}')">
                                <i class='bx bxs-trash-alt'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>

        {{--  
            |---------------------------------------------------------------|
            |================ Add new Category Overlay =====================|
            |---------------------------------------------------------------|
        --}}

        <div id="overlay"></div>
        <form class="newdiscount" id="newDiscount" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Add New Discount</h3>
            <hr>

            <input type="hidden" name="admin_id" value="{{ $id }}">
            <input type="hidden" name="branch_id" value="{{ $branch_id }}">

            <div class="inputdivs">
                <label for="discount">Recipt Message</label>
                <textarea name="recipt_message" id="reciptMessage" cols="30" rows="10"
                    placeholder="We would love to hear your feedback on your recent experience with us. This survey will only take 1 minute to complete. Share Your Feedback"
                    required></textarea>
            </div>

        </form>


        {{--   
            |---------------------------------------------------------------|
            |================== Edit Category Overlay ======================|
            |---------------------------------------------------------------|
        --}}

        <div id="editOverlay"></div>
        <form class="updateDiscount" id="updateDiscount" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Update Discount</h3>
            <hr>
            <input type="hidden" name="tax_id" id="taxId">
            {{-- <div class="inputdivs">
                <label for="taxName">Tax Name</label>
                <input type="text" id="editTaxName" name="tax_name" placeholder="GST, Sales Tax..." required>
            </div>

            <div class="inputdivs">
                <label for="taxValue">Tax Value</label>
                <input type="number" id="editTaxValue" name="tax_value" placeholder="2.5%" min='0' step="0.01"
                    required>
            </div> --}}

            <div class="btns">
                <button id="cancel" onclick="closeEditDiscount()">Cancel</button>
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
            <h3 id="message-text">Are you sure you want to delete this discount</h3>
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
            $('#discountTable').DataTable({
                "paging": true,
                "lengthMenu": [5, 10, 25, 50, 100]
            });
        });

        function addDiscount() {
            let overlay = document.getElementById('overlay');
            let popup = document.getElementById('newDiscount');
            overlay.style.display = 'block';
            popup.style.display = 'flex';
        }

        function closeAddTax() {
            let overlay = document.getElementById('overlay');
            let popup = document.getElementById('newDiscount');
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

        function editTax(discount) {
            discount = JSON.parse(discount);
            console.log(discount);
            console.log(discount.tax_name);
            let overlay = document.getElementById('editOverlay');
            let popup = document.getElementById('updateDiscount');
            overlay.style.display = 'block';
            popup.style.display = 'flex';
            document.getElementById('taxId').value = discount.id;
            document.getElementById('editTaxName').value = discount.tax_name;
            document.getElementById('editTaxValue').value = discount.tax_value;
        }

        function closeEditDiscount() {
            let overlay = document.getElementById('editOverlay');
            let popup = document.getElementById('updateDiscount');
            overlay.style.display = 'none';
            popup.style.display = 'none';
        }
    </script>
@endsection

{{-- 
<div class="inputdivs">
    <label for="reciptMessage">Recipt Message</label>
    <textarea name="recipt_message" id="reciptMessage" cols="30" rows="10"
        placeholder="We would love to hear your feedback on your recent experience with us. This survey will only take 1 minute to complete. Share Your Feedback"
        required></textarea>
</div> --}}
