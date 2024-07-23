@extends('Components.Owner')

@section('title', 'Crust - House | Owner - Report')

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('CSS/Admin/report.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush

@section('main')

    <main id="report" style= "display:flex; justify-content:center;align-items:center; width:99%; height:88%;">
        <h3>Select Branch for reports</h3>
        <div style="display:flex;" id="branch_selection">
            <select name="branch" id="branch" onchange="redirectToBranch(this)">
                <option value="none" selected disabled>Select Branch</option>
                @foreach ($branches as $branch)
                    <option value="">{{ $branch->branchName }}</option>
                @endforeach
            </select>
        </div>

    </main>
@endsection
