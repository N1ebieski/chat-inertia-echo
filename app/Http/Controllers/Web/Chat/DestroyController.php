<?php

namespace App\Http\Controllers\Web\Chat;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;

class DestroyController
{
    /**
     * Undocumented function
     *
     * @param Message $message
     * @return RedirectResponse
     */
    public function __invoke(Message $message) : RedirectResponse
    {
        $message->delete();

        Event::dispatch(App::make(\App\Events\MessageDestroy::class, [
            'message' => $message
        ]));

        return Response::redirectToRoute('web.chat.index');
    }
}
