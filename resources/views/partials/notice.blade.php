<!-- This is to add the notification banner for errors and notice-->

<div class="container mt-4">
@if($errors->any())
        @foreach($errors->all() as $error)
            <!-- <script>alert("{{ $error }}")</script> -->
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    
    @endif
    @if(session('message'))
        <!-- <script>alert("{{ session('message') }}")</script> -->
        <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
    
    @endif

    </div>