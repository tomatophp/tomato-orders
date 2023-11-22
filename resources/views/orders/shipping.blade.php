<x-tomato-admin-container label="{{__('Shipping Order')}} # {{$model->uuid}}">
    <x-splade-form method="POST" action="{{route('admin.orders.ship', $model->id)}}" :default="$model" class="flex flex-col gap-4">
        <x-splade-select
            choices
            remote-url="{{route('admin.shipping-vendors.api')}}"
            remote-root="data"
            name="shipping_vendor_id"
            label="{{__('Shipping Vendor')}}"
            placeholder="{{__('Shipping Vendor')}}"
            option-label="name"
            option-value="id"
        />
        <x-splade-textarea name="address" type="text"  label="{{__('Address')}}" placeholder="{{__('Your Address')}}" />
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            <x-splade-select
                choices
                remote-url="{{route('admin.countries.api')}}"
                remote-root="data"
                name="country_id"
                label="{{__('County')}}"
                placeholder="{{__('Your County')}}"
                option-label="name"
                option-value="id"
            />
            <x-splade-select
                choices
                remote-url="`{{route('admin.cities.api') . '?country_id='}}${form.country_id}`"
                remote-root="data"
                name="city_id"
                label="{{__('City')}}"
                placeholder="{{__('Your City')}}"
                option-label="name"
                option-value="id"
            />
            <x-splade-select
                choices
                remote-url="`{{route('admin.areas.api') . '?city_id='}}${form.city_id}`"
                remote-root="data"
                name="area_id"
                label="{{__('Area')}}"
                placeholder="{{__('Your Area')}}"
                option-label="name"
                option-value="id"
            />
        </div>
        <x-splade-defer>
            <x-splade-input name="shipping" type="number" label="{{__('Shipping Cost')}}" />
        </x-splade-defer>

        <x-tomato-admin-submit spinner label="{{__('Ship')}}" />
    </x-splade-form>
</x-tomato-admin-container>
