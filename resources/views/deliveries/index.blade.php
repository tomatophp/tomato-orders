<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Delivery') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.deliveries.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Delivery')}}
        </x-tomato-admin-button>
    </x-slot:buttons>
    <x-slot:icon>
        bx bxs-car
    </x-slot:icon>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell phone>
    <x-tomato-admin-row table type="tel" :value="$item->phone" />
</x-splade-cell>
<x-splade-cell is_activated>
    <x-tomato-admin-row table type="bool" :value="$item->is_activated" />
</x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('admin.deliveries.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" modal :href="route('admin.deliveries.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.deliveries.destroy', $item->id)"
                           confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                           confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                           confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                           cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                           method="delete"
                        >
                            <x-heroicon-s-trash class="h-6 w-6"/>
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
