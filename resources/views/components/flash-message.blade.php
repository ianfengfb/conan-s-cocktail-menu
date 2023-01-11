@if(session()->has('message'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show"
  class="tw-fixed tw-top-0 tw-left-1/2 tw-transform tw--translate-x-1/2 tw-bg-laravel tw-text-white tw-px-48 tw-py-3">
  <p>
    {{session('message')}}
  </p>
</div>
@endif