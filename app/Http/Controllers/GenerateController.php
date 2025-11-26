<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    //     protected $aiService;

    // public function __construct(AiService $aiService)
    // {
    //     $this->aiService = $aiService;
    // }
    public function index(){
        return view("generate");
    }
   public function generate(Request $request)
{     $job_id = uniqid('job_', true); 
    $request->validate([
        'keywords' => 'required|string',
        'tone' => 'required|string',
        'lang' => 'required|string',
        'goal' => 'nullable|string',
        'business_category' => 'nullable|string',
        'postal_code'=>'nullable|string',
        'personalization' => 'nullable|string',
        'ai_provider' => 'required|string',

    ]);

    $payload = $request->only(['keywords','tone','lang','goal','personalization','ai_provider','postal_code','business_category']);
     $payload['job_id'] = $job_id;
    try {
       
        $response = Http::withHeaders([
    'token' =>env('AUTH_TOKEN')  
])->post(env("N8N_WEBHOOK_URL"), $payload);

        \Log::info('Payload sent to n8n:', $payload);
        \Log::info('N8N RESPONSE:', [$response->body()]);

             return redirect()->route('generate.loading', ['job_id' => $job_id]);
    } catch (\Exception $e) {
        \Log::error('N8N ERROR:', [$e->getMessage()]);
        return redirect()->back()->with('error', "Failed to send request to n8n.");
    }
}
public function showPosts(Request $request)
{

    try {
         $job_id = $request->query('job_id');

    if (!$job_id) {
        abort(404, 'job_id is missing');
    }
    $posts = Http::get("http://127.0.0.1:8002/api/posts/by-job/$job_id")->json();

    $nearby = Http::get("http://127.0.0.1:8002/api/nearby-businesses/by-job/$job_id")->json();

    return view('generated-posts', compact('posts', 'nearby', 'job_id'));

    } catch (\Exception $e) {
        return view('generated-posts', [
            'posts' => [],
            'error' => "Cannot fetch posts from Site Builder"
        ]);
    }
}

}
