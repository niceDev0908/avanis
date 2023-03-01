@extends('layouts.app')
@section('content')
<div id="layout-wrapper">
    @include('layouts.header')
    @include('layouts.left-sidebar')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Annual Compliance</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Avanis</a></li>
                                    <li class="breadcrumb-item active">Annual Compliance</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <form class="needs-validation" method="post" action="{{ route('annual-compliance-action') }}" id="annualComplianceForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-size-18">
                                @if(Auth::user()->product_type == 'CFP')
                                Identification
                                @else
                                User Details
                                @endif
                            </h5>
                            <div class="card">
                                <div class="card-body">
                                    @include('flash-message')
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-label">Occupation</label>
                                            <input class="form-control" type="text" name="occupation"  id="occupation" value="{{ @$annual_compliance->occupation }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Date of Birth</label>
                                            <div class="input-group" id="datepicker2">
                                                <input class="form-control" type="date" format="yyyy-mm-dd" name="dob" id="dob" 
                                                autocomplete="off" value="{{ @$annual_compliance->dob }}">
                                                <!-- <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" name="dob" id="dob" autocomplete="off" readonly="" value="{{ @$annual_compliance->dob }}">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->
                                                <!--<br /><div id="receivable_date_err"></div>-->
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <?php
                                                $identification_options = getIdentificationOptions();
                                                ?>
                                                <label class="form-label">Identification</label>
                                                <div class="col-md-6">
                                                    <select class="form-select" name="identification_1_option" id="identification_1_option">
                                                        <option value="">Select Identification</option>
                                                        @foreach($identification_options as $key => $value)
                                                        <option value="{{$key}}" @if($key == @$annual_compliance->identification_1_option) selected @endif>{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="file" name="identification_1_file" id="identification_1_file">
                                                    @if(@$annual_compliance->identification_1_file != "")
                                                    <a href="{{ route('annual-compliance-file-download', "identification_1_file") }}" class="btn btn-primary" style="position: absolute; margin-top: -36px; right: 13px;">View</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select class="form-select" name="identification_2_option" id="identification_2_option">
                                                        <option value="">Select Identification</option>
                                                        @foreach($identification_options as $key => $value)
                                                        <option value="{{$key}}" @if($key == @$annual_compliance->identification_2_option) selected @endif>{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="file" name="identification_2_file" id="identification_2_file">
                                                    @if(@$annual_compliance->identification_2_file != "")
                                                    <a href="{{ route('annual-compliance-file-download', "identification_2_file") }}" class="btn btn-primary" style="position: absolute; margin-top: -36px; right: 13px;">View</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select class="form-select" name="identification_3_option" id="identification_3_option">
                                                        <option value="">Select Identification</option>
                                                        @foreach($identification_options as $key => $value)
                                                        <option value="{{$key}}" @if($key == @$annual_compliance->identification_3_option) selected @endif>{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="file" name="identification_3_file" id="identification_3_file">
                                                    @if(@$annual_compliance->identification_3_file != "")
                                                    <a href="{{ route('annual-compliance-file-download', "identification_3_file") }}" class="btn btn-primary" style="position: absolute; margin-top: -36px; right: 13px;">View</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-size-18">
                                Company Details
                                @if(Auth::user()->product_type == 'CFP')
                                (if applicable)
                                @endif
                            </h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Company / Partnership Name</label>
                                            <input class="form-control" type="text" name="company_name" id="company_name" value="{{ @$annual_compliance->company_name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Company Address</label>
                                            <input class="form-control" type="text" name="company_address" id="company_address" value="{{ @$annual_compliance->company_address }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">No. of Directors</label>
                                            <input class="form-control" type="text" name="no_of_directors" id="no_of_directors" value="{{ @$annual_compliance->no_of_directors }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">No. of Shareholders</label>
                                            <input class="form-control" type="text" name="no_of_shareholders" id="no_of_shareholders" value="{{ @$annual_compliance->no_of_shareholders }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">No. of Beneficial Owners</label>
                                            <input class="form-control" type="text" name="no_of_beneficial_owners" id="no_of_beneficial_owners" value="{{ @$annual_compliance->no_of_beneficial_owners }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Client Share of the Business</label>
                                            <input class="form-control" type="text" name="client_share_of_business" id="client_share_of_business" value="{{ @$annual_compliance->client_share_of_business }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Company Year End</label>
                                            <input class="form-control" type="text" name="company_year_end" id="company_year_end" value="{{ @$annual_compliance->company_year_end }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Certificate of Incorporation</label>
                                            <input class="form-control" type="file" name="certificate_of_incorporation" id="certificate_of_incorporation">
                                            @if(@$annual_compliance->certificate_of_incorporation != "")
                                            <a href="{{ route('annual-compliance-file-download', "certificate_of_incorporation") }}" class="btn btn-primary" style="position: absolute; margin-top: -36px; right: 13px;">View</a>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Memorandum & Articles</label>
                                            <input class="form-control" type="file" name="memorandum_and_articles" id="memorandum_and_articles">
                                            @if(@$annual_compliance->memorandum_and_articles != "")
                                            <a href="{{ route('annual-compliance-file-download', "memorandum_and_articles") }}" class="btn btn-primary" style="position: absolute; margin-top: -36px; right: 13px;">View</a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Current Appointment Reports</label>
                                            <input class="form-control" type="file" name="current_appointments" id="current_appointments">
                                            @if(@$annual_compliance->current_appointments != "")
                                            <a href="{{ route('annual-compliance-file-download', "current_appointments") }}" class="btn btn-primary" style="position: absolute; margin-top: -36px; right: 13px;">View</a>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Latest Report & Accounts</label>
                                            <input class="form-control" type="file" name="latest_reports_and_accounts" id="latest_reports_and_accounts">
                                            @if(@$annual_compliance->latest_reports_and_accounts != "")
                                            <a href="{{ route('annual-compliance-file-download', "latest_reports_and_accounts") }}" class="btn btn-primary" style="position: absolute; margin-top: -36px; right: 13px;">View</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-size-18">PMC Details</h5>
                            <div class="card">
                                <div class="card-body">
                                    @include('flash-message')
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">PMC Name</label>
                                            <input class="form-control" type="text" name="pmc_name" id="pmc_name" value="{{ @$annual_compliance->pmc_name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">PMC Address</label>
                                            <input class="form-control" type="text" name="pmc_address"  id="pmc_address" value="{{ @$annual_compliance->pmc_address }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">PMC Bank Name</label>
                                            <input class="form-control" type="text" name="pmc_bank_name" id="pmc_bank_name" value="{{ @$annual_compliance->pmc_bank_name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">PMC Account Name</label>
                                            <input class="form-control" type="text" name="pmc_account_name" id="pmc_account_name" value="{{ @$annual_compliance->pmc_account_name }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Sort Code</label>
                                            <input class="form-control" type="text" name="pmc_sort_code" id="pmc_sort_code" value="{{ @$annual_compliance->pmc_sort_code }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Account Number</label>
                                            <input class="form-control" type="text" name="pmc_account_number" id="pmc_account_number" value="{{ @$annual_compliance->pmc_account_number }}">
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-md-4">
                                            <label class="form-label">Certificate of Incorporation</label>
                                            <input class="form-control" type="file" name="pmc_certificate_of_incorporation" id="pmc_certificate_of_incorporation">
                                            @if(@$annual_compliance->pmc_certificate_of_incorporation != "")
                                            <a href="{{ route('annual-compliance-file-download', "pmc_certificate_of_incorporation") }}" class="btn btn-primary" style="position: absolute; margin-top: -36px; right: 13px;">View</a>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Memorandum & Articles</label>
                                            <input class="form-control" type="file" name="pmc_memorandum_and_articles" id="pmc_memorandum_and_articles">
                                            @if(@$annual_compliance->pmc_memorandum_and_articles != "")
                                            <a href="{{ route('annual-compliance-file-download', "pmc_memorandum_and_articles") }}" class="btn btn-primary" style="position: absolute; margin-top: -36px; right: 13px;">View</a>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Current Appointment Reports</label>
                                            <input class="form-control" type="file" name="pmc_current_appointments" id="pmc_current_appointments">
                                            @if(@$annual_compliance->pmc_current_appointments != "")
                                            <a href="{{ route('annual-compliance-file-download', "pmc_current_appointments") }}" class="btn btn-primary" style="position: absolute; margin-top: -36px; right: 13px;">View</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->product_type == 'CFP')
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-size-18">Others</h5>
                            <div class="card">
                                <div class="card-body">
                                    @include('flash-message')
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">USDC (erc20) Wallet Address</label>
                                            <input class="form-control" type="text" name="usdc_wallet_address" id="usdc_wallet_address" 
                                            value="{{ @$annual_compliance->usdc_wallet_address }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row mb-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-4 text-center">
                                    <button class="btn btn-primary waves-effect waves-light loaderClass" type="submit">Save</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function () {
        $('.loaderClass').click(function() {
            $('.avanisLoader').show();
        });
    });
</script>
@endsection