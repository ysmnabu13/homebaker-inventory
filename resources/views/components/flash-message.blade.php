<script>
    function showSweetAlert(icon, title, text) {
      Swal.fire({
        icon: icon,
        title: title,
        text: text,
        customClass: {
          container: 'swal2-container',
          popup: 'swal2-popup',
        },
        onOpen: () => {
          document.getElementsByClassName('swal2-container')[0].style.zIndex = '9999';
        },
      });
    }
</script>

@if(session()->has('success'))
  <script>
    showSweetAlert('success', 'Success', '{{ session()->get('success') }}');
  </script>
@endif

@if(session()->has('warning'))
    <script>
      showSweetAlert('warning', 'Not Found', '{{ session()->get('warning') }}');
    </script>
@endif