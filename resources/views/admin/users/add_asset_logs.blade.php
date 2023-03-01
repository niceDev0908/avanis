<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="assetLogsTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Type of Cryptocurrency</th>
                        <th>Quantity Held</th>
                        <th>Currency</th>
                        <th>Current Price Per Unit</th>
                        <th>Total Value of Holdings</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    @if (count($asset_logs) > 0)
                        @foreach ($asset_logs as $key => $v)
                            <?php 
                                $currency = $v->currency;
                                if($currency == 'pound'){
                                    $currency_value = 'Pound £';
                                }else if($currency == 'dollar') {
                                    $currency_value = 'Dollar $';
                                }else if($currency == 'euro') {
                                    $currency_value = 'Euro €';
                                }
                            ?>
                            <tr id="row_{{$v->id}}">
                                <td>{{$v->description}}</td>
                                <td>{{$v->value}}</td>
                                <td>{{$currency_value}}</td>
                                <td>{{$v->current_price_per_unit ? $v->current_price_per_unit : ''}}</td>
                                <td>{{$v->total_value_of_holding ? $v->total_value_of_holding : ''}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info alert-dismissible fade show mb-5" role="alert">
                                    <i class="mdi mdi-alert-circle-outline me-2"></i>
                                    There are no logs.
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>