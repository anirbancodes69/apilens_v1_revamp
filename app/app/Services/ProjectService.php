<?php
namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectRepository;

class ProjectService
{
    public function __construct(
        protected ProjectRepository $repo
    ) {}

    public function list($user)
    {
        return $this->repo->getAllByUser($user->id);
    }

    public function create($user, array $data)
    {
        $data['user_id'] = $user->id;
        return $this->repo->create($data);
    }

    public function update(Project $project, array $data)
    {
        return $this->repo->update($project, $data);
    }

    public function delete(Project $project)
    {
        return $this->repo->delete($project);
    }
}