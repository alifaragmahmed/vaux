<div class="my-3">
    <div class="input-icons">
        {!! Form::label('essentials_department_id', __('essentials::lang.department') . ':') !!}
        {!! Form::select('essentials_department_id', $departments, !empty($user->essentials_department_id) ? $user->essentials_department_id : null, ['class' => 'custom-select border_select', 'placeholder' => __('messages.please_select') ]); !!}
    </div>
</div>
<div class="my-3">
    <div class="input-icons">
        {!! Form::label('essentials_designation_id', __('essentials::lang.designation') . ':') !!}
        {!! Form::select('essentials_designation_id', $designations, !empty($user->essentials_designation_id) ? $user->essentials_designation_id : null, ['class' => 'custom-select border_select', 'placeholder' => __('messages.please_select') ]); !!}
    </div>
</div>