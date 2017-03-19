
    <div class="col-md-9">
        <p>TEMP: {{ session('family') }}</p>
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-users" aria-hidden="true"></i>Family Information
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-6 @if ($errors->has('family_id')) has-error @endif" style="padding-left:0;">
                        {!! Form::label('family_id', 'Select Family') !!}
                        {!! Form::select('family_id', [null => '-- Please Select --'] + $families, null, ['class' => 'form-control', 'id' => 'member-family']) !!}
                        @if ($errors->has('family_id')) <p class="help-block error">{{ $errors->first('family_id') }}</p> @endif
                    </div>
                    <div class="col-sm-6 @if ($errors->has('family_role_id')) has-error @endif" style="padding-right:0;">
                        {!! Form::label('family_role_id', 'Family Role') !!}
                        {!! Form::select('family_role_id', [null => '-- Please Select --'] + $family_roles, null, ['class' => 'form-control']) !!}
                        @if ($errors->has('family_role_id')) <p class="help-block error">{{ $errors->first('family_role_id') }}</p> @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="panel panel-default" style="margin-top:40px;">
            <div class="panel-heading">
                <i class="fa fa-info-circle" aria-hidden="true"></i>Member Info
            </div>
            <div class="panel-body">
                <div class="form-group clearfix">
                    <div class="col-sm-6 @if ($errors->has('first_name')) has-error @endif" style="padding-left:0;">
                        {!! Form::label('first_name', 'First Name') !!}
                        {!! Form::text('first_name', null, ['class' => 'form-control', 'id' => 'member-first-name']) !!}
                        @if ($errors->has('first_name')) <p class="help-block error">{{ $errors->first('first_name') }}</p> @endif
                    </div>

                    <div class="col-sm-6 @if ($errors->has('last_name')) has-error @endif" style="padding-right:0;">
                        {!! Form::label('last_name', 'Last Name') !!}
                        {!! Form::text('last_name', null, ['class' => 'form-control', 'id' => 'member-last-name']) !!}
                        @if ($errors->has('last_name')) <p class="help-block error">{{ $errors->first('last_name') }}</p> @endif
                    </div>
                </div>

                <div class="form-group clearfix">
                    <div class="col-sm-6 @if ($errors->has('email')) has-error @endif" style="padding-left:0;">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'member-email']) !!}
                        @if ($errors->has('email')) <p class="help-block error">{{ $errors->first('email') }}</p> @endif
                    </div>

                    <div class="col-sm-6 @if ($errors->has('mobile')) has-error @endif" style="padding-right:0;">
                        {!! Form::label('mobile', 'Mobile Phone') !!}
                        {!! Form::text('mobile', null, ['class' => 'form-control', 'id' => 'member-mobile']) !!}
                        @if ($errors->has('mobile')) <p class="help-block error">{{ $errors->first('mobile') }}</p> @endif
                    </div>
                </div>

                <div class="form-group clearfix">
                    <?php // For the default value, check if 'birthday' is already set, else use null
                        if (isset($member->birthday)){
                            $bday = $member->birthday->format('Y-m-d');
                        } else {
                            $bday = NULL;
                        }
                    ?>
                    <div class="col-sm-6 @if ($errors->has('birthday')) has-error @endif" style="padding-left:0;">
                        {!! Form::label('birthday', 'Birthday') !!}
                        {!! Form::date('birthday', $bday, ['class' => 'form-control', 'id' => 'member-birthday']) !!}
                        @if ($errors->has('birthday')) <p class="help-block error">{{ $errors->first('birthday') }}</p> @endif
                    </div>

                    <div class="col-sm-6 @if ($errors->has('gender')) has-error @endif" style="padding-right:0;">
                        {!! Form::label('gender', 'Gender') !!}
                        {!! Form::select('gender', [null => '-- Please Select --'] + $genders, null, ['class' => 'form-control']) !!}
                        @if ($errors->has('gender')) <p class="help-block error">{{ $errors->first('gender') }}</p> @endif
                    </div>
                </div>

            </div>
        </div>

    </div>


    <div class="col-md-3">

        <div class="panel panel-default">
            <div class="panel-heading">Publish</div>
            <div class="panel-body">

                <div class="form-group status-toggle @if ($errors->has('status_id')) has-error @endif">
                    <i class="fa fa-map-pin" aria-hidden="true"></i>{!! Form::label('status_id', 'Status') !!}
                    <p class=" ">
                        <span></span><i class="pull-right fa " aria-hidden="true"></i>
                    </p>
                    {!! Form::hidden('status_id', null, ['class' => 'status form-control']) !!}
                    @if ($errors->has('status_id')) <span class="help-block error">{{ $errors->first('status_id') }}</span> @endif
                </div>

            </div>
            <div class="panel-footer">
                {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary btn-block form-control']) !!}
            </div>
        </div>

    </div>
