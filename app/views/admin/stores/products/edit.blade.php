@section('scripts')
{{ HTML::script('assets/js/foundation/foundation.abide.js') }}
@stop
@section('scriptsverbose')
$(document).on('click','.variation--delete', function (event){
        $anchor = $(this);
        $url = $anchor.attr('data-href');
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: $url
        })
        .done(function(data) {
             $anchor.closest('li').remove();
         });
        //just to be sure its not submiting form
        return false;
   
});
 setInterval(checkForDOMChange, 1000);
@stop
<div class="row">
   <div class="large-12 columns">
        <h2>{{$store->name}} / {{Lang::get('products.product--edit')}}</h2>
       @include('admin.stores.navigation')
        <div class="medium-8 large-9 columns">
         {{ Form::open(array('url'=>'admin/product/'.$product->id.'/edit/', 'class'=>'form-signin','data-abide'=>'')) }}

         <div class="name-field">
            {{ Form::label('name', Lang::get('products.product--name').':') }}
            {{ Form::text('name',$product->name, array('required' =>'required', 'placeholder'=> Lang::get('products.product--name'))) }}
            <small class="error">{{Lang::get('products.error--nametaken')}}</small>
        </div>
        <div class="price-field">
            {{ Form::label('price', Lang::get('products.product--price-base').':') }}
                <span class="element--inline">$</span><input class="element--inline" type="number" step="0.5" required="required" value="{{$product->price}}" placeholder="{{Lang::get('products.product--price-placeholder')}}" pattern="number" name="price" >
            <small class="error">{{Lang::get('products.error--number')}}</small>
        </div>
        <div class="description-field">
            {{ Form::label('description', Lang::get('stores.store--description').':') }}
            {{ Form::textarea('description',$product->description, array('placeholder'=> Lang::get('products.product--description'))) }}
            <small class="error">{{Lang::get('products.error--description')}}</small>
        </div>

        {{HTML::link('admin/product/'.$product->id.'/variation/new', Lang::get('products.variation--link'), $attributes = array( 'data-reveal-id' =>'MyModal', 'data-reveal-ajax' => 'true', 'class' => 'tiny button'))}}
        <ul class="variations list--none" id="variations__box">
            @foreach($product->variations as $variation)
                <li class="radius secondary label">
                {{$variation->name}} - 
                ${{$variation->price}}
                <a class="variation--delete" data-href="{{route('productvariation.delete', array($product->id, $variation->id))}}">&#215;</a>
                
                </li>
            @endforeach
        </ul>
        <div class="clear--both"></div>


<?php 
/* otra forma de hacer el link, con otro helper y usando el alias de la ruta. 
{{link_to_route(  'productvariation.getNew',  'titulo',  array($product->id),
  ['class' => 'tiny button',
   'data-reveal-id' => 'MyModal',
   'data-reveal-ajax' => 'true',
  ]
)}}*/
?>
        <div class="submit-field">
            {{ Form::submit(Lang::get('form.change--save'), array('class' => 'button small')) }}
         </div>
         {{Form::close()}}
        </div>
        <div id="MyModal" class="reveal-modal" data-reveal>
            
        </div>
    </div>
</div>