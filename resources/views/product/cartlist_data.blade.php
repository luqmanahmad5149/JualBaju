<div class="flex flex-col items-center justify-center w-3/5 m-auto">
    @if ($products->isNotEmpty())
        @foreach ($products as $product )
            <div class="card shadow-md hover:shadow-lg w-2/5 mb-10">
                <a href="product/{{ $product->slug }}">
                    <div class="bg-gray-50 flex justify-center">
                        <img 
                            src="/images/{{ $product->image_path }}" 
                            alt=""
                            class="w-2/5 h-32 sm:h-48 object-scale-down object-center">
                    </div>
                    <div class="m-4 p-2">
                        <span class="text-1xl capitalize">{{ $product->name }} ({{ $product->product_size }})</span>
                        <span class="float-right">
                            <form 
                                id="delete_form"
                                action="/removecart/{{ $product->cart_id }}"
                                method="POST">
                                @csrf
                                <button
                                    class="uppercase text-gray-100 text-xs rounded-2xl ml-4 bg-red-500 hover:bg-red-600 p-3">
                                    Remove item
                                </button>
                            </form>
                        </span>
                        <span class="block font-bold text-gray-700 text-lg pt-2">RM {{ $product->price }} x {{ $product->cart_quantity }}</span>
                    </div>
                </a>
            </div>
        @endforeach  
    @else
        <div class="w-full h-60 flex justify-center">
            <h3 class="text-gray-700 text-lg">No Item in Cart</h3>
        </div>
    @endif
</div>

<script>
    new Splide( '.splide', {
        type: 'loop',
        rewind : true,
        autoplay: true,
    } ).mount();
</script>
<script>
    $(document).ready(function(){
        $("#close").click(function(){
            $("#message_visibility").hide();
        });
        $("#close").click(function(){
            $("#session_message").hide();
        });

        $("#close-modal").click(function(){
            $("#popup_modal").hide();
        });

        $("#open-delete-modal").click(function(){
            $("#delete-modal").show();
        })

        $("#close-delete-modal").click(function(){
            $("#delete-modal").hide();
        })
        
        $(document).on('click', '[role="navigation"] a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getMoreProducts(page);
        });

        function getMoreProducts(page){
            $.ajax({
                type: "GET",
                url: "{{ route('products.get-more-products') }}" + "?page=" + page,
                success: function(data){
                    $('#product_data').html(data);
                }
            });
        }
    });

    $(function(){
        $("#create_form").on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data:new FormData(this),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.status == 0){
                        $.each(data.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        });
                    } 
                    else {
                        $('#create_form')[0].reset();
                        $('#popup_modal').show()
                        $('#session_message').html(data.msg);
                    }
                }
            });
        });
    });

    $(function(){
        $("#edit_form").on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data:new FormData(this),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.status == 0){
                        $.each(data.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        });
                    } 
                    else {
                        $('#popup_modal').show()
                        $('#session_message').html(data.msg);
                    }
                }
            });
        });
    });

    function getCartList(){
            $.ajax({
                type: "GET",
                url: "{{ route('products.get-cartlist') }}",
                success: function(data){
                    $('#cartlist_data').html(data);
                }
            });
    }

    $(function(){
    $("#delete_form").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false
        });
    });
    });

    getCartList();

    
</script>


