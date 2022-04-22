<!-- checklist -->
@php
    $key_attribute = (new $field['model'])->getKeyName();
    $field['attribute'] = $field['attribute'] ?? (new $field['model'])->identifiableAttribute();
    $field['group_by']  = $field['group_by'] ?? null;
    $field['number_of_columns'] = $field['number_of_columns'] ?? 3;

    // calculate the checklist options
    if (! isset($field['group_by'])) {
        $field['options'] = $field['model']::all()->pluck($field['attribute'], $key_attribute)->toArray();
    } else {
        $field['options'] = $field['model']::all()->groupBy($field['group_by']);
    }

    // calculate the value of the hidden input
    $field['value'] = old_empty_or_null($field['name'], []) ??  $field['value'] ?? $field['default'] ?? [];
    if(!empty($field['value'])) {
        if (is_a($field['value'], \Illuminate\Support\Collection::class)) {
            $field['value'] = ($field['value'])->pluck($key_attribute)->toArray();
        } elseif (is_string($field['value'])){
          $field['value'] = json_decode($field['value']);
        }
    }

    // define the init-function on the wrapper
    $field['wrapper']['data-init-function'] =  $field['wrapper']['data-init-function'] ?? 'bpFieldInitChecklist';
@endphp

@include('crud::fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
@include('crud::fields.inc.translatable_icon')

<input type="hidden" value='@json($field['value'])' name="{{ $field['name'] }}">


<div class="row">
    @foreach ($field['options'] as $model => $permissions)
        <div class="col-sm-4">
            <strong><p>{{trans("admin.$model.singular")}}</p></strong>
            @foreach ($permissions as $key => $option)
                <div class="row">
                    <div class="checkbox">
                        <label class="font-weight-normal">
                            <input type="checkbox" value="{{ $key }}"> {{ $option->{$field['attribute']} }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

{{--@foreach ($field['options'] as $model => $permissions)--}}
{{--    <div class="row">--}}
{{--        <p>{{ $model }}</p>--}}
{{--        @foreach ($permissions as $key => $option)--}}
{{--            <div class="col-sm-{{ intval(12/count($permissions)) }}" style="margin-bottom: 10px">--}}
{{--                <div class="checkbox">--}}
{{--                    <label class="font-weight-normal">--}}
{{--                        <input type="checkbox" value="{{ $key }}"> {{ $option->{$field['attribute']} }}--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--@endforeach--}}

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('crud::fields.inc.wrapper_end')


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
{{-- FIELD JS - will be loaded in the after_scripts section --}}
@push('crud_fields_scripts')
    @loadOnce('bpFieldInitChecklist')
    <script>
        function bpFieldInitChecklist(element) {
            var hidden_input = element.find('input[type=hidden]');
            var selected_options = JSON.parse(hidden_input.val() || '[]');
            var checkboxes = element.find('input[type=checkbox]');
            var container = element.find('.row');

            // set the default checked/unchecked states on checklist options
            checkboxes.each(function(key, option) {
                var id = $(this).val();

                if (selected_options.map(String).includes(id)) {
                    $(this).prop('checked', 'checked');
                } else {
                    $(this).prop('checked', false);
                }
            });

            // when a checkbox is clicked
            // set the correct value on the hidden input
            checkboxes.click(function() {
                var newValue = [];

                checkboxes.each(function() {
                    if ($(this).is(':checked')) {
                        var id = $(this).val();
                        newValue.push(id);
                    }
                });

                hidden_input.val(JSON.stringify(newValue));

            });
        }
    </script>
    @endLoadOnce
@endpush
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
