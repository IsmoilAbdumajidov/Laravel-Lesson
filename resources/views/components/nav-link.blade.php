@props(['active' => false])

<a class="{{ $active ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
    {{ $attributes }}>
    {{ $slot }}
</a>



{{-- @props(['active'=> false, "type" => "a"]) --}}

{{-- +  Bu mainmcha type ga qarab elemnt chiqarish uchun eng yaxshi yechim bo'la oladi --}}
{{-- <{{ $type }} class="{{ $active ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
   {{ $attributes }} >
   {{ $slot }}
  </{{ $type }}> --}}
{{-- +  Bu blade yordamida yozilgan conditional --}}

{{-- @if ($type === 'a')
    <a class="{{ $active ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
      {{ $attributes }} >
      {{ $slot }}
    </a>
@else
    <button class="{{ $active ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
      {{ $attributes }} >
      {{ $slot }}
    </button>
@endif --}}

{{-- +  Bu php yordamida yozilgan conditional --}}
{{-- <?php if ($type === 'a'): ?>
    <a class="{{ $active ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
      {{ $attributes }} >
      {{ $slot }}
    </a>
  <?php else: ?>
    <button class="{{ $active ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
      {{ $attributes }} >
      {{ $slot }}
    </button>
  <?php endif; ?> --}}
