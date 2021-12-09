<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use App\Models\Event;

use Auth;

use App\Models\Group;
use App\Rules\NotUnassigned;
use App\Traits\FindUserTrait;
use App\Traits\FindGroupTrait;


class EventController extends Controller
{
    use FindUserTrait;
    use FindGroupTrait;

    // index, returns index
    public function index()
    {
        //Log example
        return view('content.index', ['events' => Event::orderBy('event_date_start')->where('visibility', true)->get()]);
    }

    // event returns event based on id
    public function event($id)
    {
        $event = Event::find($id);

        // check if event exists or if event is visible
        if ($event != null) {
            if ($event->visibility == true) {
                $desc_array = explode("<br /><br />", $event->desc_long);
                switch (count($desc_array)) {
                    case 4:
                        $event->paraBody4 = $desc_array[3];
                    case 3:
                        $event->paraBody3 = $desc_array[2];
                    case 2:
                        $event->paraBody2 = $desc_array[1];
                    case 1:
                        $event->paraBody1 = $desc_array[0];
                        break;
                }
                return view('content.event', ['event' => $event]);
            }
            return redirect()->route('content.index')
                ->with('error', 'Could not find event');
        }
        return redirect()->route('content.index')
            ->with('error', 'Could not find event');
    }

    // returns events for people with account
    public function adminEvents()
    {
        // if user is admin, return all events from every group !! will probably change so only OSD admins can see all groups -> will be asked first
        if (Auth::user()->role == "admin" || Auth::user()->role == "super_admin") {
            $events = Event::orderByDesc('id')->get();
        } else {
            // get all events from with group id ""
            $events = Event::with('groups')->whereHas('groups', function ($query) {
                $query->where('group_id', Auth::user()->group_id);
            })
                ->orderByDesc('id')->get();
        }
        foreach ($events as $event) {
            $event->created_by = $this->find_user($event->created_by_id)->name;
            $event->updated_by = $this->find_user($event->updated_by_id)->name;
        }

        return view('admin.event.events', ['events' => $events]);
    }

    // load create page
    public function createLoad()
    {
        return view('admin.event.create');
    }

    // create new event, returns edit page for event
    public function create(Request $request)
    {
        // validate request
        $validator = $this->validator($request, "create");

        if ($validator->fails()) {
            return redirect()->route('admin.create')
                ->withErrors($validator)
                ->withInput();
        }

        // check if display needs to be blocked or not
        if ($request->has('display_title')) {
            $request->request->add(["display_title" => "block"]);
        } else {
            $request->request->add(["display_title" => "none"]);
        }

        // create event
        $event = Event::create([
            'created_by_id' => Auth::user()->id,
            'updated_by_id' => Auth::user()->id,
            'name' => $request->name,
            'title_color' => $request->title_color,
            'display_title' => $request->display_title,
            'desc_long' => $this->encryptBody($request),
            'desc_short' => $request->desc_short,
            'url_event' => $request->url_event,
            'img_path' => null,
            'event_date_start' => $request->event_date_start,
            'event_date_end' => $request->event_date_end,
        ]);

        // attach event to group
        $group = Group::find(Auth::user()->group_id);
        $group->events()->attach($event->id);

        $this->logger->info('Event created id: '.$event->id);
        return redirect()->route('admin.edit', $event->id);
    }

    // loads edit page
    public function editLoad($id)
    {
        $event = Event::find($id);

        $desc_array = explode("<br /><br />", $event->desc_long);
        switch (count($desc_array)) {
            case 4:
                $event->paraBody4 = $desc_array[3];
            case 3:
                $event->paraBody3 = $desc_array[2];
            case 2:
                $event->paraBody2 = $desc_array[1];
            case 1:
                $event->paraBody1 = $desc_array[0];
                break;
        }

        $groups = $event->groups;
        $group_ids = array();
        foreach ($groups as $group) {
            array_push($group_ids, $group->id);
        }

        // check if user is allowed to edit this event -> if admin or if user in group of this event ? middleware replacement
        if (Auth::user()->role == "admin" || Auth::user()->role == "super_admin") {
            return view('admin.event.edit', ['event' => $event, 'id' => $id, 'groups' => Group::where("id", "!=", 1)->get()]);
        } elseif (in_array(Auth::user()->group_id, $group_ids)) {
            return view('admin.event.edit', ['event' => $event, 'id' => $id]);
        } else {
            return redirect()->route('admin.events')
                ->with('error', 'You do not have permission to edit this event');
        }
    }

