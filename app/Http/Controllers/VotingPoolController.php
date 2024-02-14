<?php

namespace App\Http\Controllers;
use App\Models\Answer; 
use App\Models\VotingPool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VotingPoolController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $userVotingPools = VotingPool::where('created_by', $user_id)->get();
        return view('voting_pools.user_voting_pools', compact('userVotingPools'));
    }

    public function create()
    {
        return view('voting_pools.create');
    }

    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'question' => 'required|string',
        ]);
    
        // Create new voting pool
        VotingPool::create([
            'question' => $validatedData['question'],
            'created_by' => auth()->id(),
        ]);
    
        return redirect('/home')->with('success', 'Voting pool created successfully.');
    }

    public function show($id)
    {
        $votingPool = VotingPool::findOrFail($id);
        return view('voting_pools.show', compact('votingPool'));
    }
    
    public function submit(Request $request, $id)
{
    $validatedData = $request->validate([
        'answer' => 'required|in:yes,no',
        'name' => 'required|string',
        'email' => 'required|email',
    ]);

    Answer::create([
        'voting_pool_id' => $id,
        'answer' => $validatedData['answer'],
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
    ]);

     return redirect()->route('home');
}
}
