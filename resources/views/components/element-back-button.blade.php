@props(['element'])

<x-panel class="mb-8">
    <a class="text-green-700 font-semibold" href="{{ route('course', $element->section->course) }}">&larr; {{ __('Back to course') }}</a>
</x-panel>