    // same functionality as create
    public function edit(Request $request)
    {
        $event = Event::find($request->id);

        $groups = $event->groups;
        $group_ids = array();
        foreach ($groups as $group) {
            array_push($group_ids, $group->id);
        }

        if (Auth::user()->role == "admin" || Auth::user()->role == "super_admin" || in_array(Auth::user()->group_id, $group_ids)) {
            $validator = $this->validator($request, "edit");

            if ($validator->fails()) {
                return redirect()->route('admin.edit', $request->id)
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($request->has('display_title')) {
                $request->display_title = "block";
            } else {
                $request->request->add(["display_title" => "none"]);
            }

            $img_path = $event->img_path;
            if ($request->file()) {
                if ($event->img_path !== null) {
                    Storage::delete($event->img_path);
                    unlink(storage_path(str_replace("/storage", "app/public", $event->img_path)));
                }

                $fileName = str_replace(" ", "-", $request->name) . "-banner.jpg";
                $filePath = $request->file('event_banner')->storeAs('uploads', $fileName, 'public');
                $img_path = '/storage/' . $filePath;
            }

            //code opkuisnen, hier moet een betere manier voor zijn!
            $event->updated_by_id = Auth::user()->id;
            $event->name = $request->name;
            $event->title_color = $request->title_color;
            $event->display_title = $request->display_title;
            $event->desc_short = $request->desc_short;
            $event->desc_long = $this->encryptBody($request);
            $event->url_event = $request->url_event;
            $event->img_path = $img_path;
            $event->event_date_start = $request->event_date_start;
            $event->event_date_end = $request->event_date_end;

            $event->save();

            $this->logger->info('Event updated content, id: '.$event->id);

            return redirect()->route('admin.edit', $event->id)
                ->with('status', 'Successfully saved changes');
        } else {
            return redirect()->route('admin.events')
                ->with('error', 'You do not have permission to edit this event');
        }
    }

    public function visibility(Request $request)
    {
        $event = Event::find($request->id);

        $groups = $event->groups;
        $group_ids = array();
        foreach ($groups as $group) {
            array_push($group_ids, $group->id);
        }

        if (Auth::user()->role == "admin" || Auth::user()->role == "super_admin" || in_array(Auth::user()->group_id, $group_ids)) {
            $validator = Validator::make($request->all(), [
                'visibility' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.edit', $request->id)
                    ->withErrors($validator);
            }

            $event->visibility = $request->visibility == 'true' ? true : false;
            $event->save();

            $this->logger->info('Event updated visibility, id: '.$event->id);

            return redirect()->route('admin.edit', $event->id)
                ->with('status', 'Successfully changed visibility');
        } else {
            return redirect()->route('admin.events')
                ->with('error', 'You do not have permission to edit this event');
        }
    }

    public function groups(Request $request)
    {
        $event = Event::find($request->id);

        $validator = Validator::make($request->all(), [
            'groups' => ['required', new NotUnassigned],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.edit', $request->id)
                ->withErrors($validator);
        }

        // detach all old groups
        $event->groups()->detach();

        // attach all new groups
        $new_groups = array_diff($request->groups, array("1"));
        foreach ($new_groups as $new_group) {
            $group = Group::find($new_group);
            $group->events()->attach($event->id);
        }

        $this->logger->info('Event updated groups, id: '.$event->id);
        return redirect()->route('admin.edit', $event->id)
            ->with('status', 'Successfully changed groups');
    }

    // delete event, unattach from group, delete banner image
    public function delete($id)
    {
        $event = Event::find($id);

        $groups = $event->groups;
        $group_ids = array();
        foreach ($groups as $group) {
            array_push($group_ids, $group->id);
        }

        if (Auth::user()->role == "admin" || Auth::user()->role == "super_admin" || in_array(Auth::user()->group_id, $group_ids)) {
            if ($event->img_path !== null) {
                Storage::delete($event->img_path);
                unlink(storage_path(str_replace("/storage", "app/public", $event->img_path)));
            }
            $id = $event->id;
            $event->groups()->detach();
            $event->delete();

            $this->logger->info('Event deleted, id: '.$id);
            return redirect()->route('admin.events')
                ->with('status', 'Event succesfully deleted!');
        } else {
            return redirect()->route('admin.events')
                ->with('error', 'You do not have permission to edit this event');
        }
    }

    // this function will make sure that our paragraphs are able to be stored in db
    private function encryptBody($request)
    {
        if ($request->paraBody2 === null) {
            if ($request->paraBody3 === null) {
                if ($request->has('paraBody4') && $request->paraBody4 !== null) {
                    $request->paraBody2 = $request->paraBody4;
                    $request->paraBody4 = null;
                }
            } else if ($request->paraBody4 !== null) {
                $request->paraBody2 = $request->paraBody3;
                $request->paraBody3 = $request->paraBody4;
                $request->paraBody4 = null;
            } else {
                $request->paraBody2 = $request->paraBody3;
                $request->paraBody3 = null;
            }
        } else if ($request->paraBody3 === null) {
            if ($request->paraBody4 !== null) {
                $request->paraBody3 = $request->paraBody4;
                $request->paraBody4 = null;
            }
        }

        if ($request->has('paraBody4') && $request->paraBody4 !== null) {
            $desc_long = $request->paraBody1 . "<br /><br />" . $request->paraBody2 . "<br /><br />" . $request->paraBody3 . "<br /><br />" . $request->paraBody4;
        } else if ($request->has('paraBody3') && $request->paraBody3 !== null) {
            $desc_long = $request->paraBody1 . "<br /><br />" . $request->paraBody2 . "<br /><br />" . $request->paraBody3;
        } else if ($request->has('paraBody2') && $request->paraBody2 !== null) {
            $desc_long = $request->paraBody1 . "<br /><br />" . $request->paraBody2;
        } else {
            $desc_long = $request->paraBody1;
        }

        return $desc_long;
    }

    // validator for form requests
    private function validator($request, $crud)
    {
        if ($crud == "edit") {
            $name = ['required', 'string', 'max:50', Rule::unique('events')->ignore($request->id),];
        } else {
            $name = 'required|unique:events|string|max:50';
        }
        $validator = Validator::make($request->all(), [
            'name' => $name,
            'title_color' => 'required|string|max:25',
            'desc_short' => 'required|string|max:255',
            'paraBody1' => 'required|string|max:2000',
            'paraBody2' => 'string|max:2000',
            'paraBody3' => 'string|max:2000',
            'paraBody4' => 'string|max:2000',
            'event_banner' => 'image|max:2048',
            'url_event' => 'max:255',
            'event_date_start' => 'required|date',
            'event_date_end' => 'required|date|after_or_equal:event_date_start',
        ]);
        return $validator;
    }
}
