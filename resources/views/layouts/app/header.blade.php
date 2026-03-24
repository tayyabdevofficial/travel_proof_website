<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

            <x-app-logo :name="$title ?? __('Dashboard')" href="{{ route('admin.dashboard') }}" wire:navigate>
                <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-white">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="size-6 object-contain" />
                </x-slot>
            </x-app-logo>

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
                @can('admin')
                    <flux:navbar.item icon="tag" :href="route('admin.pricing.edit')" :current="request()->routeIs('admin.pricing.*')" wire:navigate>
                        {{ __('Pricing') }}
                    </flux:navbar.item>
                @endcan
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item class="!h-10 [&>div>svg]:size-5" icon="magnifying-glass" href="#" :label="__('Search')" />
                </flux:tooltip>
            </flux:navbar>

            <x-desktop-user-menu />
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar collapsible="mobile" sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" :name="$title ?? __('Dashboard')" href="{{ route('admin.dashboard') }}" wire:navigate>
                    <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-white">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="size-6 object-contain" />
                    </x-slot>
                </x-app-logo>
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Platform')">
                    <flux:sidebar.item icon="layout-grid" :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')" wire:navigate>
                        {{ __('Dashboard')  }}
                    </flux:sidebar.item>
                    @can('admin')
                        <flux:sidebar.item icon="tag" :href="route('admin.pricing.edit')" :current="request()->routeIs('admin.pricing.*')" wire:navigate>
                            {{ __('Pricing') }}
                        </flux:sidebar.item>
                    @endcan
                </flux:sidebar.group>
            </flux:sidebar.nav>

        </flux:sidebar>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
