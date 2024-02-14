@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Voting Pool Creation Form -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Voting Pool') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('voting_pools.store') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="question">{{ __('Question') }}</label>
                            <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" required autofocus>
                            @error('question')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
 
                        <div class="mb-3"></div>
                        <div class="form-group mb-4">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Voting Pools -->
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">{{ __('Your Voting Pools') }}</div>

                <div class="card-body">
                    @if ($userVotingPools->isEmpty())
                    <p>{{ __('No voting pools created yet.') }}</p>
                    @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Number') }}</th>
                                    <th>{{ __('Question') }}</th>
                                    <th>{{ __('Total Vote') }}</th>
                                    <th>{{ __('Share') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userVotingPools as $votingPool)
                                <tr>
                                    <td>{{ $votingPool->id }}</td>
                                    <td>{{ $votingPool->question }}</td>
                                    <td>{{ $votingPool->answers()->count() }}</td>

                                  
                                    <td>
    <button onclick="shareViaEmail({{ $votingPool->id }})" class="btn btn-sm btn-info">{{ __('Share via Email') }}</button>
</td>



<td>
    <a href="https://wa.me/?text={{ urlencode(route('voting_pools.show', $votingPool->id)) }}" class="btn btn-sm btn-info" target="_blank">{{ __('Share via WhatsApp') }}</a>
</td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

 
<!-- Modal for Email Sharing -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Share via Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="recipientEmail">Recipient's Email:</label>
                <input type="email" class="form-control" id="recipientEmail" required>
                <div class="invalid-feedback">Please provide a valid email address.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="sendEmail()">Send</button>
            </div>
        </div>
    </div>
</div>


<script>
    function shareViaEmail(votingPoolId) {
        var recipient = document.getElementById('recipientEmail').value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  
        if (!emailRegex.test(recipient)) {
            alert('Please enter a valid email address.');
            return;  
        }

        var body = encodeURIComponent("Check out this voting pool: " + "{{ route('voting_pools.show', '') }}" + '/' + votingPoolId);
        window.location.href = "mailto:" + recipient + "?body=" + body;
        $('#emailModal').modal('hide');
    }
</script>




@endsection
