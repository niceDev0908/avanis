@extends('admin.layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">View Annual Compliance</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.annual-compliance')}}">Annual Compliance</a></li>
                <li class="breadcrumb-item active">
                    View Annual Compliance
                </li>
            </ol>
            <a class="btn btn-dark d-none d-lg-block m-l-15" href="{{ route('admin.annual-compliance') }}">Back</a>
        </div>
    </div>
</div>

@include('admin.flash-message')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form name="frmCreateEdit" id="frmCreateEdit" method="post" action="{{ route('admin.approve-annual-compliance') }}">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$annual_compliance->id}}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        @include('flash-message')
                                        <div class="bg-primary bg-soft p-3 rounded mb-4">
                                            <h5 class="font-size-14 text-white mb-0">User Details</h5>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Date of Birth</label>
                                                <div>{{ getFormatedDate($annual_compliance->dob) }}</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Occupation</label>
                                                <div>{{ $annual_compliance->occupation }}</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Identification</label>

                                                @if($annual_compliance->identification_1_option != "")
                                                <div>
                                                    <label>{{ucfirst(str_replace('_', ' ', $annual_compliance->identification_1_option))}}</label>
                                                    <a href="{{ route('admin-annual-compliance-file-download', ["identification_1_file", $annual_compliance->user_id]) }}" class="btn btn-primary">View</a>
                                                </div><br />
                                                @endif
                                                
                                                @if($annual_compliance->identification_2_option != "")
                                                <div>
                                                    <label>{{ucfirst(str_replace('_', ' ', $annual_compliance->identification_2_option))}}</label>
                                                    <a href="{{ route('admin-annual-compliance-file-download', ["identification_2_file", $annual_compliance->user_id]) }}" class="btn btn-primary">View</a>
                                                </div><br />
                                                @endif
                                                
                                                @if($annual_compliance->identification_3_option != "")
                                                <div>
                                                    <label>{{ucfirst(str_replace('_', ' ', $annual_compliance->identification_3_option))}}</label>
                                                    <a href="{{ route('admin-annual-compliance-file-download', ["identification_3_file", $annual_compliance->user_id]) }}" class="btn btn-primary">View</a>
                                                </div><br />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="bg-primary bg-soft p-3 rounded mb-4">
                                            <h5 class="font-size-14 text-white mb-0">Company Details</h5>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Company / Partnership Name</label>
                                                <div>{{ $annual_compliance->company_name }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Company Address</label>
                                                <div>{{ $annual_compliance->company_address }}</div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">No. of Directors</label>
                                                <div>{{ $annual_compliance->no_of_directors }}</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">No. of Shareholders</label>
                                                <div>{{ $annual_compliance->no_of_shareholders }}</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">No. of Beneficial Owners</label>
                                                <div>{{ $annual_compliance->no_of_beneficial_owners }}</div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Client Share of the Business</label>
                                                <div>{{ $annual_compliance->client_share_of_business }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Company Year End</label>
                                                <div>{{ $annual_compliance->company_year_end }}</div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Certificate of Incorporation</label>
                                                @if($annual_compliance->certificate_of_incorporation != "")
                                                <div>
                                                    <a href="{{ route('admin-annual-compliance-file-download', ["certificate_of_incorporation", $annual_compliance->user_id]) }}" class="btn btn-primary">View</a>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Memorandum & Articles</label>
                                                @if($annual_compliance->memorandum_and_articles != "")
                                                <div>
                                                    <a href="{{ route('admin-annual-compliance-file-download', ["memorandum_and_articles", $annual_compliance->user_id]) }}" class="btn btn-primary">View</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Current Appointment Reports</label>
                                                @if($annual_compliance->current_appointments != "")
                                                <div>
                                                    <a href="{{ route('admin-annual-compliance-file-download', ["current_appointments", $annual_compliance->user_id]) }}" class="btn btn-primary">View</a>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Latest Report & Accounts</label>
                                                @if($annual_compliance->latest_reports_and_accounts != "")
                                                <div>
                                                    <a href="{{ route('admin-annual-compliance-file-download', ["latest_reports_and_accounts", $annual_compliance->user_id]) }}" class="btn btn-primary">View</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        @include('flash-message')
                                        <div class="bg-primary bg-soft p-3 rounded mb-4">
                                            <h5 class="font-size-14 text-white mb-0">PMC Details</h5>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">PMC Name</label>
                                                <div>{{ $annual_compliance->pmc_name }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">PMC Address</label>
                                                <div>{{ $annual_compliance->pmc_address }}</div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">PMC Bank Name</label>
                                                <div>{{ $annual_compliance->pmc_bank_name }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">PMC Account Name</label>
                                                <div>{{ $annual_compliance->pmc_account_name }}</div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Sort Code</label>
                                                <div>{{ $annual_compliance->pmc_sort_code }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Account Number</label>
                                                <div>{{ $annual_compliance->pmc_account_number }}</div>
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Certificate of Incorporation</label>
                                                @if($annual_compliance->pmc_certificate_of_incorporation != "")
                                                <div>
                                                    <a href="{{ route('admin-annual-compliance-file-download', ["pmc_certificate_of_incorporation", $annual_compliance->user_id]) }}" class="btn btn-primary">View</a>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Memorandum & Articles</label>
                                                @if($annual_compliance->pmc_memorandum_and_articles != "")
                                                <div><a href="{{ route('admin-annual-compliance-file-download', ["pmc_memorandum_and_articles", $annual_compliance->user_id]) }}" class="btn btn-primary">View</a></div>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Current Appointment Reports</label>
                                                @if($annual_compliance->pmc_current_appointments != "")
                                                <div>
                                                    <a href="{{ route('admin-annual-compliance-file-download', ["pmc_current_appointments", $annual_compliance->user_id]) }}" class="btn btn-primary">View</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Approve</button>
                            <a class="btn btn-dark" href="{{ route('admin.annual-compliance') }}">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/admin/user.js')}}"></script>
@endsection