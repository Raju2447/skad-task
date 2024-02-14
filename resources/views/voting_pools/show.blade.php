@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Voting Question: {{ $votingPool->question }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('voting_pools.submit', $votingPool->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="answer">Your Answer:</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="yes" name="answer" value="yes">
                                <label class="form-check-label" for="yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="no" name="answer" value="no">
                                <label class="form-check-label" for="no">No</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Your Name:</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email:</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="mb-3"></div>  
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
