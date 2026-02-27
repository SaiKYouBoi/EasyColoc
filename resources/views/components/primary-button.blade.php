<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary hover:bg-primary-dark text-white font-medium rounded-md text-sm uppercase tracking-widest transition-all shadow-sm shadow-primary/20']) }}>
    {{ $slot }}
</button>
