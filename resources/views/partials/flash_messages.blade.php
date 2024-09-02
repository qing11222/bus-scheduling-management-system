<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get flash messages from the body data attributes
        const successMessage = document.body.dataset.flashSuccess;
        const errorMessage = document.body.dataset.flashError;
        const validationErrors = document.body.dataset.flashErrors;

        // Show success message if it exists
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: successMessage,
                confirmButtonText: 'OK'
            });
        }

        // Show error message if it exists
        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage,
                confirmButtonText: 'OK'
            });
        }

        // Show validation errors if they exist
        if (validationErrors) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Errors',
                html: validationErrors,
                confirmButtonText: 'OK'
            });
        }
    });
</script>
