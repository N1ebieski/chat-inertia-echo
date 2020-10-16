<?php

namespace App\Http\Controllers\Web\Chat;

use App\Models\Message;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Http\Resources\Models\Message as MessageResource;

class IndexController
{
    /**
     * Undocumented function
     *
     * @param Message $message
     * @return InertiaResponse
     */
    public function __invoke(Message $message) : InertiaResponse
    {
        return Inertia::render('Home', [
            'messages' => function () use ($message) {
                return MessageResource::collection(
                    $message->limit(100)
                        ->with('user')
                        ->get()
                );
            }
        ]);
    }
}
