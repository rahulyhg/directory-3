
    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-users" aria-hidden="true"></i>Family Information
            </div>
            <div class="panel-body">
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Family Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control slugjs-name', 'id' => 'family-name']) !!}
                    @if ($errors->has('name')) <p class="help-block error">{{ $errors->first('name') }}</p> @endif
                </div>

                <div class="form-group @if ($errors->has('slug')) has-error @endif">
                    {!! Form::label('slug', 'Family Slug') !!} <span class="slugjs-field">({{ env('APP_URL') }}/family/<span class="slugjs-uri"></span>)</span>
                    {!! Form::text('slug', null, ['class' => 'form-control slugjs-slug', 'id' => 'family-slug']) !!}
                    @if ($errors->has('slug')) <p class="help-block error">{{ $errors->first('slug') }}</p> @endif
                </div>


                <div class="form-group">

                    <div class="col-sm-6 @if ($errors->has('phone')) has-error @endif" style="padding-left:0;">
                        {!! Form::label('phone', 'Home Phone') !!}
                        {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'family-phone']) !!}
                        @if ($errors->has('phone')) <p class="help-block error">{{ $errors->first('phone') }}</p> @endif
                    </div>


                    <?php // For the default value, check if 'anniversary' is already set, else use null
                        if (isset($family->anniversary)){
                            $anniversary = $family->anniversary->format('Y-m-d');
                        } else {
                            $anniversary = NULL;
                        }
                    ?>
                    <div class="col-sm-6 @if ($errors->has('anniversary')) has-error @endif" style="padding-right:0;">
                        {!! Form::label('anniversary', 'Anniversary') !!}
                        {!! Form::date('anniversary', $anniversary, ['class' => 'form-control', 'id' => 'family-anniversary']) !!}
                        @if ($errors->has('anniversary')) <p class="help-block error">{{ $errors->first('anniversary') }}</p> @endif
                    </div>
                </div>

            </div>
        </div>



        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-map-marker" aria-hidden="true"></i>Family Home Address</div>
            <div class="panel-body">
                <div class="form-group @if ($errors->has('address')) has-error @endif">
                    {!! Form::label('address', 'Address') !!}
                    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'family-address']) !!}
                    @if ($errors->has('address')) <p class="help-block error">{{ $errors->first('address') }}</p> @endif
                </div>
                <div class="form-group">
                    <div class="col-sm-4 @if ($errors->has('city')) has-error @endif" style="padding-left:0;">
                        {!! Form::label('city', 'City') !!}
                        {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'family-city']) !!}
                        @if ($errors->has('city')) <p class="help-block error">{{ $errors->first('city') }}</p> @endif
                    </div>
                    <div class="col-sm-4 @if ($errors->has('state')) has-error @endif">
                        {!! Form::label('state', 'State') !!}
                        {!! Form::stateSelect('state', null, ['class' => 'form-control', 'id' => 'family-state']) !!}
                        @if ($errors->has('state')) <p class="help-block error">{{ $errors->first('state') }}</p> @endif
                    </div>
                    <div class="col-sm-4 @if ($errors->has('zip')) has-error @endif" style="padding-right:0;">
                        {!! Form::label('zip', 'Zip') !!}
                        {!! Form::text('zip', null, ['class' => 'form-control', 'id' => 'family-zip']) !!}
                        @if ($errors->has('zip')) <p class="help-block error">{{ $errors->first('zip') }}</p> @endif
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


        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-camera" aria-hidden="true"></i>Family Photo
            </div>
            <div class="panel-body">
                <?php if(isset($family)) { ?>
                <img style="max-width: 100%;" src="/public/directory/thb/{{ $family->thumbnail }}" alt="{{ $family->name }}">
                <?php } else { ?>
                    <label style="cursor:pointer; text-align:center; display:block; padding:10px; color:#CCC; font-weight:normal;" for="family-photo">
                        <i style="font-size:30px; margin:0;" class="fa fa-upload" aria-hidden="true"></i><br />
                        <span style="font-size:14px;">Upload a Photo</span>
                    </label>
                    {!! Form::file('photo', ['id' => 'family-photo', 'class' => 'hidden']) !!}
                <?php } ?>
                <div class="form-group @if ($errors->has('photo')) has-error @endif">
                    @if ($errors->has('photo')) <p class="help-block error">{{ $errors->first('photo') }}</p> @endif
                </div>
            </div>

        </div>

        <?php if(isset($family)) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-users" aria-hidden="true"></i>Family Members
                </div>
                <div class="panel-body">
                    @foreach($members as $member)
                        <div class="fam-member">
                            <a href="{{ url('/members/' . $member->id . '/edit') }}">{{ $member->first_name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        <?php } ?>

    </div>
