@section('scripts')
    {{ HTML::script('assets/js/foundation/foundation.abide.js') }}
@stop
<div class="row">
	<div class="large-12 columns">
        <h2>{{$store->name}}</h2>
		
		 {{ Form::open(array('url'=>'admin/store/'.$store->id.'/product/new/', 'class'=>'form-signin','data-abide'=>'')) }}
         <div class="medium-4 large-3 columns">
            <ul class="side-nav">
                <li><a href="#">Productos</a></li>
            </ul>
        </div>
        <div class="medium-8 large-9 columns">
             <h3>{{Lang::get('products.product--new')}}</h3>
            <div class="name-field">
                {{ Form::label('name', Lang::get('products.product--name').':') }}
                {{ Form::text('name','', array('required' =>'required', 'placeholder'=> Lang::get('products.product--name'))) }}
                <small class="error">{{Lang::get('products.error--nametaken')}}</small>
            </div>
            <div class="price-field">
                {{ Form::label('price', Lang::get('products.product--price').':') }}
                <input type="number" step="0.5" required="required" placeholder="{{Lang::get('products.product--price')}}" pattern="number" name="price" >
                <small class="error">{{Lang::get('products.error--number')}}</small>
            </div>
            <div class="description-field">
                {{ Form::label('description', Lang::get('stores.store--description').':') }}
                {{ Form::textarea('description','', array('placeholder'=> Lang::get('products.product--description'))) }}
                <small class="error">{{Lang::get('products.error--description')}}</small>
            </div>
            <div class="submit-field">
                {{ Form::submit(Lang::get('form.change--save'), array('class' => 'button small')) }}
            </div>
        </div>
	</div>
</div>