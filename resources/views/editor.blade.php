
<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <div id="{{$id}}" style="width: 100%; {!! $attributes !!}"></div>

        <input type="hidden" id="{{$id}}_input" name="{{$name}}" value="{{ old($column, $value) }}" />
        @include('admin::form.help-block')

    </div>
</div>
