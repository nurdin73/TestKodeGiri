<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    /**
     * @OA\Get(
     *     path="/events",
     *     summary="Find Events",
     *     description="Returns a single pet",
     *     operationId="getEvents",
     *     security={ {"sanctum": {} }},
     *     tags={"Events"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Pet not found"
     *     ),
     * )
     */
    public function index(Request $request)
    {
        $search = $request->input('search') ?? "";
        $events = Event::select('*');
        if ($search != "") {
            $events = $events->where('name', 'like', "%$search%");
        }
        $events = $events->orderBy('date', 'desc')->paginate(10);
        return EventResource::collection($events);
    }

    /**
     * @OA\Get(
     *     path="/events/{id}",
     *     summary="Detail Event",
     *     description="Returns a single event",
     *     operationId="getEventsId",
     *     security={ {"sanctum": {} }},
     *     tags={"Events"},
     *     @OA\Parameter(
     *         description="Event Id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Pet not found"
     *     ),
     * )
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * @OA\Post(
     *     path="/events",
     *     description="",
     *     summary="Add event",
     *     operationId="addEvent",
     *     security={ {"sanctum": {} }},
     *     @OA\Header(
     *         header="bearer",
     *         description="Api key header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  @OA\Property(
     *                       description="Title of event",
     *                       property="name",
     *                       type="string",
     *                       title="name"
     *                  ),
     *                  @OA\Property(
     *                       description="date event",
     *                       property="date",
     *                       type="string", 
     *                       format="date",
     *                       title="date"
     *                  ),
     *                  @OA\Property(
     *                       description="time event",
     *                       property="time",
     *                       type="string", 
     *                       format="time",
     *                       title="time"
     *                  ),
     *                  @OA\Property(
     *                       description="location event",
     *                       property="location",
     *                       type="string",
     *                       title="location"
     *                  ),
     *                  @OA\Property(
     *                       description="Thumbnail",
     *                       property="thumbnail",
     *                       type="string", 
     *                       format="binary",
     *                       title="thumbnail"
     *                  )
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *     ),
     *      @OA\Response(
     *         response="422",
     *         description="field required",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="unauthorized",
     *     ),
     *     tags={
     *         "Events"
     *     }
     * )
     * */
    public function store(Request $request)
    {
        $event = $request->validate([
            'name' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
        ]);
        if ($request->hasFile('thumbnail')) {
            $event['thumbnail'] = $request->file('thumbnail')->store('thumbnails', ['disk' => 'local']);
        }
        $event = Event::create($event);
        return response()->json(['message' => 'Event created'], 201);
    }


    /**
     * @OA\Post(
     *     path="/events/{id}",
     *     description="",
     *     summary="Update event",
     *     operationId="updateEvent",
     *     security={ {"sanctum": {} }},
     *     @OA\Header(
     *         header="bearer",
     *         description="Api key header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Id event",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  @OA\Property(
     *                       description="Title of event",
     *                       property="name",
     *                       type="string",
     *                       title="name"
     *                  ),
     *                  @OA\Property(
     *                       description="date event",
     *                       property="date",
     *                       type="string", 
     *                       format="date",
     *                       title="date"
     *                  ),
     *                  @OA\Property(
     *                       description="time event",
     *                       property="time",
     *                       type="string", 
     *                       format="time",
     *                       title="time"
     *                  ),
     *                  @OA\Property(
     *                       description="location event",
     *                       property="location",
     *                       type="string",
     *                       title="location"
     *                  ),
     *                  @OA\Property(
     *                       description="Thumbnail",
     *                       property="thumbnail",
     *                       type="string", 
     *                       format="binary",
     *                       title="thumbnail"
     *                  )
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *     ),
     *      @OA\Response(
     *         response="422",
     *         description="field required",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="unauthorized",
     *     ),
     *     tags={
     *         "Events"
     *     }
     * )
     * */

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'name' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
        ]);
        if ($request->hasFile('thumbnail')) {
            if ($event->thumbnail) {
                unlink(storage_path("app/$event->thumbnail"));
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }
        $event->update($data);
        return response()->json(['message' => 'Event updated successfully'], 200);
    }

    /**
     * @OA\Delete(
     *     path="/events/{id}",
     *     summary="Deletes a event",
     *     description="",
     *     operationId="deleteEvent",
     *     tags={"Events"},
     *     security={ {"sanctum": {} }},
     *     @OA\Header(
     *         header="bearer",
     *         description="Api key header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Id event",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pet not found"
     *     ),
     * )
     */

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully'], 200);
    }
}
