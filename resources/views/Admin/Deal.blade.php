@extends('Components.Admin')
@section('title', 'Crust - House | Admin - Deals')
@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Admin/deal.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
<style>
    #dealsTable_paginate,
    #dealsTable_filter,
    .dataTables_length,
    .dataTables_info {
        margin: 0.5vw 7vw !important;
        font-size: 0.8rem !important;
    }

    #dealsTable_next,
    #dealsTable_previous,
    #dealsTable_paginate span a {
        margin: 0.5vw !important;
        padding: 0 !important;
        font-size: 0.8rem
    }

    table.dataTable {
        border-collapse: collapse !important;
    }
</style>
@section('main')
    <main id="deal">
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
            $allDealProducts = $dealProducts;
            $dealsData = $dealsData;
            $branch_id = session('branch_id');
            $user_id = session('id');
        @endphp

        <div class="addnewDeal">
            <button onclick="addDeal()">Add New Deal</button>
        </div>

        <table id="dealsTable">
            <thead>
                <tr>
                    <th>Deal Image</th>
                    <th>Deal Title</th>
                    <th>Deal Status</th>
                    <th>Deal Price</th>
                    <th>Deal End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dealsData as $deal)
                    <tr>
                        <td onclick="showDealInfo({{ json_encode($deal) }}, {{ json_encode($allDealProducts) }} )">
                            <img src={{ asset('Images/DealImages/' . $deal->dealImage) }} alt=" Deal Image">
                        </td>
                        <td onclick="showDealInfo({{ json_encode($deal) }}, {{ json_encode($allDealProducts) }})">
                            {{ $deal->dealTitle }}</td>

                        <td onclick="showDealInfo({{ json_encode($deal) }}, {{ json_encode($allDealProducts) }})">
                            <p class="status">{{ $deal->dealStatus }}</p>
                        </td>

                        <td onclick="showDealInfo({{ json_encode($deal) }}, {{ json_encode($allDealProducts) }})">
                            {{ $deal->dealDiscountedPrice }}</td>

                        <td onclick="showDealInfo({{ json_encode($deal) }}, {{ json_encode($allDealProducts) }})">
                            {{ $deal->dealEndDate }}</td>

                        <td>
                            <a id="editButton"
                                onclick= "editDeal({{ json_encode($user_id) }},{{ json_encode($branch_id) }},{{ json_encode($deal) }}, {{ json_encode($allDealProducts) }})"><i
                                    class='bx bxs-edit-alt'></i></a>
                            <a onclick="showConfirmDelete('{{ route('deleteDeal', $deal->id) }}')"><i
                                    class='bx bxs-trash-alt'></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{--  
            |---------------------------------------------------------------|
            |==================== Add new Deal Overlay =====================|
            |---------------------------------------------------------------|
        --}}

        <div id="overlay"></div>
        <form class="newdeal" id="newDeal" action="{{ route('createDeal') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <h3>Add New Deal</h3>
            <hr>

            <input type="hidden" name="branch_id" value="{{ $branch_id }}">
            <input type="hidden" name="user_id" value="{{ $user_id }}">

            <div class="inputdivs">
                <label for="upload-file" class="choose-file-btn">
                    <span>Choose File</span>
                    <input type="file" id="upload-file" name="dealImage" accept=".jpg,.jpeg,.png" required>
                    <p id="filename"></p>
                </label>
            </div>

            <div class="inputdivs">
                <label for="dealTitle">Deal Title</label>
                <input type="text" id="dealTitle" name="dealTitle" placeholder="Deal title" required>
            </div>

            <div class="inputdivs">
                <label for="dealStatus">Deal Status</label>
                <select name="dealStatus" id="dealStatus">
                    <option value="" selected disabled>Select Stauts</option>
                    <option value="active">Active</option>
                    <option value="not active">Not Active</option>
                </select>
            </div>

            <div class="inputdivs">
                <label for="dealEndDate">Deal End Date</label>
                <input type="date" id="dealEndDate" name="dealEndDate" required>
            </div>

            <div class="btns">
                <button id="cancel" onclick="closeAddDeal()">Cancel</button>
                <input type="submit" value="Add Deal">
            </div>

        </form>

        {{--  
            |---------------------------------------------------------------|
            |====================== Edit Deal Overlay ======================|
            |---------------------------------------------------------------|
            --}}


        @if (session('deals') && session('deal'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let deal = {!! json_encode(session('deal')) !!};
                    let deals = {!! json_encode($allDealProducts) !!};
                    editDeal(deal, deals);
                });
            </script>
        @endif

        <div id="editOverlay"></div>
        <form class="editdeal" id="editDeal" action="{{ route('updateDeal') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div id="form-div">
                <h3>Edit Deal</h3>
                <hr>

                @php
                    $dealID = null;
                @endphp
                <input type="hidden" id="d-Id" name="dId">

                <input type="hidden" name="branch_id" value="{{ $branch_id }}">
                <input type="hidden" name="user_id" value="{{ $user_id }}">

                <div class="inputdivs">
                    <label for="upload-update-file" class="choose-file-btn">
                        <span>Choose File</span>
                        <input type="file" id="upload-update-file" name="dealImage" accept=".jpg,.jpeg,.png">
                        <p id="namefile"></p>
                    </label>
                </div>

                <div class="inputdivs">
                    <label for="deal-Title">Deal Title</label>
                    <input type="text" id="deal-Title" name="dealTitle" required>
                </div>

                <div class="inputdivs">
                    <label for="deal-price">Deal Discounted Price</label>
                    <input type="number" id="deal-price" name="dealprice" min="1" required>
                </div>

                <div class="inputdivs">
                    <label for="deal-Status">Deal Status</label>
                    <select name="dealStatus" id="deal-Status">
                        <option value="" selected disabled>Select Stauts</option>
                        <option value="active">Active</option>
                        <option value="not active">Not Active</option>
                    </select>
                </div>

                <div class="inputdivs">
                    <label for="deal-End-Date">Deal End Data</label>
                    <input type="date" id="deal-End-Date" name="dealEndDate" required>
                </div>
            </div>

            <hr id="line">

            <div id="product_details_tables">
                <table id="products_table">
                    <thead id="header">
                        <tr id="header-row">
                            <th class="header-row-headings">Products</th>
                            <th class="header-row-headings">Variation</th>
                            <th class="header-row-headings">Product Price</th>
                            <th class="header-row-headings">Quantity</th>
                            <th class="header-row-headings">Action</th>
                        </tr>
                    </thead>
                    <tbody id="body">
                    </tbody>
                </table>
            </div>

            <div class="btns">
                <p id="priceTag">Actual Price: <span id="price"></span></p>
                <button type="button" id="cancel" onclick="closeEditCatogry()">Cancel</button>
                <a id="add-product-link" style="text-decoration: none;"><input type="button" value="Add Product"></a>
                <input type="submit" value="Edit">
            </div>
        </form>

        {{--  
            |---------------------------------------------------------------|
            |================= On click deal Information ===================|
            |---------------------------------------------------------------|
        --}}

        <div id="dealInfoOverlay"></div>
        <div class="dealInfo" id="dealInfo">
            <h3>Deal Information</h3>
            <hr>

            <div class="imgdiv">
                <img id="dealInfoImage" alt="deal Image">
            </div>

            <div class="infodiv">
                <p id="dealInfoTitle"></p>
                <p id="dealInfoPrice"></p>
                <p id="dealInfoStatus"></p>
                <p id="dealInfoProducts"></p>
                <p id="dealInfoEndDate"></p>
            </div>

            <div class="btns" style="justify-content: center">
                <button id="cancel" onclick="hideDealInfo()" style="background-color: #ffbb00;">Close</button>
            </div>
        </div>

        {{--   
            |---------------------------------------------------------------|
            |===================== Confirm deletion ========================|
            |---------------------------------------------------------------|
        --}}
        <div id="confirmDeletionOverlay"></div>
        <div class="confirmDeletion" id="confirmDeletion">
            <h3 id="message-text">Are you sure you want to delete this Deal</h3>
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
            $('#dealsTable').DataTable({
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

        function addDeal() {
            let overlay = document.getElementById('overlay');
            let popup = document.getElementById('newDeal');

            overlay.style.display = 'block';
            popup.style.display = 'flex';


            let currentDate = new Date();
            let formattedDate = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2) + '-' + (
                '0' + currentDate.getDate()).slice(-2);
            document.getElementById('dealEndDate').min = formattedDate;
        }

        function closeAddDeal() {
            let overlay = document.getElementById('overlay');
            let popup = document.getElementById('newDeal');

            overlay.style.display = 'none';
            popup.style.display = 'none';
        }

        function editDeal(user_id, branch_id, Deal, dealProducts) {
            let overlay = document.getElementById('editOverlay');
            let popup = document.getElementById('editDeal');
            overlay.style.display = 'block';
            popup.style.display = 'flex';

            document.getElementById('d-Id').value = Deal.id;
            document.getElementById('deal-Title').value = Deal.dealTitle;
            document.getElementById('deal-price').value = Deal.dealDiscountedPrice.replace(/\sPkr$/, "");
            document.getElementById('deal-Status').value = Deal.dealStatus;
            document.getElementById('deal-End-Date').value = Deal.dealEndDate;

            let totalProductPrice = 0;
            let dealId = Deal.id;

            let route = `{{ route('viewUpdateDealProductsPage', ['id' => ':dealId', 'branch_id' => ':branchId']) }}`;
            let addroute = route.replace(':dealId', dealId).replace(':branchId', branch_id);
            document.getElementById('add-product-link').setAttribute('href', addroute);

            let tbody = document.getElementById('body');
            tbody.innerHTML = '';
            dealProducts.forEach(product => {

                if (Deal.id === product.deal_id) {
                    console.log(product);
                    let newRow = document.createElement('tr');
                    newRow.setAttribute('id', 'body-row');

                    let productNameCell = document.createElement('td');
                    productNameCell.setAttribute('class', 'body-row-data');
                    productNameCell.textContent = product.productName;
                    newRow.appendChild(productNameCell);

                    let variationCell = document.createElement('td');
                    variationCell.setAttribute('class', 'body-row-data');
                    variationCell.textContent = product.productVariation;
                    newRow.appendChild(variationCell);

                    let priceCell = document.createElement('td');
                    priceCell.setAttribute('class', 'body-row-data');
                    priceCell.textContent = product.product_total_price;
                    newRow.appendChild(priceCell);

                    let productPrice = parseInt(product.product_total_price.replace(' Pkr', ''));
                    totalProductPrice += productPrice;

                    let quantityCell = document.createElement('td');
                    quantityCell.setAttribute('class', 'body-row-data');
                    quantityCell.textContent = product.product_quantity;
                    newRow.appendChild(quantityCell);

                    let actionCell = document.createElement('td');
                    actionCell.setAttribute('class', 'body-row-data');
                    let deleteLink = document.createElement('a');

                    let productId = product.handler_id;
                    let dealId = Deal.id;
                    let route =
                        `{{ route('deleteDealProduct', [':productId', ':dealId', ':userId', ':branchId']) }}`;
                    route = route.replace(':productId', productId).replace(':dealId', dealId).replace(':userId',
                        user_id).replace(':branchId', branch_id);
                    deleteLink.setAttribute('href', route);

                    let trashIcon = document.createElement('i');
                    trashIcon.setAttribute('class', 'bx bxs-trash-alt');

                    deleteLink.appendChild(trashIcon);
                    actionCell.appendChild(deleteLink);
                    newRow.appendChild(actionCell);

                    tbody.appendChild(newRow);
                }
            });
            document.getElementById('price').textContent = totalProductPrice + " Pkr";
        }

        function closeEditCatogry() {
            let overlay = document.getElementById('editOverlay');
            let popup = document.getElementById('editDeal');

            overlay.style.display = 'none';
            popup.style.display = 'none';
        }

        function showDealInfo(deal, dealProducts) {
            let overlay = document.getElementById('dealInfoOverlay');
            let popup = document.getElementById('dealInfo');

            let productsInfo = '';
            dealProducts.forEach(product => {
                if (deal.id === product.deal_id) {
                    productsInfo += `${product.product_quantity} ${product.productName}, `;
                }
            });

            productsInfo = productsInfo.trim().replace(/,+$/, "");

            document.getElementById("dealInfoImage").src = `{{ asset('Images/DealImages/${deal.dealImage}') }}`;
            document.getElementById("dealInfoTitle").innerHTML = deal.dealTitle;
            document.getElementById("dealInfoPrice").innerHTML = deal.dealDiscountedPrice;
            document.getElementById("dealInfoProducts").innerHTML = productsInfo;
            document.getElementById("dealInfoStatus").innerHTML = deal.dealStatus;
            document.getElementById("dealInfoEndDate").innerHTML = deal.dealEndDate;

            overlay.style.display = 'block';
            popup.style.display = 'flex';
        }

        function hideDealInfo() {
            let overlay = document.getElementById('dealInfoOverlay');
            let popup = document.getElementById('dealInfo');

            overlay.style.display = 'none';
            popup.style.display = 'none';
        }

        let texts = document.getElementsByClassName('status');
        Array.from(texts).forEach(text => {
            if (text.textContent.toLowerCase() === "active") {
                text.style.color = '#3FC28A';
                text.style.backgroundColor = '#3FC28A14';
            } else if (text.textContent.toLowerCase() === "not active") {
                text.style.color = '#F45B69';
                text.style.backgroundColor = '#F45B6914';
            }
        });

        const uploadUpdatedFile = document.getElementById('upload-update-file');
        const filenamSpan = document.getElementById('namefile');
        uploadUpdatedFile.addEventListener('change', function(e) {
            const fileNam = this.value.split('\\').pop();
            filenamSpan.textContent = fileNam ? fileNam : 'No file chosen';
        });

        const uploadFile = document.getElementById('upload-file');
        const filenameSpan = document.getElementById('filename');
        uploadFile.addEventListener('change', function(e) {
            const fileName = this.value.split('\\').pop();
            filenameSpan.textContent = fileName ? fileName : 'No file chosen';
        });
    </script>
@endsection
