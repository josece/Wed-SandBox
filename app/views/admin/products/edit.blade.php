@section('scripts')
{{ HTML::script('assets/js/foundation/foundation.abide.js') }}
@stop
<div class="row">
    <div class="large-12">
       <h3>{{Lang::get('products.product--edit')}}</h3>
       {{ Form::open(array('url'=>'admin/product/'.$product->id.'/edit/', 'class'=>'form-signin','data-abide'=>'')) }}

       <div class="name-field">
        {{ Form::label('name', Lang::get('products.product--name').':') }}
        {{ Form::text('name',$product->name, array('required' =>'required', 'placeholder'=> Lang::get('products.product--name'))) }}
        <small class="error">{{Lang::get('products.error--nametaken')}}</small>
        </div>
        <div class="price-field">
            {{ Form::label('price', Lang::get('products.product--price').':') }}
            <input type="number" step="0.5" required="required" value="{{$product->price}}" placeholder="{{Lang::get('products.product--price')}}" pattern="number" name="price" >
            <small class="error">{{Lang::get('products.error--number')}}</small>
        </div>
        <div class="description-field">
            {{ Form::label('description', Lang::get('stores.store--description').':') }}
            {{ Form::textarea('description',$product->description, array('placeholder'=> Lang::get('products.product--description'))) }}
            <small class="error">{{Lang::get('products.error--description')}}</small>
        </div>
        <div class="submit-field">
            {{ Form::submit(Lang::get('form.change--save'), array('class' => 'button small')) }}
        </div>
        {{Form::close()}}
    </div>
</div>