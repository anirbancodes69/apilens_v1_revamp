<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    public function getAllByUser(int $userId)
    {
        return Project::where('user_id', $userId)->latest()->get();
    }

    public function findByIdForUser(int $projectId, int $userId)
    {
        return Project::where('id', $projectId)
            ->where('user_id', $userId)
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update(Project $project, array $data)
    {
        $project->update($data);
        return $project;
    }

    public function delete(Project $project)
    {
        return $project->delete();
    }
}