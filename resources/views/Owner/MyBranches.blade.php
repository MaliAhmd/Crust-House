@extends('Components.Owner')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Owner/branches.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
<style>
    #branchTable_paginate,
    #branchTable_filter,
    .dataTables_length,
    .dataTables_info {
        margin: 0.5vw 7vw !important;
        font-size: 0.8rem !important;
    }

    #branchTable_next,
    #branchTable_previous,
    #branchTable_paginate span a {
        margin: 0.5vw !important;
        padding: 0 !important;
        font-size: 0.8rem
    }

    table.dataTable {
        border-collapse: collapse !important;
    }
</style>
@section('main')
    <main id="mybranches">

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
            $owner_id = session('owner_id');
        @endphp
        <div class="newBranch">
            <button type="button" onclick="addNewBranch()">Add New Branch</button>
        </div>

        <table id="branchTable">
            <thead>
                <tr>
                    <th>Branch City</th>
                    <th>Branch Code</th>
                    <th>Branch Name</th>
                    <th>Branch Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branchData as $branch)
                    <tr>
                        <td>{{ $branch->branchLocation }}</td>
                        <td>{{ $branch->branchCode }}</td>
                        <td>{{ $branch->branchName }}</td>
                        <td>{{ $branch->address }}</td>
                        <td>
                            <a onclick="editBranch({{ json_encode($branch) }})"><i class='bx bxs-edit-alt'></i></a>
                            <a onclick="showConfirmDelete('{{ route('deleteBranch', $branch->id) }}')"><i
                                    class='bx bxs-trash-alt'></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{--  
            |---------------------------------------------------------------|
            |================== Add new Branch Overlay =====================|
            |---------------------------------------------------------------|
        --}}

        <div id="addNewBranchOverlay"></div>
        <form id="addNewBranch" action="{{ route('storeNewBranchData') }}" method="Post" enctype="multipart/form-data">
            @csrf
            <h3>Add New Branch</h3>
            <hr>
            <!-- Add this to your addNewBranch form -->
            <input type="hidden" name="owner_id" value="{{$owner_id}}">
            <div class="states-cities inputdivs">
                <div class="states">
                    <label for="branchstate">Select State</label>
                    <select name="branch_state" id="branchstate" required
                        onchange="updateCityOptions('branchstate', 'brancharea')">
                        <option value="" selected>Select State</option>
                        <option value="Capital">Capital</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Sindh">Sindh</option>
                        <option value="KPK">KPK</option>
                        <option value="Balochistan">Balochistan</option>
                    </select>
                </div>

                <div class="cities">
                    <label for="brancharea">Select City</label>
                    <select name="branchArea" id="brancharea" required>
                    </select>
                </div>

            </div>


            <div class="inputdivs">
                <label for="branchname">Branch Name</label>
                <input type="text" name="branchname" id="branchname" placeholder="Branch Name" required>
                @error('branchname')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="inputdivs">
                <label for="branchcode">Branch Code</label>
                <input type="text" name="branchcode" id="branchcode" placeholder="Branch Code" required>
                @error('branchcode')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="inputdivs">
                <label for="address">Branch Address</label>
                <input type="text" name="address" id="address" placeholder="Address" required>
                @error('address')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="inputdivs">
                <label for="options">Select Additional Options</label>
                <div id="options" class="options">
                    <div class="opt">
                        <p class="opt-txt">You want Rider</p>
                        <label class="switch">
                            <input type="checkbox" name="riderOption">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="opt">
                        <p class="opt-txt">You want Online Delivery</p>
                        <label class="switch">
                            <input type="checkbox" name="onlineDeliveryOption">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="opt">
                        <p class="opt-txt">You went Dining Table</p>
                        <label class="switch">
                            <input type="checkbox" name="diningTableOption">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="btns">
                <button type="button" id="cancel" onclick="closeAddNewBranch()">Cancel</button>
                <input type="submit" value="Add Now">
            </div>
        </form>

        {{--  
            |---------------------------------------------------------------|
            |================== Edit new Branch Overlay ====================|
            |---------------------------------------------------------------|
        --}}

        <div id="editBranchOverlay"></div>
        <form id="editBranch" action="{{ route('updateBranches') }}" method="Post" enctype="multipart/form-data">
            @csrf
            <h3>Edit New Branch</h3>
            <hr>

            <input type="hidden" name="branch_id" id="branch_id">

            <div class="states-cities inputdivs">
                <div class="states">
                    <label for="editbranchstate">Select State</label>
                    <select name="branch_state" id="editbranchstate" required
                        onchange="updateCityOptions('editbranchstate', 'editbrancharea')">
                        <option value="" selected>Select State</option>
                        <option value="Capital">Capital</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Sindh">Sindh</option>
                        <option value="KPK">KPK</option>
                        <option value="Balochistan">Balochistan</option>
                    </select>
                </div>

                <div class="cities">
                    <label for="editbrancharea">Select City</label>
                    <select name="branchArea" id="editbrancharea" required>
                        <option value="" selected></option>
                    </select>
                </div>

            </div>

            <div class="inputdivs">
                <label for="editbranchname">Branch Name</label>
                <input type="text" name="branchname" id="editbranchname" placeholder="Branch Name" required>
                @error('editbranchname')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="inputdivs">
                <label for="editbranchcode">Branch Code</label>
                <input type="text" name="branchcode" id="editbranchcode" placeholder="Branch Code" required>
                @error('editbranchcode')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="inputdivs">
                <label for="editaddress">Branch Address</label>
                <input type="text" name="address" id="editaddress" placeholder="Address" required>
                @error('editaddress')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="inputdivs">
                <label for="editoptions">Select Additional Options</label>
                <div id="editoptions" class="options">
                    <div class="opt">
                        <p class="opt-txt">You want Rider</p>
                        <label class="switch">
                            <input type="checkbox" name="riderOption" id="editriderOption">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="opt">
                        <p class="opt-txt">You want Online Delivery</p>
                        <label class="switch">
                            <input type="checkbox" name="onlineDeliveryOption" id="editonlineDeliveryOption">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="opt">
                        <p class="opt-txt">You went Dining Table</p>
                        <label class="switch">
                            <input type="checkbox" name="diningTableOption" id="editdiningTableOption">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="btns">
                <button type="button" id="editcancel" onclick="closeEditBranch()">Cancel</button>
                <input type="submit" value="Update Now">
            </div>
        </form>

        {{--   
            |---------------------------------------------------------------|
            |===================== Confirm deletion ========================|
            |---------------------------------------------------------------|
        --}}
        <div id="confirmDeletionOverlay"></div>
        <div class="confirmDeletion" id="confirmDeletion">
            <h3 id="message-text">Are you sure you want to delete this Branch</h3>
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
            $('#branchTable').DataTable({
                "paging": true,
                "lengthMenu": [5, 10, 25, 50, 100]
            });
        });

        function addNewBranch() {
            const OVERLAY = document.getElementById('addNewBranchOverlay');
            const POPUP = document.getElementById('addNewBranch');
            OVERLAY.style.display = 'block';
            POPUP.style.display = 'flex';
        }

        function closeAddNewBranch() {
            const OVERLAY = document.getElementById('addNewBranchOverlay');
            const POPUP = document.getElementById('addNewBranch');
            OVERLAY.style.display = 'none';
            POPUP.style.display = 'none';
        }

        function editBranch(Branch) {
            const OVERLAY = document.getElementById('editBranchOverlay');
            const POPUP = document.getElementById('editBranch');

            document.getElementById('branch_id').value = Branch.id;
            document.getElementById('editbranchstate').value = Branch.branch_state;
            updateCityOptions('editbranchstate', 'editbrancharea');
            document.getElementById('editbrancharea').value = Branch.branchLocation;
            document.getElementById('editbranchname').value = Branch.branchName;
            document.getElementById('editbranchcode').value = Branch.branchCode;
            document.getElementById('editaddress').value = Branch.address;

            document.getElementById('editriderOption').checked = Branch.riderOption;
            document.getElementById('editonlineDeliveryOption').checked = Branch.onlineDeliveryOption;
            document.getElementById('editdiningTableOption').checked = Branch.DiningTableOption;

            OVERLAY.style.display = 'block';
            POPUP.style.display = 'flex';
        }

        function closeEditBranch() {
            const OVERLAY = document.getElementById('editBranchOverlay');
            const POPUP = document.getElementById('editBranch');
            OVERLAY.style.display = 'none';
            POPUP.style.display = 'none';
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

        const statesWithCities = [{
                stateName: "Capital",
                cities: ["Islamabad"],
            },
            {
                stateName: "Punjab",
                cities: [
                    "Ahmed Nager Chatha",
                    "Ahmadpur East",
                    "Ali Khan Abad",
                    "Alipur",
                    "Arifwala",
                    "Attock",
                    "Bhera",
                    "Bhalwal",
                    "Bahawalnagar",
                    "Bahawalpur",
                    "Bhakkar",
                    "Burewala",
                    "Chillianwala",
                    "Chakwal",
                    "Chichawatni",
                    "Chiniot",
                    "Chishtian",
                    "Daska",
                    "Darya Khan",
                    "Dera Ghazi Khan",
                    "Dhaular",
                    "Dina",
                    "Dinga",
                    "Dipalpur",
                    "Faisalabad",
                    "Ferozewala",
                    "Fateh Jhang",
                    "Ghakhar Mandi",
                    "Gojra",
                    "Gujranwala",
                    "Gujrat",
                    "Gujar Khan",
                    "Hafizabad",
                    "Haroonabad",
                    "Hasilpur",
                    "Haveli Lakha",
                    "Jatoi",
                    "Jalalpur",
                    "Jattan",
                    "Jampur",
                    "Jaranwala",
                    "Jhang",
                    "Jhelum",
                    "Kalabagh",
                    "Karor Lal Esan",
                    "Kasur",
                    "Kamalia",
                    "Kamoke",
                    "Khanewal",
                    "Khanpur",
                    "Kharian",
                    "Khushab",
                    "Kot Addu",
                    "Jauharabad",
                    "Lahore",
                    "Lalamusa",
                    "Layyah",
                    "Liaquat Pur",
                    "Lodhran",
                    "Malakwal",
                    "Mamoori",
                    "Mailsi",
                    "Mandi Bahauddin",
                    "Mian Channu",
                    "Mianwali",
                    "Multan",
                    "Murree",
                    "Muridke",
                    "Mianwali Bangla",
                    "Muzaffargarh",
                    "Narowal",
                    "Nankana Sahib",
                    "Okara",
                    "Renala Khurd",
                    "Pakpattan",
                    "Pattoki",
                    "Pir Mahal",
                    "Qaimpur",
                    "Qila Didar Singh",
                    "Rabwah",
                    "Raiwind",
                    "Rajanpur",
                    "Rahim Yar Khan",
                    "Rawalpindi",
                    "Sadiqabad",
                    "Safdarabad",
                    "Sahiwal",
                    "Sangla Hill",
                    "Sarai Alamgir",
                    "Sargodha",
                    "Shakargarh",
                    "Sheikhupura",
                    "Sialkot",
                    "Sohawa",
                    "Soianwala",
                    "Siranwali",
                    "Talagang",
                    "Taxila",
                    "Toba Tek Singh",
                    "Vehari",
                    "Wah Cantonment",
                    "Wazirabad",
                ],
            },
            {
                stateName: "Sindh",
                cities: [
                    "Badin",
                    "Bhirkan",
                    "Rajo Khanani",
                    "Chak",
                    "Dadu",
                    "Digri",
                    "Diplo",
                    "Dokri",
                    "Ghotki",
                    "Haala",
                    "Hyderabad",
                    "Islamkot",
                    "Jacobabad",
                    "Jamshoro",
                    "Jungshahi",
                    "Kandhkot",
                    "Kandiaro",
                    "Karachi",
                    "Kashmore",
                    "Keti Bandar",
                    "Khairpur",
                    "Kotri",
                    "Larkana",
                    "Matiari",
                    "Mehar",
                    "Mirpur Khas",
                    "Mithani",
                    "Mithi",
                    "Mehrabpur",
                    "Moro",
                    "Nagarparkar",
                    "Naudero",
                    "Naushahro Feroze",
                    "Naushara",
                    "Nawabshah",
                    "Nazimabad",
                    "Qambar",
                    "Qasimabad",
                    "Ranipur",
                    "Ratodero",
                    "Rohri",
                    "Sakrand",
                    "Sanghar",
                    "Shahbandar",
                    "Shahdadkot",
                    "Shahdadpur",
                    "Shahpur Chakar",
                    "Shikarpaur",
                    "Sukkur",
                    "Tangwani",
                    "Tando Adam Khan",
                    "Tando Allahyar",
                    "Tando Muhammad Khan",
                    "Thatta",
                    "Umerkot",
                    "Warah",
                ],
            },
            {
                stateName: "KPK",
                cities: [
                    "Abbottabad",
                    "Adezai",
                    "Alpuri",
                    "Akora Khattak",
                    "Ayubia",
                    "Banda Daud Shah",
                    "Bannu",
                    "Batkhela",
                    "Battagram",
                    "Birote",
                    "Chakdara",
                    "Charsadda",
                    "Chitral",
                    "Daggar",
                    "Dargai",
                    "Darya Khan",
                    "Dera Ismail Khan",
                    "Doaba",
                    "Dir",
                    "Drosh",
                    "Hangu",
                    "Haripur",
                    "Karak",
                    "Kohat",
                    "Kulachi",
                    "Lakki Marwat",
                    "Latamber",
                    "Madyan",
                    "Mansehra",
                    "Mardan",
                    "Mastuj",
                    "Mingora",
                    "Nowshera",
                    "Paharpur",
                    "Pabbi",
                    "Peshawar",
                    "Saidu Sharif",
                    "Shorkot",
                    "Shewa Adda",
                    "Swabi",
                    "Swat",
                    "Tangi",
                    "Tank",
                    "Thall",
                    "Timergara",
                    "Tordher",
                ],
            },
            {
                stateName: "Balochistan",
                cities: [
                    "Awaran",
                    "Barkhan",
                    "Chagai",
                    "Dera Bugti",
                    "Gwadar",
                    "Harnai",
                    "Jafarabad",
                    "Jhal Magsi",
                    "Kacchi",
                    "Kalat",
                    "Kech",
                    "Kharan",
                    "Khuzdar",
                    "Killa Abdullah",
                    "Killa Saifullah",
                    "Kohlu",
                    "Lasbela",
                    "Lehri",
                    "Loralai",
                    "Mastung",
                    "Musakhel",
                    "Nasirabad",
                    "Nushki",
                    "Panjgur",
                    "Pishin Valley",
                    "Quetta",
                    "Sherani",
                    "Sibi",
                    "Sohbatpur",
                    "Washuk",
                    "Zhob",
                    "Ziarat",
                ],
            },
        ];

        function updateCityOptions(stateId, cityId) {
            const stateSelect = document.getElementById(stateId);
            const citySelect = document.getElementById(cityId);
            const selectedState = stateSelect.value;

            citySelect.innerHTML = '<option value="" selected>Select Location</option>';

            const state = statesWithCities.find(s => s.stateName === selectedState);

            if (state) {
                state.cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    citySelect.appendChild(option);
                });
            }
        }
        updateCityOptions('branchstate', 'brancharea');
    </script>
@endsection
