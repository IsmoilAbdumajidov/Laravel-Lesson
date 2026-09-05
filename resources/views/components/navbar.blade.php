 <nav class="bg-gray-800/50">
     <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
         <div class="flex h-16 items-center justify-between">
             <div class="flex items-center">
                 <div class="shrink-0">
                     <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                         alt="Your Company" class="size-8" />
                 </div>
                 <div class="hidden md:block">
                     <div class="ml-10 flex items-baseline space-x-4">
                         <!-- Current: "bg-gray-950/50 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
                         <x-nav-link :active="request()->is('/')" href="/">Home</x-nav-link>
                         <x-nav-link :active="request()->is('jobs')" href="/jobs">Jobs</x-nav-link>
                         <x-nav-link :active="request()->is('about')" href="/about">About</x-nav-link>
                         @can('view-admin')
                             <x-nav-link :active="request()->is('admin')" href="/admin">Admin</x-nav-link>
                         @endcan
                         <x-nav-link :active="request()->is('ideas')" href="/ideas">Ideas</x-nav-link>
                         <x-nav-link :active="request()->is('ideas/create')" href="/ideas/create">New Ideas</x-nav-link>
                         <x-nav-link :active="request()->is('contact')" type="button" href="/contact">Contact</x-nav-link>
                         {{-- <a href="/" class="{{ request()->is('/') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Home</a>
                                    <a href="/about" class="{{ request()->is('about') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">About</a>
                                    <a href="/contact" class="{{ request()->is('contact') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Contact</a> --}}
                         {{-- <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Calendar</a>
                                    <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Reports</a> --}}
                     </div>
                 </div>
             </div>
             <div class="-mr-2 flex">
                 <div class="border-t border-white/10 pt-4 pb-3">
                     {{-- @guest
                         <a href="/register" class="btn btn-primary" type="button">
                             Register
                         </a>
                         <a href="/login" class="btn btn-primary" type="button">
                             Login
                         </a>
                     @endguest --}}
                     @auth
                         <form action="/logout" method="POST">
                             @csrf
                             @method('DELETE')
                             <button type="submit" class="btn btn-ghost text-white">Logout</button>
                         </form>
                     @else
                         <a href="/register" class="btn btn-primary" type="button">
                             Register
                         </a>
                         <a href="/login" class="btn btn-primary" type="button">
                             Login
                         </a>
                     @endauth
                 </div>
                 <!-- Mobile menu button -->
                 <div class="-mr-2 flex md:hidden">
                     <button type="button" command="--toggle" commandfor="mobile-menu"
                         class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                         <span class="absolute -inset-0.5"></span>
                         <span class="sr-only">Open main menu</span>
                         <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                             data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                             <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                                 stroke-linejoin="round" />
                         </svg>
                         <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                             data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                             <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                         </svg>
                     </button>
                 </div>
             </div>
         </div>
     </div>

     <el-disclosure id="mobile-menu" hidden class="block md:hidden">
         <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
             <a href="/"
                 class="{{ request()->is('/') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">Home</a>
             <a href="/jobs"
                 class="{{ request()->is('jobs') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">Jobs</a>
             <a href="/about"
                 class="{{ request()->is('about') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">About</a>
             @can('view-admin')
                 <a href="/admin"
                     class="{{ request()->is('admin') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">Admin</a>
             @endcan
             <a href="/contact"
                 class="{{ request()->is('contact') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">Contact</a>
             <a href="/ideas"
                 class="{{ request()->is('ideas') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">Ideas</a>
             <a href="/ideas/create"
                 class="{{ request()->is('ideas/create') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">New
                 Ideas</a>
             {{-- <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Calendar</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Reports</a> --}}
         </div>
     </el-disclosure>
 </nav>
