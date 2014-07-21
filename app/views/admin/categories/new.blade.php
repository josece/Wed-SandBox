@section('scripts')
    {{ HTML::script('assets/js/foundation/foundation.abide.js') }}
@stop
<div class="row">
	<div class="large-12 columns">
        <h2>{{Lang::get('categories.categories-title')}}</h2>
		
		 {{ Form::open(array('url'=>'admin/categories/new/', 'class'=>'form-signin','data-abide'=>'')) }}
         <div class="medium-4 large-3 columns">
            <ul class="side-nav">
                <li><a href="#">Productos</a></li>
            </ul>
        </div>
        <div class="medium-8 large-9 columns">
             <h3>{{Lang::get('categories.category--new')}}</h3>
            <div class="name-field">
                {{ Form::label('name', Lang::get('categories.category--name').':') }}
                {{ Form::text('name','', array('required' =>'required', 'placeholder'=> Lang::get('categories.category--name'))) }}
                <small class="error">{{Lang::get('categories.error--name')}}</small>
            </div>
            <div class="name-field">
                {{ Form::label('parent', Lang::get('categories.category--parent').':') }}
                {{-- Form::select('size', $categories->all --}}
                @foreach (Taxonomy::all() as $category)
                    {{$category->name}}
                @endforeach
                <small class="error">{{Lang::get('categories.error--parent')}}</small>
            </div>
            <div class="name-field">
                {{ Form::label('description', Lang::get('categories.category--description').':') }}
                {{ Form::text('description','', array('placeholder'=> Lang::get('categories.category--description'))) }}
                <small class="error">{{Lang::get('categories.error--description')}}</small>
            </div>
            <div class="submit-field">
                {{ Form::submit(Lang::get('form.change--save'), array('class' => 'button small')) }}
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>