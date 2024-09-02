<div id="loading-spinner" style="display: block; text-align: center; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fff; z-index: 1000; display: flex; justify-content: center; align-items: center;">
    <div style="display: flex; align-items: center;">
        <img src="{{ asset('images/loading.gif') }}" alt="Loading" style="width: 100px; height: 100px; margin-right: 15px;">
        <p style="font-size: 36px; color: #333; margin: 0; font-family: 'Nunito', sans-serif; font-weight: 500; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">Loading, please wait...</p>
    </div>
</div>

<script>
    function showLoading() {
        document.getElementById('loading-spinner').style.display = 'flex';
    }

    function hideLoading() {
        document.getElementById('loading-spinner').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        showLoading(); // Show spinner initially
        setTimeout(function() {
            hideLoading(); // Hide spinner after a few seconds
        }, 2000); // Adjust the time as needed (3000 ms = 3 seconds)
    });
</script>
