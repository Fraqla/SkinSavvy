<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DialogflowController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Get the intent name from Dialogflow request
        $intentName = $request->input('queryResult.intent.displayName');

        // Prepare response based on intent
        switch ($intentName) {
            case 'Default Welcome Intent':
                $responseText = 'Hello! Welcome to SkinSavvy. How can I assist you today?';
                break;

            case 'Skin Product Inquiry':
                $responseText = 'We have a variety of skin products. Which type are you interested in?';
                break;

            default:
                $responseText = "Sorry, I didn't understand that. Can you please rephrase?";
                break;
        }

        // Build response JSON for Dialogflow
        return response()->json([
            'fulfillmentText' => $responseText,
        ]);
    }
}
