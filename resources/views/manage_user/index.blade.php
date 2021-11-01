  

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class=" " >
        <i class='fa fa-users w3-xxlarge new-theme-text' style='margin:4px' ></i>
        @lang( 'user.users' ) 
    </h1> 
</section>

<!-- Main content -->
<section class="content new-content">
    @component('components.widget', ['class' => 'box-primary', 'title' => ""])
    @can('user.create')
    @slot('tool')
    <div class="box-tools">
        <a class="add_btn" href="{{action('ManageUserController@create')}}">
            <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
    </div>
    @endslot
    @endcan
    @can('user.view')
    <div class="table-responsive light-gray w3-border w3-border-light-gray"> 

        {{-- <table class="table table-bordered table-striped" id="users_table">
            <thead>
                <tr>
                    <th>@lang( 'business.username' )</th>
                    <th>@lang( 'user.name' )</th>
                    <th>@lang( 'user.role' )</th>
                    <th>@lang( 'business.email' )</th>
                    <th>@lang( 'messages.action' )</th>
                </tr>
            </thead>
        </table> --}}
        <table id="users_table" data-title="{{ __( 'user.users' ) }}" class="custom-datatable table table-striped table-hover" style="width: 100%">
            <thead>
                <tr>
                    <th>@lang( 'business.username' )</th>
                    <th>@lang( 'user.name' )</th>
                    <th>@lang( 'user.role' )</th>
                    <th>@lang( 'business.email' )</th>
                    <th>@lang( 'messages.action' )</th>
                </tr>
            </thead>
        </table>
    </div>
    @endcan
    @endcomponent

    <div class="modal fade user_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->  
