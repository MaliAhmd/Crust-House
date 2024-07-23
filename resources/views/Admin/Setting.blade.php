@extends('Components.Admin')

@section('title', 'Crust - House | Admin - Setting')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Admin/setting.css') }}">
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
            |======================== Tex Overlay ==========================|
            |---------------------------------------------------------------|
            --}}

            <button onclick="texOverlay()">Taxes</button>
            <div id="texOverlay"></div>
            <div id="newTax">
                <h3>Add New Tex</h3>
                <hr>
                @if ($taxes)
                    <div class="container-fields">
                        @foreach ($taxes as $tax)
                            <form id="texFields" action="{{ route('updateTax') }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                <input type="hidden" name="tax_id" value="{{ $tax->id }}">
                                <div class="inputdivs">
                                    <label for="taxName">Tax Name</label>
                                    <input type="text" id="taxName" name="tax_name" value="{{ $tax->tax_name }}"
                                        placeholder="GST, Sales Tax..." required>
                                </div>

                                <div class="inputdivs">
                                    <label for="taxValue">Tax Value</label>
                                    <input type="number" id="taxValue" name="tax_value" value="{{ $tax->tax_value }}"
                                        placeholder="2.5%" min='0' step="0.01" required>
                                </div>
                                <div id="option_button">
                                    <button type="submit">
                                        <i class='bx bxs-edit-alt'></i>
                                    </button>
                                    <button class="deleteTax" type="button"
                                        onclick="showConfirmDelete('{{ route('deleteTax', $tax->id) }}')">
                                        <i class='bx bxs-trash-alt'></i>
                                    </button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                    <form action="{{ route('createTax') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{ $id }}">
                        <input type="hidden" name="branch_id" value="{{ $branch_id }}">
                        <hr>
                        <div id="texFields">
                            <div class="inputdivs">
                                <label for="taxName">Tax Name</label>
                                <input type="text" id="taxName" name="tax_name" placeholder="GST, Sales Tax..."
                                    required>
                            </div>

                            <div class="inputdivs">
                                <label for="taxValue">Tax Value</label>
                                <input type="number" id="taxValue" name="tax_value" placeholder="2.5%" min='0'
                                    step="0.01" required>
                            </div>
                        </div>

                        <div class="forms-btns">
                            <button id="cancel" onclick="closeTax()">Cancel</button>
                            <input class="add" type="submit" value="Add">
                        </div>
                    </form>
                @else
                    <form action="{{ route('createTax') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{ $id }}">
                        <input type="hidden" name="branch_id" value="{{ $branch_id }}">
                        <hr>
                        <div id="texFields">
                            <div class="inputdivs">
                                <label for="taxName">Tax Name</label>
                                <input type="text" id="taxName" name="tax_name" placeholder="GST, Sales Tax..."
                                    required>
                            </div>

                            <div class="inputdivs">
                                <label for="taxValue">Tax Value</label>
                                <input type="number" id="taxValue" name="tax_value" placeholder="2.5%" min='0'
                                    step="0.01" required>
                            </div>
                        </div>

                        <div class="forms-btns">
                            <button id="cancel" onclick="closeTax()">Cancel</button>
                            <input class="add" type="submit" value="Add">
                        </div>
                    </form>
                @endif
            </div>

            {{--  
            |---------------------------------------------------------------|
            |====================== Discount Overlay =======================|
            |---------------------------------------------------------------|
            --}}

            <button onclick="discountOverlay()">Discount</button>
            <div id="discountOverlay"></div>
            <div id="discount">
                <h3>Add New Discount</h3>
                <hr>
                @if ($discounts)
                    <div class="container-fields">
                        @foreach ($discounts as $discount)
                            <form id="texFields" action="{{ route('updateDiscount') }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                <input type="hidden" name="discount_id" value="{{ $discount->id }}">

                                <div style="width: 50%;" class="inputdivs">
                                    <label for="discountReason">update Discount Reason</label>
                                    <input type="text" id="discountReason" name="discount_reason"
                                        placeholder="Family , General,etc..." value="{{ $discount->discount_reason }}"
                                        required>
                                </div>

                                <div id="option_button">
                                    <button type="submit">
                                        <i class='bx bxs-edit-alt'></i>
                                    </button>
                                    <button class="deleteTax" type="button"
                                        onclick="showConfirmDelete('{{ route('deleteDiscount', $discount->id) }}')">
                                        <i class='bx bxs-trash-alt'></i>
                                    </button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                    <form action="{{ route('createDiscount') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{ $id }}">
                        <input type="hidden" name="branch_id" value="{{ $branch_id }}">
                        <hr>
                        <div id="texFields">
                            <div style="width: 50%;" class="inputdivs">
                                <label for="discountReason">Add Discount Reason</label>
                                <input type="text" id="discountReason" name="discount_reason"
                                    placeholder="Family , General,etc..." required>
                            </div>
                        </div>

                        <div class="forms-btns">
                            <button type="button" id="cancel" onclick="closeDiscountOverlay()">Cancel</button>
                            <input class="add" type="submit" value="Add">
                        </div>
                    </form>
                @else
                    <form method="POST" action="{{ route('createDiscount') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{ $id }}">
                        <input type="hidden" name="branch_id" value="{{ $branch_id }}">
                        <hr>
                        <div id="texFields">
                            <div style="width: 50%;" class="inputdivs">
                                <label for="discountReason">Add Discount Reason</label>
                                <input type="text" id="discountReason" name="discount_reason"
                                    placeholder="Family , General,etc..." required>
                            </div>
                        </div>

                        <div class="forms-btns">
                            <button type="button" id="cancel" onclick="closeDiscountOverlay()">Cancel</button>
                            <input class="add" type="submit" value="Add">
                        </div>
                    </form>
                @endif
            </div>

            {{--  
            |---------------------------------------------------------------|
            |================== Receipt Settings Overlay ===================|
            |---------------------------------------------------------------|
            --}}

            <button onclick="receiptOverlay()">Receipt Settings</button>
            <div id="receiptOverlay"></div>
            <div id="receipt">
                <h3>Receipt Settings</h3>
                <hr>
                @if ($receipt->receipt_message !== null)
                    <div class="container-fields">
                        @php
                            $message = $receipt->receipt_message;
                        @endphp
                        <form action="{{ route('updateReceipt') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="receipt_id" value="{{ $receipt->id }}">

                            <div style="width: 95%; margin:auto;" class="inputdivs">
                                <label for="receipt_message">Update Receipt Message</label>
                                <textarea name="receipt_message" id="receipt_message" style="resize: none; text-align: left;" cols="30"
                                    rows="10" required>
                                    {{ $message }}
                                </textarea>
                            </div>

                            <div class="forms-btns">
                                <button type="button" id="cancel" onclick="closeReceiptOverlay()">Cancel</button>
                                <button style="height: 3.5vw;" class="add" type="submit">
                                    Update
                                </button>
                                <button style="height: 3.5vw;" class="deleteTax" type="button"
                                    onclick="showConfirmDelete('{{ route('deleteReceipt', $receipt->id) }}')">
                                    Delete
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <form method="POST" action="{{ route('createReceipt') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{ $id }}">
                        <input type="hidden" name="branch_id" value="{{ $branch_id }}">

                        <div style="width: 95%; margin:auto; justify-content:center;" class="inputdivs">
                            <label for="new_receipt_message">Add Receipt Message</label>
                            <textarea name="receipt_message" id="new_receipt_message" style="resize: none;" cols="10" rows="10"
                                required placeholder="Add Message to Receipt"></textarea>
                        </div>

                        <div class="forms-btns">
                            <button type="button" id="cancel" onclick="closeReceiptOverlay()">Cancel</button>
                            <input class="add" type="submit" value="Add">
                        </div>
                    </form>
                @endif
            </div>
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
        function texOverlay() {
            document.getElementById('texOverlay').style.display = 'block';
            document.getElementById('newTax').style.display = 'flex';
        }

        function closeTax() {
            document.getElementById('texOverlay').style.display = 'none';
            document.getElementById('newTax').style.display = 'none';
        }

        function discountOverlay() {
            document.getElementById('discountOverlay').style.display = 'block';
            document.getElementById('discount').style.display = 'flex';
        }

        function closeDiscountOverlay() {
            document.getElementById('discountOverlay').style.display = 'none';
            document.getElementById('discount').style.display = 'none';
        }

        function receiptOverlay() {
            document.getElementById('receiptOverlay').style.display = 'block';
            document.getElementById('receipt').style.display = 'flex';
        }

        function closeReceiptOverlay() {
            document.getElementById('receiptOverlay').style.display = 'none';
            document.getElementById('receipt').style.display = 'none';
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
    </script>
@endsection
