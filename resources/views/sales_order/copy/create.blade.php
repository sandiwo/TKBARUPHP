@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.copy.create.title')
@endsection

@section('page_title')
    <span class="fa fa-copy fa-fw"></span>&nbsp;@lang('sales_order.copy.create.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.copy.create.page_title_desc')
@endsection

@section('breadcrumbs')
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="soCopyVue">
        {!! Form::model($soToBeCopied, ['method' => 'POST', 'route' => ['db.so.copy.create', $soCode], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.copy.create.box.customer')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputCustomerType"
                                       class="col-sm-2 control-label">@lang('sales_order.copy.create.field.customer_type')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly
                                           value="@lang('lookup.'.$soToBeCopied->customer_type)">
                                </div>
                            </div>
                            @if($soToBeCopied->customer_type == 'CUSTOMERTYPE.R')
                                <div class="form-group">
                                    <label for="inputCustomerId"
                                           class="col-sm-2 control-label">@lang('sales_order.copy.create.field.customer_name')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $soToBeCopied->customer->name }}">
                                    </div>
                                    <div class="col-sm-1">
                                        <button id="customerDetailButton" type="button"
                                                class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#customerDetailModal_0"><span
                                                    class="fa fa-info-circle fa-lg"></span></button>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="inputCustomerName"
                                           class="col-sm-2 control-label">@lang('sales_order.copy.create.field.customer_name')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $soToBeCopied->walk_in_cust }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCustomerDetails"
                                           class="col-sm-2 control-label">@lang('sales_order.copy.create.field.customer_details')</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="5" readonly>{{ $soToBeCopied->walk_in_cust_detail }}</textarea>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.copy.create.box.sales_order_detail')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSoCode"
                                       class="col-sm-3 control-label">@lang('sales_order.copy.create.field.so_code')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly
                                           value="{{ $soToBeCopied->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSoCopyCode"
                                       class="col-sm-3 control-label">@lang('sales_order.copy.create.field.so_copy_code')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="code" value="{{ $soCopyCode }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSoType"
                                       class="col-sm-3 control-label">@lang('sales_order.copy.create.field.so_type')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly
                                           value="@lang('lookup.'.$soToBeCopied->so_type)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSoDate"
                                       class="col-sm-3 control-label">@lang('sales_order.copy.create.field.so_date')</label>
                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputSoDate" name="so_created" value="" v-model="so.so_created" format="DD-MM-YYYY hh:mm A" readonly="true"></vue-datetimepicker>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.copy.create.box.shipping')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputShippingDate"
                                       class="col-sm-2 control-label">@lang('sales_order.copy.create.field.shipping_date')</label>
                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputShippingDate" name="shipping_date" value="" v-model="so.shipping_date" format="DD-MM-YYYY hh:mm A" readonly="true"></vue-datetimepicker>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarehouse"
                                       class="col-sm-2 control-label">@lang('sales_order.copy.create.field.warehouse')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly
                                           value="{{ $soToBeCopied->warehouse->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking"
                                       class="col-sm-2 control-label">@lang('sales_order.copy.create.field.vendor_trucking')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly
                                           value="{{ empty($soToBeCopied->vendorTrucking->name) ? '':$soToBeCopied->vendorTrucking->name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.copy.create.box.transactions')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-11">
                                    <select id="inputProduct"
                                            class="form-control"
                                            v-model="so.product">
                                        <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                        <option v-for="product in productDDL" v-bind:value="product">@{{ product.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-primary btn-md"
                                            v-on:click="insertProduct(so.product)"><span class="fa fa-plus"/>
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30%">@lang('sales_order.copy.create.table.item.header.product_name')</th>
                                                <th width="15%">@lang('sales_order.copy.create.table.item.header.quantity')</th>
                                                <th width="15%"
                                                    class="text-right">@lang('sales_order.copy.create.table.item.header.unit')</th>
                                                <th width="15%"
                                                    class="text-right">@lang('sales_order.copy.create.table.item.header.price_unit')</th>
                                                <th width="5%">&nbsp;</th>
                                                <th width="20%"
                                                    class="text-right">@lang('sales_order.copy.create.table.item.header.total_price')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, itemIndex) in so.items">
                                                <input type="hidden" name="product_id[]" v-bind:value="item.product.id">
                                                <input type="hidden" name="stock_id[]" v-bind:value="item.stock.id">
                                                <input type="hidden" name="base_unit_id[]"
                                                       v-bind:value="item.base_unit.unit.id">
                                                <td class="valign-middle">@{{ item.product.name }}</td>
                                                <td>
                                                    <input type="text" class="form-control text-right" name="quantity[]"
                                                           v-model="item.quantity" data-parsley-required="true"
                                                           data-parsley-type="number">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="selected_unit_id[]" v-bind:value="item.selected_unit.unit.id">
                                                    <select data-parsley-required="true"
                                                            class="form-control"
                                                            v-model="item.selected_unit">
                                                        <option v-bind:value="{unit: {id: ''}, conversion_value: 1}">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="product_unit in item.product.product_units" v-bind:value="product_unit">@{{ product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' }}</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control text-right" name="price[]"
                                                           v-model="item.price" data-parsley-required="true">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-md"
                                                            v-on:click="removeItem(itemIndex)">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </td>
                                                <td class="text-right valign-middle">
                                                    @{{ numeral(item.selected_unit.conversion_value * item.quantity * item.price).format() }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsTotalListTable" class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td width="80%"
                                                    class="text-right">@lang('sales_order.copy.create.table.total.body.total')</td>
                                                <td width="20%" class="text-right">
                                                    <span class="control-label-normal">@{{ numeral(grandTotal()).format() }}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.create.box.transaction_summary')</h3>
                        </div>
                        <div class="box-body">
                            @for ($i = 0; $i < 23; $i++)
                                <br/>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.copy.create.box.remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputRemarks" class="form-control" rows="5" readonly>{{ $soToBeCopied->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.copy.create.box.so_copy_remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputSoCopyRemarks" name="remarks" class="form-control"
                                                      rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-offset-md-5">
                    <div class="btn-toolbar">
                        <button id="submitButton" type="submit" class="btn btn-primary pull-right">
                            @lang('buttons.submit_button')</button>
                        &nbsp;&nbsp;&nbsp;
                        <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">
                            @lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                        <a id="cancelButton" href="{{ route('db.so.copy.index', $soCode) }}"
                           class="btn btn-primary pull-right" role="button">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}

        @include('sales_order.customer_details_partial')
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        Vue.component('vue-datetimepicker', {
            template: "<input type='text' v-bind:id='id' v-bind:name='name' class='form-control' v-bind:value='value' v-model='value' v-bind:format='format' v-bind:readonly='readonly'>",
            props: ['id', 'name', 'value', 'format', 'readonly'],
            mounted: function() {
                var vm = this;

                if (this.value == undefined) this.value = '';
                if (this.format == undefined) this.format = 'DD-MM-YYYY hh:mm A';
                if (this.readonly == undefined) this.readonly = 'false';

                $(this.$el).datetimepicker({
                    format: this.format,
                    defaultDate: this.value == '' ? moment():moment(this.value),
                    showTodayButton: true,
                    showClose: true
                }).on("dp.change", function(e) {
                    vm.$emit('input', this.value);
                });

                if (this.value == '') { vm.$emit('input', moment().format(this.format)); }
            },
            updated: function() {
                $(this.$el).datetimepicker().data("DateTimePicker").date(this.value);
            },
            destroyed: function() {
                $(this.$el).data("DateTimePicker").destroy();
            }
        });

        var soCopyApp = new Vue({
            el: '#soCopyVue',
            data: {
                currentSo: JSON.parse('{!! htmlspecialchars_decode($soToBeCopied->toJson()) !!}'),
                productDDL: JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}'),
                so: {
                    stock: {id: ''},
                    product: {id: ''},
                    customer: { },
                    items: [],
                },
                soIndex: 0
            },
            mounted: function() {
                var vm = this;

                vm.so.customer = _.cloneDeep(vm.currentSo.customer);
                vm.so.so_created = vm.currentSo.so_created;

                for (var i = 0; i < vm.currentSo.items.length; i++) {
                    vm.so.items.push({
                        stock: {
                            id: vm.currentSo.items[i].stock_id
                        },
                        id: vm.currentSo.items[i].id,
                        product: _.cloneDeep(vm.currentSo.items[i].product),
                        base_unit: _.cloneDeep(_.find(vm.currentSo.items[i].product.product_units, function(unit) { return unit.is_base == 1; })),
                        selected_unit: _.cloneDeep(_.find(vm.currentSo.items[i].product.product_units, function(punit) { return punit.id == vm.currentSo.items[i].selected_unit_id; })),
                        quantity: vm.currentSo.items[i].quantity % 1 != 0 ? parseFloat(vm.currentSo.items[i].quantity).toFixed(1) : parseFloat(vm.currentSo.items[i].quantity).toFixed(0),
                        price: parseFloat(vm.currentSo.items[i].price).toFixed(0)
                    });
                }
            },
            methods : {
                grandTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.so.items, function (item, key) {
                        result += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });
                    return result;
                },
                insertProduct: function (product) {
                    if(product.id != ''){
                        var vm = this;
                        vm.so.items.push({
                            stock_id: 0,
                            product: _.cloneDeep(product),
                            selected_unit: {
                                unit: {
                                    id: ''
                                },
                                conversion_value: 1
                            },
                            base_unit: _.cloneDeep(_.find(product.product_units, isBase)),
                            quantity: 0,
                            price: 0
                        });
                    }
                },
                removeItem: function (index) {
                    this.so.items.splice(index, 1);
                }
            }
        });
    </script>
@endsection