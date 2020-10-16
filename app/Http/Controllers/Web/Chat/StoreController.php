<?php

namespace App\Http\Controllers\Web\Chat;

use App\Http\Requests\Web\Chat\StoreRequest;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;

class StoreController
{
    /**
     * Undocumented function
     *
     * @param Message $message
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function __invoke(Message $message, StoreRequest $request) : RedirectResponse
    {
        $message = $request->user()->messages()->create($request->validated());

        Event::dispatch(App::make(\App\Events\MessageStore::class, [
            'message' => $message
        ]));

        return Response::redirectToRoute('web.chat.index');
    }
}
