<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>

@if(Session::has('info'))
    <div class="alert alert-info alert-dismissible fade show position-fixed  start-50 translate-middle-x rounded-0 shadow-lg" role="alert" style="max-width: 400px; z-index: 9999;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-info-circle me-2"></i>
                {{ Session::get('info') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <script>
        setTimeout(function() {
            $(".alert").alert('close');
        }, 5000);
    </script>
@endif
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js') }}"></script>
