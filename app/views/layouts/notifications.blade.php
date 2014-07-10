@if (count($errors->all()) > 0)
<div class="row alert__row">
    <div data-alert class="alert-box alert large-6 small-centered columns" >
             <strong>Error</strong>: Check the form below for errors.
            <a href="#" class="close">&times;</a>
        </div>
</div>
@endif 

@if(Session::has('info') || Session::has('success') || Session::has('warning') || Session::has('error'))
<div class="row alert__row">
    <div class="large-12 small-12 columns alert__container">
        @if($message = Session::get('info'))
        <div data-alert class="alert-box large-6 small-centered columns">
            @if(is_array($message))
                @foreach ($message as $m)
                    {{ $m }}
                @endforeach
            @else
                {{ $message }}
            @endif
            <a href="#" class="close">&times;</a>
        </div>
        @endif
        @if($message = Session::get('success'))
        <div data-alert class="alert-box success large-6 small-centered columns">
            @if(is_array($message))
                @foreach ($message as $m)
                    {{ $m }}
                @endforeach
            @else
                {{ $message }}
            @endif
            <a href="#" class="close">&times;</a>
        </div>
        @endif
        @if($message = Session::get('error'))
        <div data-alert class="alert-box alert large-6 small-centered columns" >
             @if(is_array($message))
                @foreach ($message as $m)
                    {{ $m }}
                @endforeach
            @else
                {{ $message }}
            @endif
            <a href="#" class="close">&times;</a>
        </div>
        @endif
         @if($message = Session::get('warning'))
        <div data-alert class="alert-box warning large-6 small-centered columns" >
             @if(is_array($message))
                @foreach ($message as $m)
                    {{ $m }}
                @endforeach
            @else
                {{ $message }}
            @endif
            <a href="#" class="close">&times;</a>
        </div>
        @endif  
    </div>
</div>
@endif
<div class="row">
    <div class="large-12">
        <?php for ($i = 1; $i <= 20; $i++) {
            echo "$i <br />";
        } ?>
    </div>
</div>