<x-app-layout>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <x-list class="col-span-1 h-fit mb-6">
        <x-header title="{{ __('Assignments due within 2 weeks') }}" :list="true" />
        @foreach($assignments as $item)
            <x-list-clickable-item title="{{ $item->name.__(' for ').$item->section->course->name }}" href="{{ route('assignment', ['element' => $item]) }}"><span class="text-sm">{{ __('Due ').$item->due->diffForHumans().__(' on ').$item->due->format('l, F jS, Y').__(' at ').$item->due->format('H:i').__(' UTC') }}</span></x-list-clickable-item>
        @endforeach
    </x-list>
    <x-list class="col-span-1 h-fit mb-6">
        <x-header title="{{ __('Quizzes due within 2 weeks') }}" :list="true" />
        @foreach($quizzes as $item)
            <x-list-clickable-item title="{{ $item->name.__(' for ').$item->section->course->name }}" href="{{ route('quiz', ['element' => $item]) }}"><span class="text-sm">{{ __('Due ').$item->due->diffForHumans().__(' on ').$item->due->format('l, F jS, Y').__(' at ').$item->due->format('H:i').__(' UTC') }}</span></x-list-clickable-item>
        @endforeach
    </x-list>
</x-app-layout>
