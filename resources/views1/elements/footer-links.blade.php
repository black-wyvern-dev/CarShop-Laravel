{{--
  - Copyright (c) 2021 Derks.IT / Jeroen Derks <jeroen@derks.it> All rights reserved.
  - Unauthorized copying of this file, via any medium is strictly prohibited.
  - Proprietary and confidential.
 --}}
@foreach( Helper::getFooterContent() as $page)
    <li id="menu-item-561" class="menu-item menu-item-type-post_type menu-item-object-page">
        <a href="{{ route('pages', ['name' => $page->name]) }}" title="{{ $page->title }}">{{ $page->title }}</a></li>
    @auth
    @if('contact-us' === $page->name)
        <li id="menu-item-561" class="menu-item menu-item-type-post_type menu-item-object-page">
            <a href="{{ route('packages') }}" title="@lang('packages')">@lang('packages')</a></li>
    @endif
    @endauth
@endforeach
