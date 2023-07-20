<style>
              #popupOverlayOrder {
              display: none;
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              background-color: rgba(0, 0, 0, 0.5);
              z-index: 999;
          }

          .popupBoxOrder {
              position: fixed;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              background-color: white;
              padding: 20px;
              border-radius: 5px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
          }

          .popupBoxOrder h2 {
              margin-top: 0;
              font-weight: bold;
          }

          .popupBoxOrder input[type="text"] {
              padding: 10px;
              margin-bottom: 10px;
              width: 100%;
              box-sizing: border-box;
          }

          .popupBoxOrder button {
              padding: 10px 20px;
              margin-right: 10px;
              background-color: #506050;
              color: white;
              border: none;
              border-radius: 5px;
              cursor: pointer;
          }

          .popupBoxOrder button#closePopupOrder {
              background-color: #b24a4a;
          }

</style>
<x-layout>
    <div style="display: inline-block;">
        <button id="openPopup" class="mb-5 ml-5 p-5 h-10 w-50 text-white rounded-lg" style="background-color: #506050; display: flex; align-items: center; justify-content: center;">
            View Order Report
        </button>
    </div>
          
          <div id="popupOverlay" style="display: none;">
            <div class="popupBox">
              <h2>Manager ID:</h2>
              <form id="managerForm" action="/order/report" novalidate>
                <input type="text" id="managerID" name="managerID" placeholder="Enter Manager ID" required>
                <button type="submit">Submit</button>
                <button type="button" id="closePopup">Cancel</button>
              </form>
            </div>
          </div>
    
    <table class="w-full table-auto rounded-sm">
        <thead>
            <tr>
              <th style="padding:10px">Product Name</th>
              <th style="padding:10px">Quantity</th>
              <th style="padding:10px">Price</th>
              <th style="padding:10px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $orders)
            
            <tr class="border-gray-300 text-center">
                <td style="padding:10px"> {{ $orders->product_name }} </td>
                <td style="padding:10px">                     
                    <form action="/order/{{ $orders->id }}" method="POST">
                    @csrf
                        <div>
                            <button type="submit" name="quantity" class="quantity-dec" value="{{ $orders->quantity - 1 }}" {{ $orders->quantity <= 1 ? 'disabled' : '' }}>-</button>
                            <b style="margin-left: 10px; margin-right: 10px; font-weight: normal;"> {{ $orders->quantity }} </b>
                            <button type="submit" name="quantity" class="quantity-inc" value="{{ $orders->quantity + 1 }}">+</button>
                        </div>
                    </form> 
                </td>
                <td style="padding:10px"> {{ number_format($orders->totalPrice * $orders->quantity, 2) }} </td>
                <td>
                    <form method="POST" action="/order/{{ $orders->id }}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="p-5 h-10 w-50 text-white rounded-lg" 
                            style="background-color: #8c3b3b; display: flex; align-items: center; justify-content: center;">
                            Remove
                        </button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
        
    <div class="mb-6">
        <button id="openPopupOrder" class="mb-5 ml-5 p-5 h-10 w-50 text-white rounded-lg" style="background-color: #506050; display: flex; align-items: center; justify-content: center;">
            Order
        </button>
    </div>

    <div class="p-5"> {{ $order->links() }} </div>

          
          <div id="popupOverlayOrder" style="display: none;">
            <div class="popupBoxOrder">
              <h2>Manager ID:</h2>
              <form id="managerFormOrder" action="/finalorder" novalidate>
                <input type="text" id="managerIDOrder" name="managerID" placeholder="Enter Manager ID" required>
                <button type="submit">Submit</button>
                <button type="button" id="closePopupOrder">Cancel</button>
              </form>
            </div>
          </div>
</x-layout>

<script>
    const openButton = document.getElementById('openPopup');
    const popupOverlay = document.getElementById('popupOverlay');
    const managerIDInput = document.getElementById('managerID');
    const openButtonOrder = document.getElementById('openPopupOrder');
    const popupOverlayOrder = document.getElementById('popupOverlayOrder');
    const managerIDInputOrder = document.getElementById('managerIDOrder');
    const signedInManagerID = '{{ $signedInManagerID }}';

    openButton.addEventListener('click', () => {
        popupOverlay.style.display = 'block';
    });

    openButtonOrder.addEventListener('click', () => {
        popupOverlayOrder.style.display = 'block';
    });

    document.getElementById('closePopup').addEventListener('click', () => {
        popupOverlay.style.display = 'none';
    });

    document.getElementById('closePopupOrder').addEventListener('click', () => {
        popupOverlayOrder.style.display = 'none';
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

    document.getElementById('managerFormOrder').addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent the default form submission

        const managerIDOrder = managerIDInputOrder.value.trim();

        if (managerIDOrder !== '') {
            if (managerIDOrder === signedInManagerID) {
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