<?php

namespace App\Services;

use App\Repositories\EndpointRepository;
use App\Repositories\ProjectRepository;

class EndpointService
{
    public function __construct(
        protected EndpointRepository $repo,
        protected ProjectRepository $projectRepo
    ) {}

    public function list($user)
    {
        return $this->repo->getAllByUser($user->id);
    }

    public function create($user, array $data)
    {
        // Ensure project belongs to user
        $project = $this->projectRepo
            ->findByIdForUser($data['project_id'], $user->id);

        if (!$project) {
            throw new \Exception('Project not found');
        }

        $this->preventSSRF($data['url']);

        return $this->repo->create([
            ...$data,
            'project_id' => $project->id
        ]);
    }

    public function update($user, int $id, array $data)
    {
        $endpoint = $this->repo->findByIdForUser($id, $user->id);

        if (isset($data['url'])) {
            $this->preventSSRF($data['url']);
        }

        return $this->repo->update($endpoint, $data);
    }

    public function delete($user, int $id)
    {
        $endpoint = $this->repo->findByIdForUser($id, $user->id);

        return $this->repo->delete($endpoint);
    }

    private function preventSSRF(string $url)
    {
        $host = parse_url($url, PHP_URL_HOST);

        if (in_array($host, ['localhost', '127.0.0.1'])) {
            throw new \Exception('Invalid URL');
        }
    }
}