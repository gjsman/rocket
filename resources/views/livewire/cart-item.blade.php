@if(isset($item))
    {{-- Success is as dangerous as failure. --}}
    <tr class="bg-white">
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
            <x-input wire:model="quantity" type="number" id="{{ $item->rowId }}" name="{{ $item->rowId }}" style="max-width: 60px;" value="{{ $item->qty }}" />
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            {{ $item->model->name }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            ${{ '9.99' }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <a href="#" wire:click.prevent="deleteCartItem('{{ $item->rowId }}')" class="text-red-600 hover:text-red-700" style="text-decoration: none;">{{ __('Remove') }}</a>
        </td>
    </tr>
@else
    <tr class="bg-white">
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" colspan="4">
            {{ __('This item has been removed.') }}
        </td>
    </tr>
@endif
