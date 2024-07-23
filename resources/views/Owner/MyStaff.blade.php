@extends('Components.Owner')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Owner/myStaff.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
<style>
    #staffTable_paginate,
    #staffTable_filter,
    .dataTables_length,
    .dataTables_info {
        margin: 0.5vw 7vw !important;
        font-size: 0.8rem !important;
    }

    #staffTable_next,
    #staffTable_previous,
    #staffTable_paginate span a {
        margin: 0.5vw !important;
        padding: 0 !important;
        font-size: 0.8rem
    }

    table.dataTable {
        border-collapse: collapse !important;
    }
</style>
@section('main')
    <main id="myStaff">

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
            $branches = $branches;
        @endphp
        <div style="margin-top:1vw;" class="headings">
            <h3>My Staff</h3>
            <button onclick="addStaff()">Add New Staff Member</button>
        </div>

        <table id="staffTable">
            <thead>
                <tr>
                    <th>Profile Picture</th>
                    <th>Member Name</th>
                    <th>Email Address</th>
                    <th>Role</th>
                    <th>Branch Id</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Staff as $staffdata)
                    @if (strtolower($staffdata->role) !== 'owner')
                        <tr>
                            <td><img src={{ asset('Images/UsersImages/' . $staffdata->profile_picture) }} alt="Image">
                            </td>
                            <td>{{ $staffdata->name }}</td>
                            <td>{{ $staffdata->email }}</td>
                            <td>{{ $staffdata->role }}</td>
                            <td>{{ $staffdata->branch_id }}</td>
                            <td>
                                <a onclick="editStaff({{ json_encode($staffdata) }})"><i class='bx bxs-edit-alt'></i></a>
                                <a onclick="showConfirmDelete('{{ route('deleteStaffData', $staffdata->id) }}')"><i
                                        class='bx bxs-trash-alt'></i></a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        {{--  
            |---------------------------------------------------------------|
            |================== Add new Staff Overlay ======================|
            |---------------------------------------------------------------|
        --}}

        <div id="overlay"></div>
        <form action="{{ route('storeRegistrationData') }}" class="addNewUser" id="addNewUser" method="post"
            enctype="multipart/form-data">
            @csrf
            <h3>Add New Staff Member</h3>

            <div class="inputdivs">
                <label for="upload-file" class="choose-file-btn">
                    <span>Choose File</span>
                    <input type="file" id="upload-file" name="profile_picture" accept=".jpg,.jpeg,.png" required>
                    <p id="filename"></p>
                </label>
            </div>

            <div class="inputdivs">
                <label for="name">Enter Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Name" required>
            </div>

            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="inputdivs">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter Email Address" required>
            </div>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="inputdivs">
                <label for="branch">Select Branch</label>
                <select name="branch" id="branch">
                    <option value="none" selected disabled>Select Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->branchName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="inputdivs">
                <label for="role">Select Status</label>
                <select name="role" id="role">
                    <option value="" selected disabled>Select the Role</option>
                    <option value="admin">Admin</option>
                    <option value="salesman">Sales Man</option>
                    <option value="chef">Chef</option>
                </select>
            </div>

            <div class="inputdivs">
                <label for="password">Password</label>
                <div class="passwordfield">
                    <input type="password" id="password" name="password" placeholder="Password"
                        oninput="validatePassword()" required>
                    <i class='bx bxs-lock-alt' onclick="showAndHidePswd()"></i>
                </div>
            </div>

            <div class="inputdivs">
                <label for="cnfrmPswd">Confirm Password</label>
                <div class="passwordfield">
                    <input type="password" id="cnfrmPswd" name="password_confirmation" oninput="validatePassword()"
                        placeholder="Confirm Password" required>
                    <i class='bx bxs-lock-alt' onclick="showAndHideCnfrmPswd()"></i>
                </div>
            </div>
            <div id="message" class="error"></div>
            @error('password')
                <div onload="addStaff()" class="error-message">{{ $message }}</div>
            @enderror

            <div class="btns">
                <button id="cancel" type="button" onclick="closeAddStaff()">Cancel</button>
                <input type="submit" value="Add Now">
            </div>
        </form>
        {{--  
            |---------------------------------------------------------------|
            |===================== Edit Staff data =========================|
            |---------------------------------------------------------------|
        --}}
        <div id="editOverlay"></div>
        <form class="editstaff" id="editStaff" action="{{ route('updateStaffData') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <h3>Edit Staff Member</h3>
            <input type="hidden" id="staffId" name="staffId">

            <div class="inputdivs">
                <label for="upload-update-file" class="choose-file-btn">
                    <span>Choose File</span>
                    <input type="file" id="upload-update-file" name="updated_profile_picture"
                        accept=".jpg,.jpeg,.png">
                    <p id="namefile"></p>
                </label>
            </div>

            <div class="inputdivs">
                <label for="editname">Member Name</label>
                <input type="text" id="editname" name="name" required>
            </div>

            <div class="inputdivs">
                <label for="editemail">Member Email Address</label>
                <input type="email" id="editemail" name="email" required>
            </div>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="inputdivs">
                <label for="editbranch">Select Branch</label>
                <select name="branch" id="editbranch">
                    <option value="none" selected disabled>Select Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->branchName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="inputdivs">
                <label for="editrole">Member Role</label>
                <select name="role" id="editrole">
                    <option value="" selected disabled>Select the Role</option>
                    <option value="admin">Admin</option>
                    <option value="salesman">Sales Man</option>
                    <option value="chef">Chef</option>
                </select>
            </div>

            <div class="inputdivs">
                <label for="password">Password</label>
                <div class="passwordfield">
                    <input type="password" id="editpassword" oninput="validateEditPassword()" name="password">
                    <i class='bx bxs-lock-alt' onclick="showAndHideEditPswd()"></i>
                </div>
            </div>

            <div class="inputdivs">
                <label for="cnfrmPswd">Confirm Password</label>
                <div class="passwordfield">
                    <input type="password" id="editcnfrmPswd" oninput="validateEditPassword()"
                    name="password_confirmation">
                    <i class='bx bxs-lock-alt' onclick="showAndHideEditCnfrmPswd()"></i>
                </div>
            </div>
            <div id="editMessage" class="error"></div>
            @error('password')
                <div onload="addStaff()" class="error-message">{{ $message }}</div>
            @enderror

            <div class="btns">
                <button type="button" id="Cancel" onclick="closeEditStaff()">Cancel</button>
                <input type="submit" value="Update Staff Data">
            </div>
        </form>

        {{--   
            |---------------------------------------------------------------|
            |===================== Confirm deletion ========================|
            |---------------------------------------------------------------|
        --}}
        <div id="confirmDeletionOverlay"></div>
        <div class="confirmDeletion" id="confirmDeletion">
            <h3 id="message-text">Are you sure you want to delete this Staff Member</h3>
            <div class="box-btns">
                <button id="confirm">Delete</button>
                <button id="close" onclick="closeConfirmDelete()">Close</button>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#staffTable').DataTable({
                    "paging": true,
                    "lengthMenu": [5, 10, 25, 50, 100]
                });
            });

            function addStaff() {
                let overlay = document.getElementById('overlay');
                let popup = document.getElementById('addNewUser');

                overlay.style.display = 'block';
                popup.style.display = 'flex';
            }

            function editStaff(staff) {
                let overlay = document.getElementById('editOverlay');
                let popup = document.getElementById('editStaff');

                document.getElementById('staffId').value = staff.id;
                document.getElementById('editname').value = staff.name;
                document.getElementById('editemail').value = staff.email;

                let branchDropdown = document.getElementById('editbranch');
                for (let option of branchDropdown.options) {
                    if (option.value == staff.branch_id.toString()) {
                        option.selected = true;
                    }
                }

                let roleDropdown = document.getElementById('editrole');
                for (let option of roleDropdown.options) {
                    if (option.value === staff.role) {
                        option.selected = true;
                    }
                }

                overlay.style.display = 'block';
                popup.style.display = 'flex';
            }


            function closeEditStaff() {
                let overlay = document.getElementById('editOverlay');
                let popup = document.getElementById('editStaff');

                overlay.style.display = 'none';
                popup.style.display = 'none';
            }

            function closeAddStaff() {
                let overlay = document.getElementById('overlay');
                let popup = document.getElementById('addNewUser');

                overlay.style.display = 'none';
                popup.style.display = 'none';
            }

            function showAndHidePswd() {
                let pswd = document.getElementById('epassword');
                if (pswd.type === 'password') {
                    pswd.type = 'text';
                } else {
                    pswd.type = 'password';
                }
            }

            function showAndHideEditPswd() {
                let pswd = document.getElementById('editpassword');
                if (pswd.type === 'password') {
                    pswd.type = 'text';
                } else {
                    pswd.type = 'password';
                }
            }

            function showAndHideEditCnfrmPswd() {
                let cnfrmPswd = document.getElementById('editcnfrmPswd');
                if (cnfrmPswd.type === 'password') {
                    cnfrmPswd.type = 'text';
                } else {
                    cnfrmPswd.type = 'password';
                }
            }

            function showAndHideCnfrmPswd() {
                let cnfrmPswd = document.getElementById('cnfrmPswd');
                if (cnfrmPswd.type === 'password') {
                    cnfrmPswd.type = 'text';
                } else {
                    cnfrmPswd.type = 'password';
                }
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

            function validatePassword() {
                let password = document.getElementById('password').value;
                let confirmPassword = document.getElementById('cnfrmPswd').value;
                let message = document.getElementById('message');

                if (password.length < 8) {
                    message.textContent = "Password must be at least 8 characters long!";
                    message.className = "error";
                } else if (password !== confirmPassword) {
                    message.textContent = "Passwords do not match!";
                    message.className = "error";
                } else {
                    message.textContent = "Passwords match!";
                    message.className = "success";
                }
            }

            function validateEditPassword() {
                let password = document.getElementById('editpassword').value;
                let confirmPassword = document.getElementById('editcnfrmPswd').value;
                let message = document.getElementById('editMessage');

                if (password.length < 8) {
                    message.textContent = "Password must be at least 8 characters long!";
                    message.className = "error";
                } else if (password !== confirmPassword) {
                    message.textContent = "Passwords do not match!";
                    message.className = "error";
                } else {
                    message.textContent = "Passwords match!";
                    message.className = "success";
                }
            }

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
    </main>
@endsection
