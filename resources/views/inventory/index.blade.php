<x-layout>
    <form action="/inventory/search" method="GET">
        <div class="relative border-2 border-gray-100 m-4 rounded-lg">
            <div class="absolute top-4 left-3">
                <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
            </div>
            <input type="text" name="query" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none" placeholder="Search Product..."/>
            <div class="absolute top-2 right-2">
                <button type="submit" class="h-10 w-20 text-white rounded-lg" style="background-color: #506050;">
                    Search
                </button>
            </div>
        </div>
    </form>
    
    <form action="inventory/create" style="display: inline-block;">
        <button type="submit" class="mb-5 ml-5 p-5 h-10 w-50 text-white rounded-lg" style="background-color: #506050; display: flex; align-items: center; justify-content: center;">
            Add New Inventory Product
        </button>
    </form>

    <div style="display: inline-block;">
        <button id="openPopup" class="mb-5 ml-5 p-5 h-10 w-50 text-white rounded-lg" style="background-color: #506050; display: flex; align-items: center; justify-content: center;">
            View Inventory Report
        </button>
    </div>
          
          <div id="popupOverlay" style="display: none;">
            <div class="popupBox">
              <h2>Manager ID:</h2>
              <form id="managerForm" action="/inventory/report" novalidate>
                <input type="text" id="managerID" name="managerID" placeholder="Enter Manager ID" required>
                <button type="submit">Submit</button>
                <button type="button" id="closePopup">Cancel</button>
              </form>
            </div>
          </div>
  </div>
</div>

    <table class="w-full table-auto rounded-sm">
        <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Category</th>
              <th>Quantity</th>
              <th>Restocking Point</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        <tbody>
            @foreach ($inventory as $product)
            
            <tr class="border-gray-300 text-center">
                <td> {{ $product->id }} </td>
                <td> {{ $product->name }} </td>
                <td> {{ $product->category }} </td>
                <td>
                    <form action="/inventory/{{ $product->id }}" method="POST">
                        @csrf
                        <div>
                            <button type="submit" name="quantity" class="quantity-dec" value="{{ $product->quantity - 1 }}" {{ $product->quantity <= 0 ? 'disabled' : '' }}>-</button>
                            <b style="margin-left: 10px; margin-right: 10px; font-weight: normal;"> {{ $product->quantity }} </b>
                            <button type="submit" name="quantity" class="quantity-inc" value="{{ $product->quantity + 1 }}">+</button>
                        </div>
                    </form>
                </td>                
                <td> {{ $product->restockPoint }} </td>
                <td> {{ $product->status }} </td>      
                <td>
                    <form action="/inventory/{{ $product->id }}/edit" style="display: inline-block;">
                        <button class="p-5 h-10 w-50 text-white rounded-lg" style="background-color: #57788d; display: flex; align-items: center; justify-content: center;">
                            Edit
                        </button>
                    </form>
                    <form method="POST" action="/inventory/{{ $product->id }}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="p-5 h-10 w-50 text-white rounded-lg" style="background-color: #8c3b3b; display: flex; align-items: center; justify-content: center;">
                            Delete
                        </button>
                    </form>
                    <form action="{{ url('addorder', $product->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="quantity" value="1"> 
                        <button class="p-5 h-10 w-50 text-white rounded-lg" style="background-color: #5a897a; display: flex; align-items: center; justify-content: center;">
                            Add to Order
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>  
        <div class="p-5"> {{ $inventory->links() }} </div>
</x-layout>

<script>
    const openButton = document.getElementById('openPopup');
    const popupOverlay = document.getElementById('popupOverlay');
    const managerIDInput = document.getElementById('managerID');
    const signedInManagerID = '{{ $signedInManagerID }}';

    openButton.addEventListener('click', () => {
        popupOverlay.style.display = 'block';
    });

    document.getElementById('closePopup').addEventListener('click', () => {
        popupOverlay.style.display = 'none';
    });

    document.getElementById('managerForm').addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent the default form submission

        const managerID = managerIDInput.value.trim();

        if (managerID !== '') {
            if (managerID === signedInManagerID) {
                event.target.submit(); // Submit the form
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Manager ID',
                    text: 'Please enter a valid Manager ID.',
                    customClass: {
                    container: 'swal2-container',
                    popup: 'swal2-popup',
                },
                onOpen: () => {
                    document.getElementsByClassName('swal2-container')[0].style.zIndex = '9999';
                },
                });
            }
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Manager ID',
                text: 'Please enter your Manager ID.',
                customClass: {
                    container: 'swal2-container',
                    popup: 'swal2-popup',
                },
                onOpen: () => {
                    document.getElementsByClassName('swal2-container')[0].style.zIndex = '9999';
                },
            });
        }
    });
</script>