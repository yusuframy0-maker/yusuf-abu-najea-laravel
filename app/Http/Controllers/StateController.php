<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
  
    public function index()
    {
        $states = State::all();

        return view('tasks.index', compact('states'));
    }

    private function generateTaskName($baseName, $excludeId = null)
    {
        $baseName = trim($baseName);

        $existingTasks = State::query()
            ->when($excludeId !== null, function ($query) use ($excludeId) {
                $query->where('id', '!=', $excludeId);
            })
            ->get(['name']);

        $maxNumber = 0;

        foreach ($existingTasks as $task) {
            if (preg_match(
                '/^' . preg_quote($baseName, '/') . '(\d+)$/i',
                $task->name,
                $matches
            )) {
                $maxNumber = max($maxNumber, (int) $matches[1]);
            }
        }

        return $baseName . ($maxNumber + 1);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $taskName = $this->generateTaskName($request->name);

        State::create([
            'name' => $taskName,
            'created_at' => now(),
            'uplod_at' => now(),
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task added successfully!');
    }

    public function edit($id)
    {
        $state = State::findOrFail($id);
        $states = State::all();

        return view('tasks.edit', compact('state', 'states'));
    }
   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $state = State::findOrFail($id);

        $taskName = $this->generateTaskName(
            $request->name,
            $state->id
        );

        $state->update([
            'name' => $taskName,
            'uplod_at' => now(),
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    public function destroy($id)
    {
        $state = State::findOrFail($id);

        $state->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }
}
