<div class="row">
	<div class="large-12">
		 <h3>{{Lang::get('stores.store--new')}}</h3>
		 {{ Form::open(array('url'=>'store/new/', 'class'=>'form-signin','data-abide'=>'')) }}

		<div class="name-field">
                {{ Form::label('name', Lang::get('stores.store--name').':') }}
                {{ Form::text('name','', array('required' =>'required', 'placeholder'=> Lang::get('stores.store--name'))) }}
                <small class="error">{{Lang::get('stores.error--nametaken')}}</small>
        </div>
        <div class="description-field">
                {{ Form::label('description', Lang::get('stores.store--description').':') }}
                {{ Form::textarea('description','', array('required' =>'required', 'placeholder'=> Lang::get('stores.store--description'))) }}
                <small class="error">{{Lang::get('stores.error--description')}}</small>
        </div>
        <div class="submit-field">
                {{ Form::submit(Lang::get('form.change--save'), array('class' => 'button small')) }}

            </div>
            {{Form::close()}}
	</div>
</div>