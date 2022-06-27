<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }">
        <input
            x-init="
                $('.icon_picker_ele').fontIconPicker({
                    source: mdi_icons,
                }).on('change', function() {
                    $dispatch('input',$(this).val())
                });
            "
            id="{{ $getId() }}"
            {!! $isRequired() ? 'required' : null !!}
            dusk="filament.forms.{{ $getStatePath() }}"
            {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
            class="icon_picker_ele"
            type="text">
    </div>
</x-forms::field-wrapper>


