@extends('layouts.app')
@section('title', __('expense.expense_categories'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @lang( 'expense.expense_categories' )
    </h1>
</section>

<!-- Main content -->
<section class="content">
    @component('components.widget', ['class' => 'box-primary w3-display-container w3-padding', 'title' => ''])
        
            <div class=" w3-display-topright">
                <button type="button" class="add_btn btn-modal" 
                data-href="{{action('ExpenseCategoryController@create')}}" 
                data-container=".expense_category_modal">
                <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
            </div>
            <br>
            <br>
            <br> 
        <div class="table-responsive w3-light-gray">
            <table data-title="{{ __( 'expense.all_your_expense_categories' ) }}" class="table table-bordered table-striped" id="expense_category_table">
                <thead>
                    <tr>
                        <th>@lang( 'expense.category_name' )</th>
                        <th>@lang( 'expense.category_code' )</th>
                        <th>@lang( 'messages.action' )</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endcomponent

    <div class="modal fade expense_category_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection
