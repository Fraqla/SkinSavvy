<?php
namespace App\Http\Controllers;

use Google\Cloud\Dialogflow\V2\Client\SessionsClient;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\DetectIntentRequest;
use Illuminate\Http\Request;
use Google\ApiCore\ApiException;
use App\Models\Product;

class DialogflowController extends Controller
{
    public function sendMessage(Request $request)
    {

        $languageCode = 'en-US';
        $projectId = 'skinsavvy-assistant-mgph'; // Must match Dialogflow's project ID
        $credentialsPath = storage_path('app/dialogflow-credentials.json'); // New file

        $sessionsClient = new SessionsClient([
            'credentials' => $credentialsPath,
            'projectId' => $projectId,
        ]);
        \Log::debug("Starting Dialogflow request", [
            'project' => $projectId,
            'credentials_path' => $credentialsPath
        ]);

        try {
            $text = $request->input('message');
            if (empty($text)) {
                throw new \Exception('Message is required');
            }

            if (!file_exists($credentialsPath)) {
                throw new \Exception("Credentials file not found at: {$credentialsPath}");
            }

            // Set environment variable for authentication
            putenv("GOOGLE_APPLICATION_CREDENTIALS={$credentialsPath}");

            $config = [
                'credentials' => $credentialsPath,
                'projectId' => $projectId,
            ];

            $sessionsClient = new SessionsClient($config);

            // Use a consistent session ID
            $sessionId = $request->input('session_id', 'flutter_chat_session');
            $sessionName = $sessionsClient->sessionName($projectId, $sessionId);

            // Create text input
            $textInput = new TextInput();
            $textInput->setText($text);
            $textInput->setLanguageCode($languageCode);

            // Create query input
            $queryInput = new QueryInput();
            $queryInput->setText($textInput);

            // Create the detect intent request
            $detectIntentRequest = new DetectIntentRequest();
            $detectIntentRequest->setSession($sessionName);
            $detectIntentRequest->setQueryInput($queryInput);

            // Execute request
            $response = $sessionsClient->detectIntent($detectIntentRequest);
            $queryResult = $response->getQueryResult();

            if ($queryResult === null) {
                throw new \Exception('No query result returned from Dialogflow');
            }

            $reply = $queryResult->getFulfillmentText() ?? 'No response text';
            $intent = $queryResult->getIntent() ? $queryResult->getIntent()->getDisplayName() : 'No intent';

            return response()->json([
                'reply' => $reply,
                'intent' => $intent
            ]);

        } catch (\Exception $e) {
            \Log::error("Error in Dialogflow communication: " . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    private function parseDialogflowError(ApiException $e): array
    {
        $details = [];
        foreach ($e->getMetadata() as $metadata) {
            $details[] = json_decode($metadata, true);
        }
        return [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'status' => $e->getStatus(),
            'details' => $details
        ];
    }

    public function handle(Request $request) {
    $skinType = $request->input('queryResult.parameters.skin_type');
    $products = Product::where('skin_type', $skinType)->limit(3)->get();
    
    return response()->json([
        'fulfillmentText' => "For $skinType skin, try: " . $products->pluck('name')->implode(', ')
    ]);
}
}