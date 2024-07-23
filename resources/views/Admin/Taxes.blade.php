@extends('Components.Admin')
@section('title', 'Crust - House | Admin - Taxes')
@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Admin/taxes.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
<style>
    #taxTable_paginate,
    #taxTable_filter,
    .dataTables_length,
    .dataTables_info {
        margin: 0.5vw 7vw !important;
        font-size: 0.8rem !important;
    }

    #taxTable_next,
    #taxTable_previous,
    #taxTable_paginate span a {
        margin: 0.5vw !important;
        padding: 0 !important;
        font-size: 0.8rem
    }

    table.dataTable {
        border-collapse: collapse !important;
    }
</style>
@section('main')
    <main id="tax">
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

        <div class="addnewTax">
            <button onclick="addTax()">Add New Tex</button>
            <button onclick="window.location.href='{{route('viewDiscountPage',[$id, $branch_id])}}'">View Discounts</button>
        </div>

        <table id="taxTable">
            <thead>
                <tr>
                    <th>Tax Id</th>
                    <th>Tax Name</th>
                    <th>Tax Value %</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($taxes as $tax)
                    <tr>
                        <td>{{ $tax->id }}</td>
                        <td>{{ $tax->tax_name }}</td>
                        <td>{{ $tax->tax_value }}</td>
                        <td>
                            <a onclick="editTax('{{ json_encode($tax) }}')">
                                <i class='bx bxs-edit-alt'></i>
                            </a>
                            <a onclick="showConfirmDelete('{{ route('deleteTax', $tax->id) }}')">
                                <i class='bx bxs-trash-alt'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{--  
            |---------------------------------------------------------------|
            |================ Add new Category Overlay =====================|
            |---------------------------------------------------------------|
        --}}

        <div id="overlay"></div>
        {{-- <div class="newtax" id="newTax" action="{{ route('createTax') }}" method="POST" enctype="multipart/form-data"> --}}
        <div class="newtax" id="newTax">
            <h3>Add New Tex</h3>
            <hr>
            <input type="hidden" name="admin_id" value="{{ $id }}">
            <input type="hidden" name="branch_id" value="{{ $branch_id }}">

            <div class="inputdivs">
                <label for="taxName">Tax Name</label>
                <input type="text" id="taxName" name="tax_name" placeholder="GST, Sales Tax..." required>
            </div>

            <div class="inputdivs">
                <label for="taxValue">Tax Value</label>
                <input type="number" id="taxValue" name="tax_value" placeholder="2.5%" min='0' step="0.01"
                    required>
            </div>

            <div class="btns">
                <button id="cancel" onclick="closeAddTax()">Cancel</button>
                <input type="submit" value="Add">
            </div>
        </div>


        {{--   
            |---------------------------------------------------------------|
            |================== Edit Category Overlay ======================|
            |---------------------------------------------------------------|
        --}}

        <div id="editOverlay"></div>
        <form class="updateTax" id="updateTax" action="{{ route('updateTax') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <h3>Update Tax</h3>
            <hr>
            <input type="hidden" name="tax_id" id="taxId">
            <div class="inputdivs">
                <label for="taxName">Tax Name</label>
                <input type="text" id="editTaxName" name="tax_name" placeholder="GST, Sales Tax..." required>
            </div>

            <div class="inputdivs">
                <label for="taxValue">Tax Value</label>
                <input type="number" id="editTaxValue" name="tax_value" placeholder="2.5%" min='0' step="0.01"
                    required>
            </div>

            <div class="btns">
                <button id="cancel" onclick="closeEditTax()">Cancel</button>
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
            <h3 id="message-text">Are you sure you want to delete this tax</h3>
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
            $('#taxTable').DataTable({
                "paging": true,
                "lengthMenu": [5, 10, 25, 50, 100]
            });
        });

        function addTax() {
            let overlay = document.getElementById('overlay');
            let popup = document.getElementById('newTax');
            overlay.style.display = 'block';
            popup.style.display = 'flex';
        }

        function closeAddTax() {
            let overlay = document.getElementById('overlay');
            let popup = document.getElementById('newTax');
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

        function editTax(tax) {
            tax = JSON.parse(tax);
            console.log(tax);
            console.log(tax.tax_name);
            let overlay = document.getElementById('editOverlay');
            let popup = document.getElementById('updateTax');
            overlay.style.display = 'block';
            popup.style.display = 'flex';
            document.getElementById('taxId').value = tax.id;
            document.getElementById('editTaxName').value = tax.tax_name;
            document.getElementById('editTaxValue').value = tax.tax_value;
        }

        function closeEditTax() {
            let overlay = document.getElementById('editOverlay');
            let popup = document.getElementById('updateTax');
            overlay.style.display = 'none';
            popup.style.display = 'none';
        }
    </script>
@endsection

