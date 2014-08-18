
<div class="row">
	<div class="large-12 columns">
		<h3>{{Lang::get('products.variations--title')}}</h3> 
        {{ Form::open(array('url'=>'admin/product/'.$product->id.'/variation/new', 'class'=>'form-signin ajax','data-abide'=>'ajax', 'id' =>'variations--form')) }}
		<div class="name-field">
                {{ Form::label('name', Lang::get('products.variations--name').':') }}
                {{ Form::text('name','', array('required' =>'required', 'placeholder'=> Lang::get('products.variations--name'), 'id'=>'name-input')) }}
                <small class="error">{{Lang::get('form.error--empty')}}</small>
        </div>
         <div class="price-field">
            {{ Form::label('price', Lang::get('products.variations--price').':') }}
           
                 <span class="element--inline">$</span><input id="price-input" class="element--inline" type="number" step="0.5" placeholder="{{Lang::get('products.product--price-placeholder')}}" pattern="number" name="price" >

             <small class="error">{{Lang::get('products.error--number')}}</small>
        </div>
        <div class="submit-field">
                {{ Form::submit(Lang::get('products.variations--button'), array('class' => 'button small')) }}
        </div>
        {{Form::close()}}
    </div>
</div>

<script>/*
$('#variations--form').on('valid', function() {
    e.preventDefault();
  //llamada en ajax al servidor para grabar el campo, una vez grabado, se cierra el modal. si hay error, indicarlo.
  var nameval = $("#name-input").val();
  var priceval = $("#price-input").val();
  var tokenval =  $("input[name=_token]").val();
  var dataArray = {name:nameval, token:tokenval, price:priceval}
    $.ajax({
    url : 'admin/product/'+{{$product->id}}+'/variation/new',
    type: "POST",
    data : formData,
    success: function(data, textStatus, jqXHR)
    {
        //data - response from server
        console.log(data);
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
    
    }
});

});*/


$(document).ready(function() {
    $('.ajax').on('valid', function(event){
        $form = $(this);
        $url = $form.attr('action');
        event.preventDefault();
        var dataobj = $(this).serializeArray();
        dataobj.push({name : 'kind', value:'ajax' });
        //console.log(dataobj);
        $.ajax({
            type: 'POST',
            url: $url,
            data: dataobj,
            dataType: 'json',
        })
        .done(function(data) {
            //console.log(data); 
            // take care of that AJAX response
             manageAjaxResponse(data);
             //close reveal modal
             var precio = dataobj[2]['value'];
             if(precio=="")
                precio = '0.0';
             $('#variations__box').append('<li class="radius secondary label">'+dataobj[1]['value']+' - $'+precio+' <a class="variation--delete" data-href="{{URL::to("/")}}/admin/product/'+{{$product->id}}+'/variation/'+data["variation_id"]+'/delete">&#215;</a></li>');
             $('#MyModal').foundation('reveal', 'close');

        });
        //just to be sure its not submiting form
        return false;
    });
});
</script>
<a class="close-reveal-modal">&#215;</a>