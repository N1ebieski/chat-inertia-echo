<?php

namespace App\Http\Controllers\Web\Chat;

use App\Http\Requests\Web\Chat\UpdateRequest;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;

class UpdateController
{
    /**
     * Undocumented function
     *
     * @param Message $message
     * @param UpdateRequest $request
     * @return RedirectResponse
     */
    public function __invoke(Message $message, UpdateRequest $request) : RedirectResponse
    {
        $message->update($request->validated());

        Event::dispatch(App::make(\App\Events\MessageUpdate::class, [
            'message' => $message
        ]));

        return Response::redirectToRoute('web.chat.index');
    }
}
