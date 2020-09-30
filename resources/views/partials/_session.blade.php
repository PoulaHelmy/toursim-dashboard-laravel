@if (session('success'))
    <script>

        new Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        })

    </script>

@endif
