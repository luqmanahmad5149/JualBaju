<div class="p-10 grid grid-cols-4 gap-10">
    @foreach ($products as $product )
        <div class="card shadow-md hover:shadow-lg">
            <a href="product/{{ $product->slug }}">
                <div class="bg-gray-50">
                    <img 
                        src="/images/{{ $product->image_path }}" 
                        alt=""
                        class="w-full h-32 sm:h-48 object-scale-down object-center">
                </div>
                <div class="m-4 flex flex-col justify-center items-center">
                    <span class="text-1xl capitalize">{{ $product->name }}<span>
                        @if (isset(Auth::user()->id) && $product->user_id == Auth::user()->id)
                            <i class="fas fa-check text-gray-700 ml-1"></i>
                        @endif
                    </span></span>
                    <span class="block font-bold text-gray-700 text-sm pt-2">RM {{ $product->price }}</span>
                </div>
            </a>
        </div>
    @endforeach
</div>
<div class="px-15">
    {{ $products->links() }}
</div>